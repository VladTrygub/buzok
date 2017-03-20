<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Literature */

$this->title = 'Update Literature: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Literatures', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="literature-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
