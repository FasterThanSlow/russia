<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\WordCardSet */

$this->title = 'Update Word Card Set: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Word Card Sets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'ruleId' => $model->ruleId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="word-card-set-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'rules' => $rules
    ]) ?>

</div>
