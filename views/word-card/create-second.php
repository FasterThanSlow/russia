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

    <?php $form = ActiveForm::begin(['options'=>['class'=>'form-horizontal']]); ?>
    <?= Html::hiddenInput('step','second')?>
    <?= Html::hiddenInput('ruleId',$ruleId)?>
    <?= Html::hiddenInput('rulePointId',$rulePointId)?>
    <?= Html::hiddenInput('wordCardSetId',$wordCardSetId)?>
    <?= Html::hiddenInput('chapterId',$chapterId)?>
    
    <?php for($i = 0; $i < $size; $i++): ?>
    
    <div class="form-group answers-group">
        <div class="col-md-6 col-xs-6 col-sm-6">
            <label>Правильный ответ</label>
            <?= Html::textInput('correctWord[]',false,['class'=>'form-control correct-answer']); ?>
        </div>
        
        <div class="col-md-6 col-xs-6 col-sm-6">
            <label>Неправильный ответ</label>
            <?= Html::textInput('incorrectWord[]',false,['class'=>'form-control incorrect-answer']); ?>
        </div>
    </div>    
    
    <?php endfor; ?>
    
    <div class="form-group">
        <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
    </div>
    
    <?php ActiveForm::end(); ?>

</div>
<script>
$(document).ready(function(){
    $(document).on('change','.correct-answer',function(){
        var parent = $(this).parent().parent()[0];
        $(parent).find('.incorrect-answer').val($(this).val());
    });
});
</script>
