<?php

namespace app\controllers;

use Yii;
use app\models\RulePoint;
use app\models\RulePointSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
/**
 * RulePointController implements the CRUD actions for RulePoint model.
 */
class RulePointController extends Controller
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
     * Lists all RulePoint models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RulePointSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RulePoint model.
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
     * Creates a new RulePoint model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RulePoint();
        $rules = ArrayHelper::map(\app\models\Rule::find()->all(),'id','title');
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('index');
        } else {
            return $this->render('create', [
                'model' => $model,
                'rules' => $rules,
            ]);
        }
    }

    /**
     * Updates an existing RulePoint model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @param string $ruleId
     * @return mixed
     */
    public function actionUpdate($id, $ruleId)
    {
        $model = $this->findModel($id, $ruleId);
        $rules = ArrayHelper::map(\app\models\Rule::find()->all(),'id','title');
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'ruleId' => $model->ruleId]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'rules' => $rules,
            ]);
        }
    }

    /**
     * Deletes an existing RulePoint model.
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
     * Finds the RulePoint model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @param string $ruleId
     * @return RulePoint the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $ruleId)
    {
        if (($model = RulePoint::findOne(['id' => $id, 'ruleId' => $ruleId])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
