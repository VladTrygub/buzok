<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\widgets\Pjax;

\app\assets\AuthorAsset::register($this);

$this->title = 'Buzok|Reader'; ?>

<?php $this->beginBlock('header') ?>
<li><a href="<?= Url::to(['/site/index']) ?>">Главная</a></li>
<li><a href="<?= Url::to(['/reader/index']) ?>">Читатель</a></li>
<li><a href="<?= Url::to(['/author/index']) ?>" class="my-active">Автор</a></li>
<li><a href="<?= Url::to(['/shop/index']) ?>">Магазин</a></li>
<li><a href="<?= Url::to(['/blog/index']) ?>">Блог</a></li>
<?php $this->endBlock() ?>



<?php Pjax::begin() ?>

<?php
if (Yii::$app->getSession()->hasFlash('success-create/update-author-book')) {
  echo
    '<div class="alert alert-success">' .
    Yii::$app->getSession()->getFlash('success-create/update-author-book') .
    '</div>';
}
if (Yii::$app->getSession()->hasFlash('error-create/update-author-book')) {
  echo
    '<div class="alert alert-danger">' .
    Yii::$app->getSession()->getFlash('error-create/update-author-book') .
    '</div>';
}
?>

<div class="container">
  <div class="row">
    <div class="col-md-2">
      <div class="drafts">
        <p>Мои черновики</p>

        <?php if (isset($authorBooks) && !empty($authorBooks)): ?>
          <?php foreach ($authorBooks as $book): ?>
            <div class="draft">
              <a href="<?= Url::to(['author/update', 'id' => $book->id]) ?>">
                <p><?= $book->name ?></p>
              </a>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
        <?php if (Yii::$app->user->isGuest): ?>
        <a class="login" href="#">
          <p>Создать книгу</p>
          <?php else: ?>
          <a href="<?= Url::to('author/create') ?>">
            <p>Создать книгу</p>
            <?php endif; ?>
          </a>
          <?php endif; ?>

      </div>
    </div>

    <div class="col-md-10">
      <div class="create-book">
        <?php if (isset($create)): ?>
          <?= $this->render('_form', compact('model', 'create')) ?>
        <?php elseif (isset($authorBookId)): ?>
          <?= $this->render('_form', compact('model', 'authorBookId')) ?>
        <?php else: ?>

        <?php if (Yii::$app->user->isGuest): ?>
        <a class="login" href="#">
          <p>Войти</p>
          <?php else: ?>
          <a href="<?= Url::to('author/create') ?>">
            <p>Создать книгу</p>
            <?php endif; ?>
          </a>

          <?php endif; ?>
      </div>
    </div>

  </div>
</div>

<?php Pjax::end() ?>



