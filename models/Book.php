<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "book".
 *
 * @property integer $id
 * @property integer $author_id
 * @property string $name
 * @property string $description
 * @property integer $visits
 * @property integer $is_ebook
 * @property integer $count_paper_books
 * @property string $img_name
 * @property double $price
 * @property integer $literature_id
 * @property integer $theme_id
 * @property integer $style_id
 * @property integer $genre_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $author
 * @property Genre $genre
 * @property Literature $literature
 * @property Style $style
 * @property Theme $theme
 * @property OrderBooks[] $orderBooks
 */
class Book extends \yii\db\ActiveRecord {
  /**
   * @inheritdoc
   */
  public static function tableName() {
    return 'book';
  }

  /**
   * @inheritdoc
   */
  public function rules() {
    return [
      [['author_id', 'is_ebook', 'count_paper_books', 'visits', 'literature_id', 'theme_id', 'style_id', 'genre_id', 'created_at', 'updated_at'], 'integer'],
      [['name', 'description', 'visits', 'img_name', 'price', 'created_at', 'updated_at'], 'required'],
      [['description'], 'string'],
      [['price'], 'number'],
      [['name', 'img_name'], 'string', 'max' => 255],
      [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'uid']],
      [['genre_id'], 'exist', 'skipOnError' => true, 'targetClass' => Genre::className(), 'targetAttribute' => ['genre_id' => 'id']],
      [['literature_id'], 'exist', 'skipOnError' => true, 'targetClass' => Literature::className(), 'targetAttribute' => ['literature_id' => 'id']],
      [['style_id'], 'exist', 'skipOnError' => true, 'targetClass' => Style::className(), 'targetAttribute' => ['style_id' => 'id']],
      [['theme_id'], 'exist', 'skipOnError' => true, 'targetClass' => Theme::className(), 'targetAttribute' => ['theme_id' => 'id']],
    ];
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels() {
    return [
      'id' => 'ID',
      'author_id' => 'Author ID',
      'name' => 'Name',
      'description' => 'Description',
      'is_ebook' => 'Is EBook',
      'count_paper_books' => 'Count of paper books',
      'visits' => 'Visits',
      'img_name' => 'Img Name',
      'price' => 'Price',
      'literature_id' => 'Literature ID',
      'theme_id' => 'Theme ID',
      'style_id' => 'Style ID',
      'genre_id' => 'Genre ID',
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
  public function getGenre() {
    return $this->hasOne(Genre::className(), ['id' => 'genre_id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getLiterature() {
    return $this->hasOne(Literature::className(), ['id' => 'literature_id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getStyle() {
    return $this->hasOne(Style::className(), ['id' => 'style_id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getTheme() {
    return $this->hasOne(Theme::className(), ['id' => 'theme_id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getOrderBooks() {
    return $this->hasMany(OrderBooks::className(), ['book_id' => 'id']);
  }

  public static function addVisit($id) {
    $book = Book::findOne($id);
    $book->visits = $book->visits + 1;
    return $book->update();

  }

}
