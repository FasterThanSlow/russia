<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\WordCard */

$this->title = 'Create Word Card';
$this->params['breadcrumbs'][] = ['label' => 'Word Cards', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="word-card-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>
    <?= Html::hiddenInput('step','first')?>
    
    <div class="form-group">
        <label>Введите количество добавляемых слов</label>
        <?= Html::textInput('size',false,['class'=>'form-control']); ?>
    </div>
    
    <div class="form-group">
        <label>Выбирите правило</label>
        <?= Html::dropDownList('ruleId',false,$rules,['class'=>'form-control','id'=>'rulesDropDown']); ?>
    </div>
    
    <div class="form-group">
        <label>Выбирите абзац</label>
        <?= Html::dropDownList('rulePointId',false,$rulePoints,['class'=>'form-control','id'=>'rulePointsDropDown']); ?>
    </div>
    
    <div class="form-group">
        <label>Выбирите блок слов</label>
        <?= Html::dropDownList('wordCardSetId',false,$wordCardSets,['class'=>'form-control','id'=>'wordCardSetsDropDown']); ?>
    </div>
    
    <div class="form-group">
        <?= Html::submitButton('Добавить', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
<script>
    $(document).ready(function(){
        $(document).on('change','#rulesDropDown',function(){
            $.ajax({
                url: "/russian/ajax",
                data: {ruleId: $(this).val()},
            }).done(function( data ) {
                data = JSON.parse(data);
                $('#wordCardSetsDropDown').find('option').remove();
                var wordCardSets = data['wordCardSets'];
                for (key in wordCardSets) {
                    $('#wordCardSetsDropDown').append($("<option></option>").attr("value",key).text(wordCardSets[key]));
                }
                $('#rulePointsDropDown').find('option').remove();
                var rulePoints = data['rulePoints'];
                for (key in rulePoints) {
                    $('#rulePointsDropDown').append($("<option></option>").attr("value",key).text(rulePoints[key]));
                }
            });
        });
    });
</script>
