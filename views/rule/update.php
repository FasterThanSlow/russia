<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Rule */

$this->title = 'Update Rule: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Rules', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id, 'chapterId' => $model->chapterId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rule-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'chapters' => $chapters
    ]) ?>

</div>
