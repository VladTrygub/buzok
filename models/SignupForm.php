<?php

namespace app\models;


use yii\base\Model;

class SignupForm extends Model {

  public $username;
  public $email;
  public $password;

  public function rules() {
    return [
      [['username', 'email', 'password'], 'required'],
      [['username'], 'string'],
      [['email'], 'email'],
      [['email'], 'unique', 'targetClass' => 'app\models\User', 'targetAttribute' => 'email']
    ];
  }

  public function signup() {
    if ($this->validate()) {
      $user = new User();
      $user->attributes = $this->attributes;
      $user->status = 1;
      $user->isAdmin = 0;
      $time = time();
      $user->created_at = $time;
      $user->updated_at = $time;
      return $user->save();
    }
  }

}