<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;

//\app\assets\MyAsset::register($this); ?>

<?php $this->beginPage() ?>
  <!doctype html>
  <html lang="<?= Yii::$app->language ?>">
  <head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="yandex-verification" content="b4f6b878742a72f1"/>
    <title><?= Html::encode($this->title) ?></title>
    <?= Html::csrfMetaTags() ?>
    <?php $this->head() ?>
  </head>
  <body>
  <?php $this->beginBody() ?>
  <div class="wrap">

    <script>
      window.fbAsyncInit = function () {
        FB.init({
          appId: '1324681297563971',
          xfbml: true,
          version: 'v2.8'
        });
      };

      (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
          return;
        }
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>

    <header>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <a href="#" class="logo"><p>SiteName</p></a>
            <!-- todo: main manu -->
            <div class="col-md-10 col-md-offset-1">
              <nav class="main-menu clearfix">
                <ul class="ul-left">
                  <?php if (isset($this->blocks['header'])): ?>
                    <?= $this->blocks['header'] ?>
                  <?php endif; ?>
                </ul>
                <ul class="ul-right">
                  <li>
                    <?php if (Yii::$app->user->isGuest): ?>
                      <a href="<?= Url::to(['auth/login']) ?>" class="cabinet">Войти</a>
                    <?php else: ?>
                      <a href="#" class="cabinet" data-toggle="modal" data-target="#myModal">Кабинет</a>
                    <?php endif; ?>
                  </li>
                  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Кабiнет</h4>
                        </div>
                        <div class="modal-body">
                          <div class="container">
                            <div class="row">
                              <div class="col-md-2">
                                <p><?= isset(Yii::$app->user->identity->username) ? Yii::$app->user->identity->username : '' ?></p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                          <button class="btn btn-primary" type="button">Save changes</button>
                          <a href="<?= Url::to(['/auth/logout']) ?>" class="btn btn-danger">Вийти</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </header>


    <div class="container">
      <?= \yii\widgets\Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
      ]) ?>
      <?= $content ?>
    </div>

    <?php
    \yii\bootstrap\Modal::begin([
      'id' => 'cart',
      'size' => 'modal-lg',
      'header' => '<h2>Мои покупки:</h2>',
      'footer' => '
      <button type="button" class="btn btn-default" data-dismiss="modal">Продолжить</button>
      <a href="' . Url::to(['cart/index']) . '" class="btn btn-success">Оформить заказ</a>
      <button type="button" class="btn btn-danger" onclick="clearCart()">Очистить корзину</button>',
    ]);
    \yii\bootstrap\Modal::end();
    ?>

  </div>

  <footer>
    <div class="container">
      <div class="row">
        <div class="col-md-3"><a href="#" class="logo footer-logo"><p>SiteName</p></a></div>
        <div class="col-md-6">
          <div class="footer-ul">
            <ul class="footer-ul-left">
              <li><a href="<?= \yii\helpers\Url::to(['/site/index']) ?>">Главная</a></li>
              <li><a href="<?= \yii\helpers\Url::to(['/reader/index']) ?>">Читатель</a></li>
              <li><a href="<?= \yii\helpers\Url::to(['/author/index']) ?>">Автор</a></li>
            </ul>
            <ul class="footer-ul-right">
              <li><a href="<?= \yii\helpers\Url::to(['/shop/index']) ?>">Магазин</a></li>
              <li><a href="<?= \yii\helpers\Url::to(['/blog/index']) ?>">Блог</a></li>
            </ul>
          </div>
        </div>
        <div class="col-md-3">
          <div class="copyright">
            <i class="fa fa-copyright" aria-hidden="true"></i> 2017 - SiteName
          </div>
        </div>
      </div>
    </div>
  </footer>

  <?php $this->endBody() ?>
  </body>
  </html>
<?php $this->endPage() ?>