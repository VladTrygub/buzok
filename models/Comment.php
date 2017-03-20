<?php

namespace app\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "comment".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $post_id
 * @property string $text
 * @property integer $likes
 * @property integer $dislikes
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Post $post
 * @property User $user
 */
class Comment extends \yii\db\ActiveRecord {
  /**
   * @inheritdoc
   */
  public static function tableName() {
    return 'comment';
  }

  /**
   * @inheritdoc
   */
  public function rules() {
    return [
      [['user_id', 'post_id', 'text', 'created_at', 'updated_at'], 'required'],
      [['user_id', 'post_id', 'likes', 'dislikes', 'created_at', 'updated_at'], 'integer'],
      [['text'], 'string'],
      [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['post_id' => 'id']],
      [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'uid']],
    ];
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels() {
    return [
      'id' => 'ID',
      'user_id' => 'User ID',
      'post_id' => 'Post ID',
      'text' => 'Text',
      'likes' => 'Likes',
      'dislikes' => 'Dislikes',
      'created_at' => 'Created At',
      'updated_at' => 'Updated At',
    ];
  }

  public function getPost() {
    return $this->hasOne(Post::className(), ['id' => 'post_id']);
  }

  public function getUser() {
    return $this->hasOne(User::className(), ['uid' => 'user_id']);
  }

  public static function getLikes($comment_id) {
//    $res = Yii::$app->db->createCommand("
//            SELECT likes
//            FROM comment
//            WHERE id = {$comment_id}
//    ")->queryColumn();
    return Comment::findOne($comment_id)->likes;
  }

  public static function getDislikes($comment_id) {
//    return Yii::$app->db->createCommand("
//            SELECT dislikes
//            FROM comment
//            WHERE id = {$comment_id}
//    ")->execute();
    return Comment::findOne($comment_id)->dislikes;
  }

  public static function updateRateUp($comment_id, $rates) {
    $rates = $rates <= 0 ? 0 : $rates;
    return Yii::$app->db->createCommand()->update(
      'comment',
      ['likes' => $rates],
      "id = {$comment_id}"
    )->execute();
  }

  public static function updateRateDown($comment_id, $rates) {
    $rates = $rates <= 0 ? 0 : $rates;
    return Yii::$app->db->createCommand()->update(
      'comment',
      ['dislikes' => $rates],
      "id = {$comment_id}"
    )->execute();
  }

}
