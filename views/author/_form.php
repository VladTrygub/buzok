<?php

use dosamigos\ckeditor\CKEditor;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

$form = ActiveForm::begin(); ?>

<?= $form->field($model, 'name')->textInput() ?>
<?= $form->field($model, 'description')->textInput() ?>
<?= $form->field($model, 'text')->widget(CKEditor::className(), [
  'options' => ['rows' => 6],
  'preset' => 'full'
]) ?>


<div class="buttons">
  <?php if (isset($authorBookId)): ?>
    <?= Html::hiddenInput('author-book-id', $authorBookId) ?>
    <?= Html::submitButton('update', ['name' => 'update-button', 'value' => 'update']) ?>
    <?= Html::submitButton('delete', ['name' => 'delete-button', 'value' => 'delete']) ?>
  <?php endif; ?>

  <?php if (isset($create)): ?>
    <?= Html::submitButton('save', ['name' => 'save-button', 'value' => 'save']) ?>
    <?= Html::submitButton('clear', ['name' => 'clear-button', 'value' => 'clear']) ?>
  <?php endif; ?>
</div>

<?php ActiveForm::end(); ?>
