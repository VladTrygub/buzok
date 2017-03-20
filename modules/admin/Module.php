<?php

namespace app\modules\admin;
use Yii;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

/**
 * admin module definition class
 */
class Module extends \yii\base\Module {

  public $layout = '/admin';

  /**
   * @inheritdoc
   */
  public $controllerNamespace = 'app\modules\admin\controllers';

  /**
   * @inheritdoc
   */
  public function init() {
    parent::init();

    // custom initialization code goes here
  }

  public function behaviors() {
    return [
      'access' => [
        'class' => AccessControl::className(),
        'denyCallback' => function($rule, $action) {
          throw new NotFoundHttpException();
        },
        'rules' => [
          [
            'allow' => true,
            'matchCallback' => function($rule, $action) {
              return isset(Yii::$app->user->identity->isMyAdmin) ? Yii::$app->user->identity->isMyAdmin : 0;
            }
          ]
        ]
      ]
    ];
  }

}