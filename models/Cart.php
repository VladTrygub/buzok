<?php
/**
 * Created by PhpStorm.
 * User: VladT
 * Date: 13.02.2017
 * Time: 18:02
 */

namespace app\models;


use yii\db\ActiveRecord;

class Cart extends ActiveRecord {

  /**
   * @param $book Book
   */
  public function addToCart($book, $bookKind) {
    if (!isset($_SESSION['cart'][$book->id])) { // if this book isn't set in cart
      $_SESSION['cart'][$book->id] = [
        'name' => $book->name,
        'price' => $book->price,
        'img' => $book->img_name,
        'book_kind' => $bookKind,
        'is_ebook' => $book->is_ebook,
        'count_paper_books' => $book->count_paper_books,
        'buy_count' => 1,
      ];
      $_SESSION['cart.qty'] = isset($_SESSION['cart.qty']) ?
        $_SESSION['cart.qty'] + 1 : 1;
      $_SESSION['cart.sum'] = isset($_SESSION['cart.sum']) ?
        $_SESSION['cart.sum'] + $book->price : $book->price;
    }
  }

  public function recalc($id) {
    if (isset($_SESSION['cart'][$id])) {
      $buy_count = $_SESSION['cart'][$id]['buy_count'];
      $_SESSION['cart.qty'] -= $buy_count;
      $_SESSION['cart.sum'] -= $_SESSION['cart'][$id]['price'] * $buy_count;
      unset($_SESSION['cart'][$id]);
    } else {
      return false;
    }
  }

}