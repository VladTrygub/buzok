<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AdminAsset;

AdminAsset::register($this); ?>

<?php $this->beginPage() ?>
  <!DOCTYPE html>
  <html lang="<?= Yii::$app->language ?>">
  <head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
  </head>
  <body>
  <?php $this->beginBody() ?>

  <div class="wrap">
    <?php
    NavBar::begin([
      'brandLabel' => 'My Company',
      'brandUrl' => Yii::$app->homeUrl,
      'options' => [
        'class' => 'navbar-inverse navbar-fixed-top',
      ],
    ]);
    echo Nav::widget([
      'options' => ['class' => 'navbar-nav navbar-right'],
      'items' => [
        ['label' => 'Home', 'url' => ['/admin/default/index']],
        ['label' => 'Books', 'url' => ['/admin/book/index']],
        ['label' => 'Genre', 'url' => ['/admin/genre/index']],
        ['label' => 'Literature', 'url' => ['/admin/literature/index']],
        ['label' => 'Style', 'url' => ['/admin/style/index']],
        ['label' => 'Theme', 'url' => ['/admin/theme/index']],
        ['label' => 'Orders', 'url' => ['/admin/order/index']],
        ['label' => 'Posts', 'url' => ['/admin/post/index']],
        Yii::$app->user->isGuest ? (
        ['label' => 'Login', 'url' => ['/auth/login']]
        ) : (
          '<li>'
          . Html::beginForm(['/auth/logout'], 'post')
          . Html::submitButton(
            'Logout (' . Yii::$app->user->identity->username . ')',
            ['class' => 'btn btn-link logout']
          )
          . Html::endForm()
          . '</li>'
        )
      ],
    ]);
    NavBar::end(); ?>

    <div class="container">
      <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
      ]) ?>
      <?= $content ?>
    </div>
  </div>

  <footer class="footer">
    <div class="container">
      <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
      <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
  </footer>

  <?php $this->endBody() ?>
  </body>
  </html>
<?php $this->endPage() ?>