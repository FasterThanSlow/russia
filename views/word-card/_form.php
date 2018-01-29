<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\WordCard */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="word-card-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'correctWord')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'incorrectWord')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wordCardSetId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'chapterId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ruleId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rulePointId')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
