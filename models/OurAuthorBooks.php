<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "our_author_books".
 *
 * @property integer $id
 * @property integer $author_id
 * @property integer $book_id
 * @property string $name
 * @property string $description
 * @property string $text
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $author
 * @property Book $book
 */
class OurAuthorBooks extends \yii\db\ActiveRecord {
  /**
   * @inheritdoc
   */
  public static function tableName() {
    return 'our_author_books';
  }

  /**
   * @inheritdoc
   */
  public function rules() {
    return [
      [['author_id', 'name', 'created_at', 'updated_at'], 'required'],
      [['author_id', 'book_id', 'created_at', 'updated_at'], 'integer'],
      [['description', 'text'], 'string'],
      [['name'], 'string', 'max' => 255],
      [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'uid']],
      [['book_id'], 'exist', 'skipOnError' => true, 'targetClass' => Book::className(), 'targetAttribute' => ['book_id' => 'id']],
    ];
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels() {
    return [
      'id' => 'ID',
      'author_id' => 'Author ID',
      'book_id' => 'Book ID',
      'name' => 'Name',
      'description' => 'Description',
      'text' => 'Text',
      'created_at' => 'Created At',
      'updated_at' => 'Updated At',
    ];
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getAuthor() {
    return $this->hasOne(User::className(), ['uid' => 'author_id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getBook() {
    return $this->hasOne(Book::className(), ['id' => 'book_id']);
  }

  /**
   * @param $user_id integer
   * @return ActiveRecord[] | false
   */
  public static function findByUserId($user_id) {
    return OurAuthorBooks::find()->where(['author_id' => $user_id])->all();
  }

}
