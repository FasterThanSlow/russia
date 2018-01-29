<?php

namespace app\controllers;

use Yii;
use app\models\WordCard;
use app\models\WordCardSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * WordCardController implements the CRUD actions for WordCard model.
 */
class WordCardController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all WordCard models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WordCardSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single WordCard model.
     * @param string $id
     * @param string $wordCardSetId
     * @param string $chapterId
     * @param string $ruleId
     * @param string $rulePointId
     * @return mixed
     */
    public function actionView($id, $wordCardSetId, $chapterId, $ruleId, $rulePointId)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $wordCardSetId, $chapterId, $ruleId, $rulePointId),
        ]);
    }

    /**
     * Creates a new WordCard model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $rules = \yii\helpers\ArrayHelper::map(\app\models\Rule::find()->all(), 'id', 'title');
        $rulePoints = \yii\helpers\ArrayHelper::map(\app\models\RulePoint::find()->all(), 'id', 'title');
        $wordCardSets = \yii\helpers\ArrayHelper::map(\app\models\WordCardSet::find()->all(), 'id', 'size');
        foreach ($wordCardSets as $key => &$wordCardSet){
            $wordCardSet = 'id:'.$key.', Размер: '.$wordCardSet;
        }
        
        if(Yii::$app->request->post() && Yii::$app->request->post('step') == 'first'){
            $size = Yii::$app->request->post('size');
            $ruleId = Yii::$app->request->post('ruleId');
            $chapter = \app\models\Rule::findOne($ruleId)->getChapter()->one();
            $chapterId = $chapter->id;
            $wordCardSetId = Yii::$app->request->post('wordCardSetId');
            $rulePointId = Yii::$app->request->post('rulePointId');
                    
            return $this->render('create-second', [
                'size' => $size,
                'ruleId' => $ruleId,
                'rulePointId' => $rulePointId,
                'chapterId' => $chapterId,
                'wordCardSetId' => $wordCardSetId
            ]);
        }
        elseif(Yii::$app->request->post('step') == 'second') {
           
            $corectWords = Yii::$app->request->post('correctWord');
            $inCorectWords = Yii::$app->request->post('incorrectWord');
            $correctWordsResult = [];
            $inCorrectWordsResult = [];
            foreach ($corectWords as &$corectWord){
                if(!empty($corectWord)){
                    $correctWordsResult[] = $corectWord;
                }
            }
             foreach ($inCorectWords as &$inCorectWord){
                if(!empty($inCorectWord)){
                    $inCorrectWordsResult[] = $inCorectWord;
                }
            }
            
            for($i = 0; $i < count($correctWordsResult); $i++){
                $wordCard = new WordCard();
                $wordCard->chapterId = Yii::$app->request->post('chapterId');
                $wordCard->ruleId = Yii::$app->request->post('ruleId');
                $wordCard->rulePointId = Yii::$app->request->post('rulePointId');
                $wordCard->wordCardSetId = Yii::$app->request->post('wordCardSetId');
                $wordCard->correctWord = $correctWordsResult[$i];
                $wordCard->incorrectWord = $inCorrectWordsResult[$i];
                $wordCard->save();
            }
            
            return $this->redirect(['index']);
        }
        else{           
            return $this->render('create-first', [
                'rules' => $rules,
                'wordCardSets' => $wordCardSets,
                'rulePoints' => $rulePoints,
            ]);
        }
        
    }

    /**
     * Updates an existing WordCard model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @param string $wordCardSetId
     * @param string $chapterId
     * @param string $ruleId
     * @param string $rulePointId
     * @return mixed
     */
    public function actionUpdate($id, $wordCardSetId, $chapterId, $ruleId, $rulePointId)
    {
        $model = $this->findModel($id, $wordCardSetId, $chapterId, $ruleId, $rulePointId);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing WordCard model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @param string $wordCardSetId
     * @param string $chapterId
     * @param string $ruleId
     * @param string $rulePointId
     * @return mixed
     */
    public function actionDelete($id, $wordCardSetId, $chapterId, $ruleId, $rulePointId)
    {
        $this->findModel($id, $wordCardSetId, $chapterId, $ruleId, $rulePointId)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the WordCard model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @param string $wordCardSetId
     * @param string $chapterId
     * @param string $ruleId
     * @param string $rulePointId
     * @return WordCard the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $wordCardSetId, $chapterId, $ruleId, $rulePointId)
    {
        if (($model = WordCard::findOne(['id' => $id, 'wordCardSetId' => $wordCardSetId, 'chapterId' => $chapterId, 'ruleId' => $ruleId, 'rulePointId' => $rulePointId])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
