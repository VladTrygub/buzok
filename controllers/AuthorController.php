<?php
/**
 * Created by PhpStorm.
 * User: VladT
 * Date: 20.01.2017
 * Time: 17:01
 */

namespace app\controllers;


use app\models\OurAuthorBooks;
use app\models\OurAuthorBooksForm;
use app\models\Post;
use app\models\User;
use Yii;
use yii\web\Controller;

class AuthorController extends Controller {

  public $layout = "my";

  public function actionIndex() {
    if (Yii::$app->user->isGuest) return $this->render('index');
    $authorBooks = OurAuthorBooks::findByUserId(User::getUid());
    return $this->render('index', compact('authorBooks'));
  }

  public function actionCreate() {
    if (Yii::$app->user->isGuest) return $this->render('index');
    $model = new OurAuthorBooksForm();
    $authorBooks = OurAuthorBooks::findByUserId(User::getUid());
    if (Yii::$app->request->post()) {
      $model->load(Yii::$app->request->post());
      if ($model->createBook()) { // if book creation succeed
        Yii::$app->getSession()->setFlash('success-create/update-author-book', 'Done!');
        $authorBookId = $model->getAuthorBookId();
        return $this->redirect('/author/update/' . $authorBookId);
      } else // if book creation failed
        Yii::$app->getSession()->setFlash('error-create/update-author-book', 'Failed, try again!');
      return $this->render('index', compact('model', 'authorBooks', 'authorBookId'));
    }
    $create = true;
    return $this->render('index', compact('model', 'create', 'authorBooks'));
  }

  public function actionUpdate($id) {
    if (Yii::$app->user->isGuest) return $this->render('index');

    $model = OurAuthorBooksForm::loadAuthorBookById($id);
    $authorBookId = $id;
    $authorBooks = OurAuthorBooks::findByUserId(User::getUid());

    if (Yii::$app->request->post()) {
      $model->load(Yii::$app->request->post());
      if ($model->updateBook($id)) // if book updating succeed
        Yii::$app->getSession()->setFlash('success-create/update-author-book', 'Done!');
      else // if book updating failed
        Yii::$app->getSession()->setFlash('error-create/update-author-book', 'Failed, try again!');
    }

    return $this->render('index', compact('model', 'authorBooks', 'authorBookId'));
  }

  public function actionView($id) {
    $authorBook = OurAuthorBooks::findOne($id);
    return $this->render('view', compact('authorBook'));
  }

}