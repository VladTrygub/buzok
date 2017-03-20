<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'SiteName'; ?>

<div class="container">
  <div class="welcome">

    <a href="#" class="logo"><p>SiteName</p></a>
    <h1>Добро пожаловать!</h1>
    <h2>Рады Вас видеть на сайте!</h2>
<!--    <h2>"Бузьок" - вiртуальне видавництво та крамниця електронних книжок</h2>-->
    <h2>"SiteName" - виртуальное издательство и магазин электронных книг</h2>
    <h2>Давайте знакомиться:</h2>

    <div class="buttons">
      <a class="my-btn" href="<?= \yii\helpers\Url::to(['/author/index']) ?>" style="padding: 7px 20px 0 20px;"><p>Я - автор</p></a>
      <a class="my-btn" href="<?= \yii\helpers\Url::to(['/reader/index']) ?>" style="padding: 7px 20px 0 20px;"><p>Я - читататель</p></a>
    </div>

  </div>
</div>

