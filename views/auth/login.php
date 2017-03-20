<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

\app\assets\MyAsset::register($this);

$this->title = 'Login'; ?>

<?php $this->beginBlock('header') ?>
<li><a href="<?= \yii\helpers\Url::to(['/site/index']) ?>">Головна</a></li>
<li><a href="<?= \yii\helpers\Url::to(['/reader/index']) ?>">Читач</a></li>
<li><a href="<?= \yii\helpers\Url::to(['/author/index']) ?>">Автор</a></li>
<li><a href="<?= \yii\helpers\Url::to(['/shop/index']) ?>">Магазин</a></li>
<li><a href="<?= \yii\helpers\Url::to(['/blog/index']) ?>">Блог</a></li>
<?php $this->endBlock() ?>

<div class="site-login">
  <h1><?= Html::encode($this->title) ?></h1>

  <hr>
  <?php
  if (Yii::$app->getSession()->hasFlash('error')) {
    echo '<div class="alert alert-danger">' . Yii::$app->getSession()->getFlash('error') . '</div>';
  }
  if (Yii::$app->getSession()->hasFlash('success-send-email')) {
    echo '<div class="alert alert-success">' . Yii::$app->getSession()->getFlash('success-send-email') . '</div>';
  }
  if (Yii::$app->getSession()->hasFlash('error-send-email')) {
    echo '<div class="alert alert-danger">' . Yii::$app->getSession()->getFlash(' error-send-email') . '</div>';
  }
  ?>



  <?php if (isset($model)): ?>
    <p class="lead">Do you already have an account on one of these sites? Click the logo to log in with it here:</p>
    <?php echo \nodge\eauth\Widget::widget(array('action' => 'auth/login')); ?>

    <hr>

    <p>Please fill out the following fields to login:</p>

    <?php $form = ActiveForm::begin([
      'id' => 'login-form',
      'layout' => 'horizontal',
      'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
        'labelOptions' => ['class' => 'col-lg-1 control-label'],
      ],
    ]); ?>

    <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <?= $form->field($model, 'rememberMe')->checkbox([
      'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
    ]) ?>

    <div class="form-group">
      <div class="col-lg-offset-1 col-lg-11">
        <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        <?= Html::a('Signup', ['auth/signup'], ['class' => 'btn btn-default']) ?>
      </div>
    </div>

    <?php ActiveForm::end(); ?>
  <?php endif; ?>

</div>
