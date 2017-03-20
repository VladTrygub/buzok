<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

\app\assets\AuthorAsset::register($this);

$this->title = 'Buzok|Reader'; ?>

<?php $this->beginBlock('header') ?>
  <li><a href="<?= Url::to(['/site/index']) ?>">Главная</a></li>
  <li><a href="<?= Url::to(['/reader/index']) ?>">Читатель</a></li>
  <li><a href="<?= Url::to(['/author/index']) ?>" class="my-active">Автор</a></li>
  <li><a href="<?= Url::to(['/shop/index']) ?>">Магазин</a></li>
  <li><a href="<?= Url::to(['/blog/index']) ?>">Блог</a></li>
<?php $this->endBlock() ?>


