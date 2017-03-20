<?php

/* @var $this yii\web\View */

use app\components\MenuWidget;
use yii\helpers\Url;

\app\assets\ShopAsset::register($this);

$this->title = 'Buzok|Book'; ?>

<?php $this->beginBlock('header') ?>
<li><a href="<?= \yii\helpers\Url::to(['/site/index']) ?>">Главная</a></li>
<li><a href="<?= \yii\helpers\Url::to(['/reader/index']) ?>">Читатель</a></li>
<li><a href="<?= \yii\helpers\Url::to(['/author/index']) ?>">Автор</a></li>
<li><a href="<?= \yii\helpers\Url::to(['/shop/index']) ?>" class="my-active">Магазин</a></li>
<li><a href="<?= \yii\helpers\Url::to(['/blog/index']) ?>">Блог</a></li>
<?php $this->endBlock() ?>

<div class="container">
  <div class="row">
    <div class="col-md-3">
      <ul class="filter">
        <?= MenuWidget::widget() ?>
      </ul>
    </div>

    <div class="col-md-9">
      <div class="row">
        <?php if (!empty($books)): ?>
          <?php foreach ($books as $book): ?>
            <div class="col-md-4">
              <div class="item">
                <a href="<?= Url::to(['shop/view', 'id' => $book->id]) ?>"><?= Html::img("@web/images/books/{$book->img_name}") ?></a>
                <h4><a href="<?= Url::to(['shop/view', 'id' => $book->id]) ?>"><?= $book->name ?></a></h4>
<!--                <div class="tags">-->
<!--                  <p><a href="#">#hi</a> <a href="#">#lkshdjf</a> <a href="#">#fsd</a></p>-->
<!--                </div>-->
                <div class="item-price">
                  <p><?= $book->price ?> грн</p>
                  <a class="buy add-to-cart" href="#" data-id="<?= $book['id'] ?>">Купить</a>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          none
        <?php endif; ?>
      </div>
    </div>
  </div>

</div>

