<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RulePoint */

$this->title = 'Create Rule Point';
$this->params['breadcrumbs'][] = ['label' => 'Rule Points', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rule-point-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'rules' => $rules,
    ]) ?>

</div>
