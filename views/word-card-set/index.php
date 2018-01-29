<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\WordCardSetSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Word Card Sets';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="word-card-set-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Word Card Set', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'size',
            'ruleId',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
