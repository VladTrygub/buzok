<?php
/**
 * Created by PhpStorm.
 * User: VladT
 * Date: 20.01.2017
 * Time: 17:01
 */

namespace app\controllers;


use app\models\Book;
use app\models\Cart;
use app\models\Order;
use Yii;
use yii\web\Controller;

class CartController extends Controller {

  public $layout = false;

  public function actionIndex() {
    $this->layout = "my";
    $session = Yii::$app->session;
    $session->open();
    $order = new Order();
    if ($order->load(Yii::$app->request->post())) {

    }
    return $this->render('index', compact('session', 'order'));
  }

  public function actionAddEbook($id) {
    $book = Book::findOne($id);
    if (empty($book)) { return false; }
    $session = Yii::$app->session;
    $session->open();
    $cart = new Cart();
    $cart->addToCart($book, 'ebook');
    if (!Yii::$app->request->isAjax) {
      return $this->redirect(Yii::$app->request->referrer);
    }
    return $this->render('cart-modal', compact('session'));
  }

  public function actionAddPbook($id) {
    $book = Book::findOne($id);
    if (!empty($book)) {
      $session = Yii::$app->session;
      $session->open();
      $cart = new Cart();
      $cart->addToCart($book, 'pbook');
      if (!Yii::$app->request->isAjax)
        return $this->redirect(Yii::$app->request->referrer);
      return $this->render('cart-modal', compact('session'));
    }
  }

  public function actionClear() {
    $session = Yii::$app->session;
    $session->remove('cart');
    $session->remove('cart.qty');
    $session->remove('cart.sum');
    return $this->render('cart-modal', compact('session'));
  }

  public function actionDelItem($id) {
    $session = Yii::$app->session;
    $session->open();
    $cart = new Cart();
    $cart->recalc($id);
    return $this->render('cart-modal', compact('session'));
  }

}