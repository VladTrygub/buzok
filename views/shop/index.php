<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use app\components\MenuWidget;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

\app\assets\ShopAsset::register($this);

$this->title = 'Buzok|Reader'; ?>

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
      <div class="filter-block">
        <ul class="filter">
          <?php if (isset($data)): ?>
            <?php foreach ($data as $d): ?>
              <?= $d['name'] ?> ,
            <?php endforeach; ?>
          <?php endif; ?>
          <?php Pjax::begin(); ?>
          <?php if (isset($categories)): ?>
            <form action="/shop/filter/params" method="get">

              <li>
                <p class="onclick-1">Литература <i class="fa fa-chevron-right" aria-hidden="true"></i></p>
                <div class="filters filters-1">
                  <?php foreach ($categories[1] as $category): ?>
                    <?php foreach ($category as $item): ?>
                      <div class="checkbox">
                        <input class="checkbox-input" type="checkbox" id="<?= $item['name'] ?>"
                          <?= isset($_GET['literature'][$item['id']]) ? 'checked' : '' ?>
                               name="literature[<?= $item['id'] ?>]"
                               value="<?= $item['id'] ?>">
                        <label for="<?= $item['name'] ?>">
                          <?= $item['name'] ?>
                        </label>
                      </div>
                    <?php endforeach; ?>
                  <?php endforeach; ?>
                </div>
              </li>

              <hr>

              <li>
                <p class="onclick-2">Жанр <i class="fa fa-chevron-right" aria-hidden="true"></i></p>
                <div class="filters filters-2">
                  <?php foreach ($categories[2] as $category): ?>
                    <?php foreach ($category as $item): ?>
                      <div class="checkbox">
                        <input class="checkbox-input" type="checkbox" id="<?= $item['name'] ?>"
                          <?= isset($_GET['genre'][$item['id']]) ? 'checked' : '' ?>
                               name="genre[<?= $item['id'] ?>]"
                               value="<?= $item['id'] ?>">
                        <label for="<?= $item['name'] ?>">
                          <?= $item['name'] ?>
                        </label>
                      </div>
                    <?php endforeach; ?>
                  <?php endforeach; ?>
                </div>
              </li>

              <hr>

              <li>
                <p class="onclick-3">Тема <i class="fa fa-chevron-right" aria-hidden="true"></i></p>
                <div class="filters filters-3">
                  <?php foreach ($categories[3] as $category): ?>
                    <?php foreach ($category as $item): ?>
                      <div class="checkbox">
                        <input class="checkbox-input" type="checkbox" id="<?= $item['name'] ?>"
                          <?= isset($_GET['theme'][$item['id']]) ? 'checked' : '' ?>
                               name="theme[<?= $item['id'] ?>]"
                               value="<?= $item['id'] ?>">
                        <label for="<?= $item['name'] ?>">
                          <?= $item['name'] ?>
                        </label>
                      </div>
                    <?php endforeach; ?>
                  <?php endforeach; ?>
                </div>
              </li>

              <hr>

              <li>
                <p class="onclick-4">Стиль <i class="fa fa-chevron-right" aria-hidden="true"></i></p>
                <div class="filters filters-4">
                  <?php foreach ($categories[4] as $category): ?>
                    <?php foreach ($category as $item): ?>
                      <div class="checkbox">
                        <input class="checkbox-input" type="checkbox" id="<?= $item['name'] ?>"
                          <?= isset($_GET['style'][$item['id']]) ? 'checked' : '' ?>
                               name="style[<?= $item['id'] ?>]"
                               value="<?= $item['id'] ?>">
                        <label for="<?= $item['name'] ?>">
                          <?= $item['name'] ?>
                        </label>
                      </div>
                    <?php endforeach; ?>
                  <?php endforeach; ?>
                </div>
              </li>

              <hr>

              <input class="search" value="Применить" type="submit">

            </form>
          <?php endif; ?>
        </ul>
      </div>
    </div>

    <div class="col-md-9">
      <div class="row">

        <?php if (isset($categoryNames)): ?>
          <div class="col-md-12 filter-info-padding">
            <div class="filter-info">
              <?php foreach ($categoryNames as $name): ?>
                <a href="#">
                  <p><?= $name ?> <i class="fa fa-times" aria-hidden="true"></i></p>
                </a>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endif; ?>

        <?php if (!empty($books)): ?>
          <?php foreach ($books as $book): ?>
            <div class="col-md-4">
              <div class="item">
                <a href="<?= Url::to(['shop/view', 'id' => $book['id']]) ?>"><?= Html::img("@web/images/books/{$book['img_name']}") ?></a>
                <h4><a href="<?= Url::to(['shop/view', 'id' => $book['id']]) ?>"><?= $book['name'] ?></a></h4>
<!--                <div class="tags">-->
<!--                  <p><a href="#">#hi</a> <a href="#">#lkshdjf</a> <a href="#">#fsd</a></p>-->
<!--                </div>-->
                <div class="item-price">
                  <p><?= $book['price'] ?> грн</p>
                  <?php
                  $bookKind = 'none';
                  if ($book['count_paper_books'] > 0) $bookKind = 'pbook';
                  if ($book['is_ebook'] == 1) $bookKind = 'ebook';
                  ?>
                  <a class="buy add-to-cart"
                     href="#"
                     data-id="<?= $book['id'] ?>"
                     data-kind="<?= $bookKind ?>"
                  >Купить</a>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          Магазин пуст
        <?php endif; ?>

        <?php Pjax::end(); ?>
      </div>
    </div>
  </div>

</div>