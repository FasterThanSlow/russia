<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use app\models\Wordcardset;
use app\models\RulePoint;

/**
 * Description of AjaxController
 *
 * @author Валим
 */
class AjaxController extends Controller{
    
    public function actionIndex($ruleId){
        $where = ['ruleId' => $ruleId];
        $wordCaradSets = Wordcardset::find()->where($where)->all();
        $wordCardSetsArr = ArrayHelper::map($wordCaradSets, 'id', 'size');
        $rulePoints = RulePoint::find()->where($where)->all();
        $rulePointsArr = ArrayHelper::map($rulePoints, 'id', 'title');
        
        foreach ($wordCardSetsArr as $key => &$wordCardSet){
            $wordCardSet = 'id:'.$key.', Размер: '.$wordCardSet;
        }
        $result = [];
        $result['rulePoints'] = $rulePointsArr;
        $result['wordCardSets'] = $wordCardSetsArr;
                
        echo json_encode($result);
    }
}
