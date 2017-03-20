<?php
/**
 * Created by PhpStorm.
 * User: VladT
 * Date: 15.03.2017
 * Time: 12:00
 */

namespace app\models;


use Yii;
use yii\base\Model;

class OurAuthorBooksForm extends Model {

  public $name;
  public $description;
  public $text;

  /**
   * @var OurAuthorBooks
   */
  public $authorBookId;

  public function rules() {
    return [
      [['name'], 'required'],
      [['name', 'description', 'text'], 'string'],
    ];
  }

  /**
   * Creates new OurAuthorBook
   * @return true | false
   */
  public function createBook() {
    $result = new OurAuthorBooks();
    $time = time();
    $user_id = User::find()->where(['uname' => Yii::$app->user->identity->username])->one()->uid;
    $result->author_id = $user_id;
    $result->created_at = $time;
    $result->updated_at = $time;
    $result->name = $this->name;
    $result->description = $this->description;
    $result->text = $this->text;
    if ($result->save()) {
      $this->authorBookId = $result->id;
      return true;
    } else return false;
  }

  public function updateBook($authorBookId) {
    $authorBook = OurAuthorBooks::findOne($authorBookId);
    $authorBook->name = $this->name;
    $authorBook->description = $this->description;
    $authorBook->text = $this->text;
    $authorBook->updated_at = time();
    return $authorBook->update();
  }

  public function getAuthorBookId() {
    if (isset($this->authorBookId)) return $this->authorBookId;
    else return false;
  }

  public static function loadAuthorBookById($id) {
    $result = new self();
    $book = OurAuthorBooks::findOne($id);
    $result->name = $book->name;
    $result->description = $book->description;
    $result->text = $book->text;
    return $result;
  }

}