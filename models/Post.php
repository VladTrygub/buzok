<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property integer $author_id
 * @property string $title
 * @property string $img_name
 * @property string $demo_text
 * @property string $text
 * @property integer $likes
 * @property integer $count_comments
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $author
 * @property Comment[] $comments
 */
class Post extends \yii\db\ActiveRecord {
  /**
   * @inheritdoc
   */
  public static function tableName() {
    return 'post';
  }

  /**
   * @inheritdoc
   */
  public function rules() {
    return [
      [['author_id', 'title', 'img_name', 'demo_text', 'text', 'created_at', 'updated_at'], 'required'],
      [['author_id', 'likes', 'count_comments', 'created_at', 'updated_at'], 'integer'],
      [['text'], 'string'],
      [['title', 'img_name'], 'string', 'max' => 255],
      [['demo_text'], 'string', 'max' => 60],
      [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'id']],
    ];
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels() {
    return [
      'id' => 'ID',
      'author_id' => 'Author ID',
      'title' => 'Title',
      'img_name' => 'Img Name',
      'demo_text' => 'Demo Text',
      'text' => 'Text',
      'likes' => 'Likes',
      'count_comments' => 'Comments',
      'created_at' => 'Created At',
      'updated_at' => 'Updated At',
    ];
  }

  public function getAuthor() {
    return $this->hasOne(User::className(), ['uid' => 'author_id']);
  }

  public function getComments() {
    return $this->hasMany(Comment::className(), ['post_id' => 'id']);
  }

  public static function addComment($post_id) {
    $comment = Post::findOne($post_id);
    Yii::$app->db->createCommand()->update('post', ['count_comments' => $comment->count_comments + 1], "id = {$post_id}")->execute();
  }

}
