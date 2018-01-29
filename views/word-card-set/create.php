<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\WordCardSet */

$this->title = 'Create Word Card Set';
$this->params['breadcrumbs'][] = ['label' => 'Word Card Sets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="word-card-set-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'rules' => $rules
    ]) ?>

</div>
