<?php
/**
 * Created by PhpStorm.
 * User: VladT
 * Date: 01.12.2016
 * Time: 20:43
 */

namespace app\controllers;


use app\models\Auth;
use app\models\EmailForm;
use app\models\LoginForm;
use app\models\SignupForm;
use app\models\User;
use Yii;
use yii\helpers\Html;
use yii\web\Controller;
use yii\filters\AccessControl;

class AuthController extends Controller {

  public $layout = "my";

  public function behaviors() {
    return [
      'eauth' => [
        'class' => \nodge\eauth\openid\ControllerBehavior::className(),
        'only' => ['login'],
      ],
      'access' => [
        'class' => AccessControl::className(),
        //        'only' => ['logout'],
        'only' => ['login'],
        'rules' => [
          [
            'allow' => true,
          ],
          [
            'allow' => false,
            'denyCallback' => array($this, 'goHome'),
          ],
        ],
      ],
    ];
  }

  /**
   * Login action.
   *
   * @return string
   */
  public function actionLogin() {
    if (!Yii::$app->user->isGuest)
      return $this->redirect('/reader/index');

    $serviceName = Yii::$app->getRequest()->getQueryParam('service');
    if (isset($serviceName)) {
      /** @var $eauth \nodge\eauth\ServiceBase */
      $eauth = Yii::$app->get('eauth')->getIdentity($serviceName);
      $eauth->setRedirectUrl(Yii::$app->getUser()->getReturnUrl() . 'blog');
      $eauth->setCancelUrl(Yii::$app->getUrlManager()->createAbsoluteUrl('/login'));
      try {
        if ($eauth->authenticate()) {
          $identity = User::findByEAuth($eauth);
          $auth = Auth::find()->where(['auth_key' => $identity->authKey])->one();
//          here we check if this auth is set in db
          if (isset($auth)) {
//            here we need to login
            $user = $auth->user;
            if ($user->status == 1) {
              $identity->isMyAdmin = $user->isAdmin;
//              var_dump($identity);die;
              Yii::$app->user->login($identity);
              $eauth->redirect();
            } else {
//              todo: here we need to confirm email
              $eauth->redirect();
            }
          } else {
//            here we need to register user
            if ($identity->profile['service'] == 'facebook') {
              $fbUser = User::findOne(['email' => $identity->profile['email']]);
              if (isset($fbUser)) {
                // here we need to login exists user
                $identity->username = $fbUser->username;
                Yii::$app->user->login($identity);
              } else {
                // here we need to save fbUser and auth to db and login and login
                $user = new User();
                $user->saveUserAndAuth(1, $identity);
                Yii::$app->user->login($identity);
                $eauth->redirect();
              }
            } else {
//              here we need to register user with confirmation
              $user = new User();
              $user->saveUserAndAuth(0, $identity);
//              here we need to get user email
              $eauth->setRedirectUrl(Yii::$app->getUser()->getReturnUrl() . 'auth/confirm');
              Yii::$app->session->set('identity', $identity);
              $eauth->redirect();
            }
          }
        } else {
          $eauth->cancel();
        }
      } catch (\nodge\eauth\ErrorException $e) {
        Yii::$app->getSession()->setFlash('error', 'EAuthException: ' . $e->getMessage());
        $eauth->redirect($eauth->getCancelUrl());
      }
    }

    $model = new LoginForm();
    if ($model->load(Yii::$app->request->post())) {
      $model->login();
      return $this->redirect(['reader/index']);
    } else {
      return $this->render('login', [
        'model' => $model,
      ]);
    }
  }

  public function actionSignup() {
    $model = new SignupForm();
    if (Yii::$app->request->isPost) {
      $model->load(Yii::$app->request->post());
      if ($model->signup())
        return $this->redirect(['auth/login']);
    }
    return $this->render('signup', compact('model'));
  }

  public function actionConfirm() {
    //    print_r();
    $model = new EmailForm();
    if ($model->load(Yii::$app->request->post()) && $model->validate()) {
//      todo: here we need to check if this email exists in user table
      $user = User::find()->where(['email' => $model->email])->one();
      if (isset($user)) {
//        todo: we already have this email, we need to send confirmation for account to user
        return $this->render('account', compact('user'));
      } else {
//        todo: here we need to send confirmation msg on email to confirm account
        $email = $this->sendActivation($model->email);
      }
      if ($email) {
        Yii::$app->getSession()->setFlash('success-send-email', 'Check Your email for confirmation!');
      } else {
        Yii::$app->getSession()->setFlash('error-send-email', 'Failed, contact Admin!');
      }
      return $this->render('login');
    } else {
      return $this->render('confirm');
    }
  }

  public function actionEmail($id) {
    if ($id == Yii::$app->session->get('identity')->profile['id']) {
//      todo: here we need to update user email and status and login and render reader page
      $email = Yii::$app->getSession()->get('email');
      $identity = Yii::$app->getSession()->get('identity');
      $auth = Auth::find()->where(['source_id' => $id])->one();

      if (isset($auth)) {
        $user = $auth->user;
        $user->email = $email;
        $user->user_status = 1;
        $user->save();
        Yii::$app->user->login($identity);
        $this->redirect('/reader/index');
      }
    }
  }

  public function sendActivation($email) {
    Yii::$app->getSession()->set('email', $email);
    $id = Yii::$app->session->get('identity')->profile['id'];
    $message = Yii::$app->mailer->compose()
      ->setTo($email)
      ->setFrom('buzok@gmail.com')
      ->setSubject('Signup Confirmation')
      ->setHtmlBody("Click <a href=\"http://buzok.my/auth/email?id={$id}\" target=\"_blank\">here</a> to activate your email")
      ->send();
    return $message;
  }

  public function actionLogout() {
    Yii::$app->user->logout();
    return $this->redirect(['auth/login']);
  }

  public function actionOk() {
    $email = Yii::$app->getSession()->get('email');
    $id = Yii::$app->session->get('identity')->profile['id'];
    $message = Yii::$app->mailer->compose()
      ->setTo($email)
      ->setFrom('buzok@gmail.com')
      ->setSubject('Confirm User Account')
      ->setHtmlBody("Click this link <a href=\"http://buzok.my/auth/user?id={$id}\" target=\"_blank\">here</a> to confirm your account")
      ->send();
    if ($message) {
      Yii::$app->getSession()->setFlash('success-send-email', 'Check Your email for confirmation!');
    } else {
      Yii::$app->getSession()->setFlash('error-send-email', 'Failed, contact Admin!');
    }
    $this->render('login');
  }

  public function actionUser($id) {
    if ($id == Yii::$app->session->get('identity')->profile['id']) {
//      todo: need to add this user to our auth and login
      Yii::$app->getSession()->setFlash('success-activation', 'Ваш профиль был успешно связан с даной соц сетью!');
      $this->render('login');
    }
  }

}