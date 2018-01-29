<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\WordCard */

$this->title = 'Update Word Card: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Word Cards', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'wordCardSetId' => $model->wordCardSetId, 'chapterId' => $model->chapterId, 'ruleId' => $model->ruleId, 'rulePointId' => $model->rulePointId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="word-card-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
