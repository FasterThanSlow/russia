<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RulePoint */

$this->title = 'Update Rule Point: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Rule Points', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id, 'ruleId' => $model->ruleId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rule-point-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'rules' => $rules,
    ]) ?>

</div>
