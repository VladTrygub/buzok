<?php

namespace app\models;

use phpDocumentor\Reflection\Types\Array_;
use Yii;

/**
 * This is the model class for table "user_comment_rates_down".
 *
 * @property integer $comment_id
 * @property integer $user_id
 *
 * @property Comment $comment
 * @property User $user
 */
class UserCommentRatesDown extends \yii\db\ActiveRecord {
  /**
   * @inheritdoc
   */
  public static function tableName() {
    return 'user_comment_rates_down';
  }

  /**
   * @inheritdoc
   */
  public function rules() {
    return [
      [['comment_id', 'user_id'], 'required'],
      [['comment_id', 'user_id'], 'integer'],
      [['comment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Comment::className(), 'targetAttribute' => ['comment_id' => 'id']],
      [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'uid']],
    ];
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels() {
    return [
      'comment_id' => 'Comment ID',
      'user_id' => 'User ID',
    ];
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getComment() {
    return $this->hasOne(Comment::className(), ['id' => 'comment_id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getUser() {
    return $this->hasOne(User::className(), ['uid' => 'user_id']);
  }

  /**
   * @return Array_
   */
  public static function getRatesDownByUserID($user_id) {
    $ratesDown = UserCommentRatesDown::find()->where(['user_id' => $user_id])->asArray()->all();
    $result = [];
    foreach ($ratesDown as $rate)
      $result[] = $rate['comment_id'];
    return $result;
  }

  public static function deleteRate($comment_id, $user_id) {
    return Yii::$app->db->createCommand()->delete(
      'user_comment_rates_down',
      "comment_id = {$comment_id} AND user_id = {$user_id}"
    )->execute();
  }

}
