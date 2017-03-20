<?php
/**
 * Created by PhpStorm.
 * User: VladT
 * Date: 13.12.2016
 * Time: 18:31
 */

namespace app\models;


use yii\base\Model;

class EmailForm extends Model {

  public $email;

  public function rules() {
    return [
      ['email', 'required']
    ];
  }

}