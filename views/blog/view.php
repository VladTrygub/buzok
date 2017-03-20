<?php

/* @var $this yii\web\View */

use yii\bootstrap\Html;
use yii\helpers\Url;

\app\assets\BlogAsset::register($this);

$this->title = 'Buzok|Reader'; ?>

<?php $this->beginBlock('header') ?>
<li><a href="<?= \yii\helpers\Url::to(['/site/index']) ?>">Главная</a></li>
<li><a href="<?= \yii\helpers\Url::to(['/reader/index']) ?>">Читатель</a></li>
<li><a href="<?= \yii\helpers\Url::to(['/author/index']) ?>">Автор</a></li>
<li><a href="<?= \yii\helpers\Url::to(['/shop/index']) ?>">Магазин</a></li>
<li><a href="<?= \yii\helpers\Url::to(['/blog/index']) ?>" class="my-active">Блог</a></li>
<?php $this->endBlock() ?>

<div class="container">
  <div class="row">
    <div class="col-md-9">
      <div class="block-post">
        <div class="row">

          <div class="col-md-12">
            <div class="article">
              <div class="row">
                <div class="col-md-8">
                  <h3 class="post-title"><?= $post->title ?></h3>
                </div>
                <div class="col-md-4">
                  <a class="post-date" href="<?= Url::to(['blog/date', 'time' => $post->updated_at]) ?>">
                    <h3><?= date("Y-m-d H:i", $post->updated_at) ?></h3>
                  </a>
                </div>
              </div>

              <?= Html::img("@web/images/blog/{$post->img_name}") ?>
              <p class="tags"></p>
              <p><?= $post->text ?></p>
              <div class="post-likes-comments">
                <?php if (Yii::$app->user->isGuest): ?>
                  <a class="login" href="#" data-id="<?= $post->id ?>">
                    <i class="fa fa-heart-o" aria-hidden="true"></i> <?= $post->likes ?>
                  </a>
                <?php else: ?>
                  <?php if (isset($liked)): ?>
                    <a class="add-like liked" href="#" data-id="<?= $post->id ?>">
                      <i class="fa fa-heart" aria-hidden="true"></i> <?= $post->likes ?>
                    </a>
                  <?php else: ?>
                    <a class="add-like" href="#" data-id="<?= $post->id ?>">
                      <i class="fa fa-heart-o" aria-hidden="true"></i> <?= $post->likes ?>
                    </a>
                  <?php endif; ?>
                <?php endif; ?>
                <a class="count-comments" href="<?= Url::toRoute(['blog/view', 'id' => $post->id, '#' => 'comments']) ?>"><i class="fa fa-comments" aria-hidden="true"></i> <?= $post->count_comments ?></a>
              </div>
            </div>
            <div id="comments" class="comments">
              <?php if (isset($comments)): ?>
                <?php foreach ($comments as $comment): ?>
                  <div class="comment">
                    <div class="comment-left">
                      <div class="userava">
                        <a class="ava" href="#"><?= Html::img("@web/images/avatar/{$comment['user']['img_name']}") ?></a>
                      </div>
                    </div>
                    <div class="comment-right">
                      <div class="comment-top">
                        <a href="#" class="username"><p><?= $comment['user']['uname'] ?></p></a>
                        <p class="comment-text">
                          <?= $comment->text ?>
                        </p>
                      </div>
                      <div class="comment-bottom">
                        <p class="comment-date" href="#"><?= date("Y-m-d H:i:s", $comment->created_at) ?></p>
                        <div class="comment-likes">
                          <?php if (Yii::$app->user->isGuest): ?>
                            <a class="login" href="#" data-id="<?= $comment->id ?>">
                              <p><i class="fa fa-thumbs-o-up" aria-hidden="true"></i><?= $comment->likes ? $comment->likes : '' ?></p>
                            </a>
                            <a class="login" href="#" data-id="<?= $comment->id ?>">
                              <p><i class="fa fa-thumbs-o-down" aria-hidden="true"></i> <?= $comment->dislikes ? $comment->dislikes : '' ?></p>
                            </a>
                          <?php elseif ($user_id == $comment->user_id): ?>
                            <a class="deny-rate" href="#">
                              <p><i class="fa fa-thumbs-o-up" aria-hidden="true"></i><?= $comment->likes ? $comment->likes : '' ?></p>
                            </a>
                            <a class="deny-rate" href="#">
                              <p><i class="fa fa-thumbs-o-down" aria-hidden="true"></i> <?= $comment->dislikes ? $comment->dislikes : '' ?></p>
                            </a>
                          <?php else: ?>
                            <?php if (isset($ratesUp) && !empty($ratesUp)): ?>
                              <?php if (in_array($comment->id, $ratesUp)): ?>
                                <a class="rate-up rated" href="#" data-id="<?= $comment->id ?>">
                                  <p><i class="fa fa-thumbs-up" aria-hidden="true"></i> <?= $comment->likes ? $comment->likes : '' ?></p>
                                </a>
                              <?php else: ?>
                                <a class="rate-up" href="#" data-id="<?= $comment->id ?>">
                                  <p><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> <?= $comment->likes ? $comment->likes : '' ?></p>
                                </a>
                              <?php endif; ?>
                            <?php else: ?>
                              <a class="rate-up" href="#" data-id="<?= $comment->id ?>">
                                <p><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> <?= $comment->likes ? $comment->likes : '' ?></p>
                              </a>
                            <?php endif; ?>
                            <?php if (isset($ratesDown) && !empty($ratesDown)): ?>
                              <?php if (in_array($comment->id, $ratesDown)): ?>
                                <a class="rate-down rated" href="#" data-id="<?= $comment->id ?>">
                                  <p><i class="fa fa-thumbs-down" aria-hidden="true"></i> <?= $comment->dislikes ? $comment->dislikes : '' ?></p>
                                </a>
                              <?php else: ?>
                                <a class="rate-down" href="#" data-id="<?= $comment->id ?>">
                                  <p><i class="fa fa-thumbs-o-down" aria-hidden="true"></i> <?= $comment->dislikes ? $comment->dislikes : '' ?></p>
                                </a>
                              <?php endif; ?>
                            <?php else: ?>
                              <a class="rate-down" href="#" data-id="<?= $comment->id ?>">
                                <p><i class="fa fa-thumbs-o-down" aria-hidden="true"></i> <?= $comment->dislikes ? $comment->dislikes : '' ?></p>
                              </a>
                            <?php endif; ?>
                          <?php endif; ?>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
              <?php else: ?>
                no comments
              <?php endif; ?>
            </div>
          </div>

          <?php if (!Yii::$app->user->isGuest): ?>
            <div class="col-md-offset-2 col-md-10">
              <div class="input-comment">
                <textarea name="comment" id="add-comment" cols="40" rows="3"></textarea>
                <div class="add-comment-buttons">
                  <a href="#" class="add-user-comment" data-post-id="<?= $post_id ?>"><p>Add</p></a>
                  <a href="#" class="cancel-user-comment"><p>Cancel</p></a>
                </div>
              </div>
            </div>
          <?php endif; ?>

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

