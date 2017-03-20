<?php

use dosamigos\ckeditor\CKEditor;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'name')->textInput() ?>

<?= $form->field($model, 'text')->widget(CKEditor::className(), [
  'options' => ['rows' => 6],
  'preset' => 'full'
]) ?>

<?= Html::submitButton('save', ['name' => 'save-button']) ?>

<?php ActiveForm::end(); ?>