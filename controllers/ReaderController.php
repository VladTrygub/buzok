<?php
/**
 * Created by PhpStorm.
 * User: VladT
 * Date: 20.01.2017
 * Time: 17:01
 */

namespace app\controllers;


use app\models\Book;
use app\models\Post;
use yii\web\Controller;

class ReaderController extends Controller {

  public $layout = "my";

  public function actionIndex() {
    $articles = Post::find()->all(); // most popular articles this month
    $newBooks = Book::find()->orderBy(['updated_at' => SORT_DESC])
      ->limit(8)->asArray()->all(); // last 8 new books
    $popularBooks = Book::find()->orderBy(['visits' => SORT_DESC])
      ->limit(8)->asArray()->all(); // most popular books this month
    return $this->render('index', compact('articles', 'newBooks', 'popularBooks'));
  }

}