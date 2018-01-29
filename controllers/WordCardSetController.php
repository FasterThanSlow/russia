<?php

namespace app\controllers;

use Yii;
use app\models\WordCardSet;
use app\models\WordCardSetSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * WordCardSetController implements the CRUD actions for WordCardSet model.
 */
class WordCardSetController extends Controller
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
     * Lists all WordCardSet models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WordCardSetSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single WordCardSet model.
     * @param string $id
     * @param string $ruleId
     * @return mixed
     */
    public function actionView($id, $ruleId)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $ruleId),
        ]);
    }

    /**
     * Creates a new WordCardSet model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new WordCardSet();
        $rules = \yii\helpers\ArrayHelper::map(\app\models\Rule::find()->all(), 'id', 'title');
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('index');
        } else {
            return $this->render('create', [
                'model' => $model,
                'rules' => $rules
            ]);
        }
    }

    /**
     * Updates an existing WordCardSet model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @param string $ruleId
     * @return mixed
     */
    public function actionUpdate($id, $ruleId)
    {
        $model = $this->findModel($id, $ruleId);
        $rules = \yii\helpers\ArrayHelper::map(\app\models\Rule::find()->all(), 'id', 'title');
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'ruleId' => $model->ruleId]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'rules' => $rules
            ]);
        }
    }

    /**
     * Deletes an existing WordCardSet model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @param string $ruleId
     * @return mixed
     */
    public function actionDelete($id, $ruleId)
    {
        $this->findModel($id, $ruleId)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the WordCardSet model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @param string $ruleId
     * @return WordCardSet the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $ruleId)
    {
        if (($model = WordCardSet::findOne(['id' => $id, 'ruleId' => $ruleId])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
