<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "auth".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $auth_key
 * @property string $source
 * @property string $source_id
 * @property User $user
 */
class Auth extends \yii\db\ActiveRecord {
  /**
   * @inheritdoc
   */
  public static function tableName() {
    return 'auth';
  }

  /**
   * @inheritdoc
   */
  public function rules() {
    return [
      [['user_id', 'auth_key', 'source', 'source_id'], 'required'],
      [['user_id', 'source_id'], 'integer'],
      [['source', 'auth_key'], 'string', 'max' => 255],
    ];
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels() {
    return [
      'id' => 'ID',
      'user_id' => 'User ID',
      'auth_key' => 'Auth Key',
      'source' => 'Source',
      'source_id' => 'Source ID',
    ];
  }

  public function getUser() {
    return $this->hasOne(User::className(), ['uid' => 'user_id']);
  }
}
