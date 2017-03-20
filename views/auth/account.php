<?php

use yii\widgets\Pjax;

\app\assets\MyAsset::register($this);

$this->title = 'Account'; ?>

<?php $this->beginBlock('header') ?>
<li><a href="<?= \yii\helpers\Url::to(['/site/index']) ?>">Головна</a></li>
<li><a href="<?= \yii\helpers\Url::to(['/reader/index']) ?>">Читач</a></li>
<li><a href="<?= \yii\helpers\Url::to(['/author/index']) ?>">Автор</a></li>
<li><a href="<?= \yii\helpers\Url::to(['/shop/index']) ?>" class="my-active">Магазин</a></li>
<li><a href="<?= \yii\helpers\Url::to(['/blog/index']) ?>">Блог</a></li>
<?php $this->endBlock() ?>

<?php if (isset($user)): ?>
  У нас уже есть пользователь с таким имейлом, подвердите что то у себя на почте и тогда вы залогинетесь:
  <br>
  <?= \yii\bootstrap\Html::a('ok', ['auth/ok']) ?>
<?php endif; ?>
