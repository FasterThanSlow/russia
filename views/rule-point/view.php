<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\RulePoint */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Rule Points', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rule-point-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id, 'ruleId' => $model->ruleId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id, 'ruleId' => $model->ruleId], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'description:ntext',
            'ruleId',
        ],
    ]) ?>

</div>
