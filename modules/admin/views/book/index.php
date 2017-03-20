<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">

  <h1><?= Html::encode($this->title) ?></h1>
  <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

  <p>
    <?= Html::a('Create Book', ['create'], ['class' => 'btn btn-success']) ?>
  </p>
  <?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
      //            ['class' => 'yii\grid\SerialColumn'],

      'id',
      'author_id',
      'name',
      //            'description:ntext',
      'is_ebook',
      'count_paper_books',
      //            'img_name',
      'price',
      // 'literature_id',
      // 'theme_id',
      // 'style_id',
      // 'genre_id',
//      'created_at',
      [
        'attribute' => 'created_at',
        'format' => ['date', 'php:Y-m-d H:i:s']
      ],
//      'updated_at',
//      [
//        'attribute' => 'updated_at',
//        'format' => ['date', 'php:Y-m-d H:i:s']
//      ],

      ['class' => 'yii\grid\ActionColumn'],
    ],
  ]); ?>
</div>
