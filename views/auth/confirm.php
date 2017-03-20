<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\EmailForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

\app\assets\MyAsset::register($this);

$this->title = 'Activate';
$identity = Yii::$app->getSession()->get('identity');
$model = new \app\models\EmailForm(); ?>

<?php $this->beginBlock('header') ?>
<li><a href="<?= \yii\helpers\Url::to(['/site/index']) ?>">Головна</a></li>
<li><a href="<?= \yii\helpers\Url::to(['/reader/index']) ?>">Читач</a></li>
<li><a href="<?= \yii\helpers\Url::to(['/author/index']) ?>">Автор</a></li>
<li><a href="<?= \yii\helpers\Url::to(['/shop/index']) ?>" class="my-active">Магазин</a></li>
<li><a href="<?= \yii\helpers\Url::to(['/blog/index']) ?>">Блог</a></li>
<?php $this->endBlock() ?>

<div class="site-login">
  <h1><?= Html::encode($this->title) ?></h1>

  Activate your email plz
  <?php $form = ActiveForm::begin([
    'fieldConfig' => [
      'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
      'labelOptions' => ['class' => 'col-lg-1 control-label'],
    ],
  ]); ?>
  <?= $form->field($model, 'email')->input('email'); ?>
  <br><br>
  <div class="form-group">
    <div class="col-lg-offset-1 col-lg-11">
      <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
    </div>
  </div>
  <?php ActiveForm::end() ?>
</div>
