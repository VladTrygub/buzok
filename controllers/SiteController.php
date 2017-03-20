<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\ContactForm;

class SiteController extends Controller {
  /**
   * @inheritdoc
   */
  public function behaviors() {
    return [
    ];
  }

  /**
   * @inheritdoc
   */
  public function actions() {
    return [
      'error' => [
        'class' => 'yii\web\ErrorAction',
      ],
    ];
  }

  /**
   * Displays homepage.
   *
   * @return string
   */
  public function actionIndex() {
//    $this->layout = "my";
    return $this->render('index');
  }

  /**
   * Displays contact page.
   *
   * @return string
   */
  public function actionContact() {
    $model = new ContactForm();
    if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
      Yii::$app->session->setFlash('contactFormSubmitted');

      return $this->refresh();
    }
    return $this->render('contact', [
      'model' => $model,
    ]);
  }

  /**
   * Displays about page.
   *
   * @return string
   */
  public function actionAbout() {
    return $this->render('about');
  }
}
