<?php

/* @var $this yii\web\View */

use yii\bootstrap\Html;
use yii\helpers\Url;

\app\assets\ReaderAsset::register($this);

$this->title = 'Buzok|Reader'; ?>

<?php $this->beginBlock('header') ?>
<li><a href="<?= \yii\helpers\Url::to(['/site/index']) ?>">Главная</a></li>
<li><a href="<?= \yii\helpers\Url::to(['/reader/index']) ?>" class="my-active">Читатель</a></li>
<li><a href="<?= Url::to(['/author/index']) ?>">Автор</a></li>
<li><a href="<?= Url::to(['/shop/index']) ?>">Магазин</a></li>
<li><a href="<?= Url::to(['/blog/index']) ?>">Блог</a></li>
<?php $this->endBlock() ?>

<div class="container">

  <div class="row">

    <div class="col-md-5">
      <div class="block-news">
        <h2 class="block-title"><a href="#">Статьи</a></h2>
        <?php if (isset($articles)): ?>
          <div class="row">
            <div class="col-md-12">
              <?php foreach ($articles as $article): ?>
                <div class="news">
                  <a href="<?= Url::to(['blog/view', 'id' => $article->id]) ?>"><?= Html::img("@web/images/blog/{$article->img_name}") ?></a>
                  <h4>
                    <a href="<?= Url::to(['blog/view', 'id' => $article->id]) ?>">
                      <p style="margin: 0 0 1px;"><?= $article->title ?></p>
                    </a>
                  </h4>
                  <p class="tags"><a href="#">#fjskl</a> <a href="#">#fjskl</a> <a href="#">#fjskl</a></p>
                  <div class="clip">
                    <?= mb_substr($article->text, 0, 170, 'UTF-8') . '...' ?>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        <?php else: ?>
          Статей нет
        <?php endif; ?>
      </div>
    </div>

    <div class="col-md-7">

      <div class="block-new">
        <div class="row">
          <div class="col-md-12">
            <h2 class="block-title"><a href="#">Новинки</a></h2>
            <?php if (isset($newBooks) && !empty($newBooks)): ?>
              <?php $i = 0 ?>
              <div class="carousel slide" id="myCarousel">
                <div class="carousel-inner">

                  <div class="item active">
                    <ul class="thumbnails">
                      <?php for (; $i < 4; $i++): ?>
                        <li class="span3">
                          <div class="thumbnail">
                            <a href="<?= Url::to(['shop/view', 'id' => $newBooks[$i]['id']]) ?>">
                              <?= Html::img("@web/images/books/{$newBooks[$i]['img_name']}") ?>
                            </a>
                          </div>
                          <div class="caption">
                            <h4 class="book-name">
                              <a href="<?= Url::to(['shop/view', 'id' => $newBooks[$i]['id']]) ?>">
                                <?= $newBooks[$i]['name'] ?>
                              </a>
                            </h4>
                          </div>
                        </li>
                      <?php endfor; ?>
                    </ul>
                  </div>

                  <div class="item">
                    <ul class="thumbnails">
                      <?php for (; $i < 8; $i++): ?>
                        <li class="span3">
                          <div class="thumbnail">
                            <a href="<?= Url::to(['shop/view', 'id' => $newBooks[$i]['id']]) ?>">
                              <?= Html::img("@web/images/books/{$newBooks[$i]['img_name']}") ?>
                            </a>
                          </div>
                          <div class="caption">
                            <h4 class="book-name">
                              <a href="<?= Url::to(['shop/view', 'id' => $newBooks[$i]['id']]) ?>">
                                <?= $newBooks[$i]['name'] ?>
                              </a>
                            </h4>
                          </div>
                        </li>
                      <?php endfor; ?>
                    </ul>
                  </div>

                  <div class="control-box">
                    <a href="#myCarousel" data-slide="prev" class="my-control">
                      <i class="fa fa-chevron-left" aria-hidden="true"></i>
                    </a>
                    <a href="#myCarousel" data-slide="next" class="my-control">
                      <i class="fa fa-chevron-right" aria-hidden="true"></i>
                    </a>
                  </div>

                </div>
              </div>
            <?php else: ?>
              None
            <?php endif; ?>
          </div>
        </div>
      </div>

      <div class="block-books">
        <div class="row">
          <div class="col-md-12">
            <h2 class="block-title"><a href="#">Популярные</a></h2>
            <?php if (isset($popularBooks) && !empty($popularBooks)): ?>
              <?php $i = 0 ?>
              <div class="carousel slide" id="myCarousel2">
                <div class="carousel-inner">

                  <div class="item active">
                    <ul class="thumbnails">
                      <?php for (; $i < 4; $i++): ?>
                        <li class="span3">
                          <div class="thumbnail">
                            <a href="<?= Url::to(['shop/view', 'id' => $popularBooks[$i]['id']]) ?>">
                              <?= Html::img("@web/images/books/{$popularBooks[$i]['img_name']}") ?>
                            </a>
                          </div>
                          <div class="caption">
                            <h4 class="book-name">
                              <a href="<?= Url::to(['shop/view', 'id' => $popularBooks[$i]['id']]) ?>">
                                <?= $popularBooks[$i]['name'] ?>
                              </a>
                            </h4>
                          </div>
                        </li>
                      <?php endfor; ?>
                    </ul>
                  </div>

                  <div class="item">
                    <ul class="thumbnails">
                      <?php for (; $i < 8; $i++): ?>
                        <li class="span3">
                          <div class="thumbnail">
                            <a href="<?= Url::to(['shop/view', 'id' => $popularBooks[$i]['id']]) ?>">
                              <?= Html::img("@web/images/books/{$popularBooks[$i]['img_name']}") ?>
                            </a>
                          </div>
                          <div class="caption">
                            <h4 class="book-name">
                              <a href="<?= Url::to(['shop/view', 'id' => $popularBooks[$i]['id']]) ?>">
                                <?= $popularBooks[$i]['name'] ?>
                              </a>
                            </h4>
                          </div>
                        </li>
                      <?php endfor; ?>
                    </ul>
                  </div>

                  <div class="control-box">
                    <a href="#myCarousel2" data-slide="prev" class="my-control">
                      <i class="fa fa-chevron-left" aria-hidden="true"></i>
                    </a>
                    <a href="#myCarousel2" data-slide="next" class="my-control">
                      <i class="fa fa-chevron-right" aria-hidden="true"></i>
                    </a>
                  </div>

                </div>
              </div>
            <?php else: ?>
              None
            <?php endif; ?>
          </div>
        </div>
      </div>

    </div>

  </div>
</div>
