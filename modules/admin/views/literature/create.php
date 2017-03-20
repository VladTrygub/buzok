<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Literature */

$this->title = 'Create Literature';
$this->params['breadcrumbs'][] = ['label' => 'Literatures', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="literature-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
