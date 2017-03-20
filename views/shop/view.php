<?php

/* @var $this yii\web\View */

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
  <div class="block-book">
    <div class="row">
      <div class="col-md-3">
        <div class="block-img">
          <a href="#">
            <?= \yii\bootstrap\Html::img("@web/images/books/{$book->img_name}") ?>
          </a>
        </div>
      </div>

      <div class="col-md-9">
        <div class="info-block">
          <div class="info">
            <h3><a href="#"><?= $book->name ?></a></h3>
<!--            <div class="book-tags">-->
<!--              <p>-->
<!--                <a href="#">#hi</a> <a href="#">#lkshdjf</a> <a href="#">#fsd</a>-->
<!--              </p>-->
<!--            </div>-->
            <div class="block-price-buy">
              <p class="price">Price: <?= $book->price ?>грн</p>
              <a href="#"><p class="buy">Купить</p></a>
            </div>
          </div>
          <div class="accordion">
            <div class="section full-description active">
              <h4>Описание:</h4>
              <p><?= $book->description ?></p>
            </div>
            <div class="section comments-block">
              <h4>Отзывы:</h4>
              <p>...</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>