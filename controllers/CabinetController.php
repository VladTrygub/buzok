<?php
/**
 * Created by PhpStorm.
 * User: VladT
 * Date: 20.01.2017
 * Time: 17:01
 */

namespace app\controllers;


use yii\web\Controller;

class CabinetController extends Controller {

  public function actionIndex() {
    $this->layout = "my";
    return $this->render('index');
  }

}