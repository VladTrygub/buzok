<?php
use yii\helpers\Html;

?>

<?php if (isset($comment)): ?>
  <div class="comment new">

    <div class="comment-left">
      <div class="userava">
        <a class="ava" href="#"><?= Html::img("@web/images/avatar/{$comment->user->img_name}") ?></a>
      </div>
    </div>

    <div class="comment-right">
      <div class="comment-top">
        <a href="#" class="username"><p><?= $comment->user->uname ?></p></a>
        <p class="comment-text">
          <?= $comment->text ?>
        </p>
      </div>

      <div class="comment-bottom">
        <p class="comment-date" href="#"><?= date("Y-m-d H:i:s", $comment->created_at) ?></p>
        <div class="comment-likes">
          <a class="deny-rate" href="#">
            <p><i class="fa fa-thumbs-o-up" aria-hidden="true"></i><?= $comment->likes ? $comment->likes : '' ?></p>
          </a>
          <a class="deny-rate" href="#">
            <p><i class="fa fa-thumbs-o-down"
                  aria-hidden="true"></i> <?= $comment->dislikes ? $comment->dislikes : '' ?></p>
          </a>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>