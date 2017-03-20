<?php
/**
 * Created by PhpStorm.
 * User: VladT
 * Date: 20.01.2017
 * Time: 17:01
 */

namespace app\controllers;


use app\models\Book;
use app\models\Category;
use app\models\FilterForm;
use app\models\Genre;
use app\models\Literature;
use app\models\Style;
use app\models\Theme;
use Yii;
use yii\db\Query;
use yii\web\Controller;

class ShopController extends Controller {

  public $layout = "my";

  public function actionIndex() {
    $books = Book::find()->all();
    $categories = [];
    $categories[1][] = Literature::find()->asArray()->all();;
    $categories[2][] = Genre::find()->asArray()->all();;
    $categories[3][] = Theme::find()->asArray()->all();;
    $categories[4][] = Style::find()->asArray()->all();;
    return $this->render('index', compact('books', 'model', 'categories', 'literature'));
  }

  public function actionView($id) {
    $book = Book::findOne($id);
    Book::addVisit($id);
    return $this->render('view', compact('book'));
  }

  public function actionFilter($str) {
    $categories = [];
    $categories[1][] = Literature::find()->asArray()->all();;
    $categories[2][] = Genre::find()->asArray()->all();;
    $categories[3][] = Theme::find()->asArray()->all();;
    $categories[4][] = Style::find()->asArray()->all();;

    $response = null;
    foreach ($_GET as $item => $value) {
      if (strcmp('str', $item)) {
        $response[] = $value;
      }
    }
    unset($_GET['str']);

    $queryBooks = new Query();
    $queryBooks->select('*')
      ->from('book');
    $categoryNames = [];

    if (isset($_GET['literature'])) {
      foreach ($_GET['literature'] as $item)
        $categoryNames[] = Literature::findOne($item)->name;
      $queryBooks->andWhere(['literature_id' => $_GET['literature']]); }
    if (isset($_GET['genre'])) {
      foreach ($_GET['genre'] as $item)
        $categoryNames[] = Genre::findOne($item)->name;
      $queryBooks->andWhere(['genre_id' => $_GET['genre']]); }
    if (isset($_GET['theme'])) {
      foreach ($_GET['theme'] as $item)
        $categoryNames[] = Theme::findOne($item)->name;
      $queryBooks->andWhere(['theme_id' => $_GET['theme']]); }
    if (isset($_GET['style'])) {
      foreach ($_GET['style'] as $item)
        $categoryNames[] = Style::findOne($item)->name;
      $queryBooks->andWhere(['style_id' => $_GET['style']]); }

    /** @var Book $books */
    $books = $queryBooks->createCommand()->queryAll();
    return $this->render('index', compact(
      'response',
      'categories',
      'books',
      'categoryNames'
    ));
  }

}