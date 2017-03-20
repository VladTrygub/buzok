<?php

/* @var $this yii\web\View */

use yii\bootstrap\Html;
use yii\helpers\Url;

\app\assets\BlogAsset::register($this);

$this->title = 'Buzok|Reader'; ?>

<?php $this->beginBlock('header') ?>
<li><a href="<?= \yii\helpers\Url::to(['/site/index']) ?>">Главная</a></li>
<li><a href="<?= \yii\helpers\Url::to(['/reader/index']) ?>">Читатель</a></li>
<li><a href="<?= Url::to(['/author/index']) ?>">Автор</a></li>
<li><a href="<?= Url::to(['/shop/index']) ?>">Магазин</a></li>
<li><a href="<?= Url::to(['/blog/index']) ?>" class="my-active">Блог</a></li>
<?php $this->endBlock() ?>

<div class="container">
  <div class="row">
    <div class="col-md-9">
      <div class="block-news">
        <div class="row">
          <div class="col-md-12">
            <?php if (!empty($posts)): ?>
              <?php foreach ($posts as $post): ?>
                <div class="news">
                  <a href="<?= Url::to(['blog/view', 'id' => $post->id]) ?>"><?= Html::img("@web/images/blog/{$post->img_name}") ?></a>
                  <div class="row">
                    <div class="col-md-8">
                      <a class="title" href="<?= Url::to(['blog/view', 'id' => $post->id]) ?>">
                        <h3><?= $post->title ?></h3>
                      </a>
                    </div>
                    <div class="col-md-4">
                      <a class="date" href="<?= Url::to(['blog/date', 'time' => $post->updated_at]) ?>">
                        <h3><?= date("Y-m-d H:i", $post->updated_at) ?></h3>
                      </a>
                    </div>
                  </div>
                  <p class="tags"></p>
                  <p class="demo-text"><?= mb_substr($post->text, 0, 300, 'UTF-8') . '...' ?></p>

                  <div class="likes-comments">
                    <?php if (Yii::$app->user->isGuest): // if user is guest ?>
                      <a class="login" href="#" data-id="<?= $post->id ?>">
                        <i class="fa fa-heart-o" aria-hidden="true"></i> <?= $post->likes ? $post->likes : '' ?>
                      </a>
                    <?php else: // if user logged in ?>
                      <?php if (!empty($likes)): // if user has likes on posts ?>
                        <?php if (in_array($post->id, $likes)): // if user likeed this post ?>
                          <a class="add-like liked" href="#" data-id="<?= $post->id ?>">
                            <i class="fa fa-heart" aria-hidden="true"></i> <?= $post->likes ? $post->likes : '' ?>
                          </a>
                        <?php else: // if user didn't make like on this post ?>
                          <a class="add-like" href="#" data-id="<?= $post->id ?>">
                            <i class="fa fa-heart-o" aria-hidden="true"></i> <?= $post->likes ? $post->likes : '' ?>
                          </a>
                        <?php endif; ?>
                      <?php else: ?>
                        <a class="add-like" href="#" data-id="<?= $post->id ?>">
                          <i class="fa fa-heart-o" aria-hidden="true"></i> <?= $post->likes ? $post->likes : '' ?>
                        </a>
                      <?php endif; ?>
                    <?php endif; ?>
                    <a href="<?= Url::toRoute(['blog/view', 'id' => $post->id, '#' => 'comments']) ?>">
                      <i class="fa fa-comments" aria-hidden="true"></i> <?= $post->count_comments ?>
                    </a>
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
    <div class="col-md-3">
      <div class="row">
<!--        <div class="col-md-12">-->
<!--          <div class="block-tags">-->
<!--            <h4>Поиск по тэгам</h4>-->
<!--            <p class="all-tags"></p>-->
<!--          </div>-->
<!--        </div>-->
<!--        <div class="col-md-12">-->
<!--          <div class="block-calendar">-->
<!--            <h4>Календарь</h4>-->
<!--          </div>-->
<!--        </div>-->
      </div>
    </div>
  </div>
</div>