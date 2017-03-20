<?php

namespace app\models;

use Yii;
use yii\base\ErrorException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property integer $uid
 * @property string $uname
 * @property string $password
 * @property string $email
 * @property string $img_name
 * @property string $gender
 * @property integer $status
 * @property integer $isAdmin
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Auth[] $auths
 */
//class User extends \yii\base\Object implements \yii\web\IdentityInterface {
class User extends ActiveRecord implements \yii\web\IdentityInterface {
  public $id;
  public $username;
  public $authKey;
  public $isMyAdmin;
  /**
   * @var array EAuth attributes
   */
  public $profile;
  public static $users = [];

  public static function tableName() {
    return 'user';
  }

  public function rules()
  {
    return [
      [['uname', 'password', 'created_at', 'updated_at'], 'required'],
      [['status', 'created_at', 'updated_at', 'isAdmin'], 'integer'],
      [['created_at', 'updated_at'], 'default', 'value' => time()],
      [['uname', 'password', 'email', 'img_name', 'gender'], 'string', 'max' => 255],
    ];
  }

  public function attributeLabels()
  {
    return [
      'uid' => 'ID',
      'uname' => 'Username',
      'password' => 'Password',
      'email' => 'Email',
      'img_name' => 'Avatar',
      'gender' => 'Gender',
      'status' => 'Status',
      'isAdmin' => 'Is Admin',
      'created_at' => 'Created At',
      'updated_at' => 'Updated At',
    ];
  }

  public function getAuths()
  {
    return $this->hasMany(Auth::className(), ['user_id' => 'uid']);
  }

  public static function findIdentity($id) {
    if (Yii::$app->getSession()->has('user-' . $id)) {
      return new self(Yii::$app->getSession()->get('user-' . $id));
    } else {
      return isset(self::$users[$id]) ? new self(self::$users[$id]) : null;
    }
  }

  public static function findByUsername($username) {
    foreach (self::$users as $user) {
      if (strcasecmp($user['username'], $username) === 0) {
        return new self($user);
      }
    }
    return null;
  }

  public static function findByEmail($email) {
    return User::find()->where(['email' => $email])->one();
  }

  public static function makeIdentity($uid, $username, $isAdmin) {
    $id = 'usual-' . $uid;
    $attributes = [
      'id' => $id,
      'username' => $username,
      'authKey' => md5($id),
      'isMyAdmin' => $isAdmin,
    ];
    Yii::$app->getSession()->set('user-' . $id, $attributes);
    return new self($attributes);
  }

  /**
   * @param \nodge\eauth\ServiceBase $service
   * @return User
   * @throws ErrorException
   */
  public static function findByEAuth($service) {
    if (!$service->getIsAuthenticated()) {
      throw new ErrorException('EAuth user should be authenticated before creating identity.');
    }
    $id = $service->getServiceName() . '-' . $service->getId();
    $attributes = [
      'id' => $id,
      'username' => $service->getAttribute('name'),
      'authKey' => md5($id),
      'profile' => $service->getAttributes(),
    ];
    $attributes['profile']['service'] = $service->getServiceName();
    Yii::$app->getSession()->set('user-' . $id, $attributes);
    return new self($attributes);
  }

  /**
   * @param $status Boolean
   * @param $attributes
   * @param $user User
   */
  public function saveUserAndAuth($status, $identity) {
    $this->uname = $identity->username;
    $this->password = $this->generateRandomString();
    $this->gender = isset($identity->profile['gender']) ? $identity->profile['gender'] : null;
    $this->email = isset($identity->profile['email']) ? $identity->profile['email'] : null;
    $this->status = $status;
    $this->isAdmin = 0;
    $this->created_at = time();
    $this->updated_at = time();
    $this->save();
    $this->saveAuth($identity, $this->uid);
  }

  private function saveAuth($identity, $userID) {
    $auth = new Auth();
    $auth->user_id = $userID;
    $auth->auth_key = $identity->authKey;
    $auth->source = $identity->profile['service'];
    $auth->source_id = $identity->profile['id'];
    $auth->save();
  }

  private static function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }

  public function getUserId() {
    return $this->id;
  }

  public function getAuthKey() {
    return $this->authKey;
  }

  public function validateAuthKey($authKey) {
    return $this->authKey === $authKey;
  }

  public function validatePassword($password) {
    return $this->password === $password;
  }

  /**
   * @param $uname string
   * @return integer | false
   */
  public static function getUid() {
    if (Yii::$app->user->isGuest) return false;
    $uname = Yii::$app->user->identity->username;
    return User::find()->where(['uname' => $uname])->one()->uid;
  }

  public static function findIdentityByAccessToken($token, $type = null) { return null; }

}

