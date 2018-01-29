<?php

namespace app\controllers;

use Yii;
use app\models\Rule;
use app\models\RuleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RuleController implements the CRUD actions for Rule model.
 */
class RuleController extends Controller
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
     * Lists all Rule models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RuleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Rule model.
     * @param string $id
     * @param string $chapterId
     * @return mixed
     */
    public function actionView($id, $chapterId)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $chapterId),
        ]);
    }

    /**
     * Creates a new Rule model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Rule();
        $chapters = \yii\helpers\ArrayHelper::map(\app\models\Chapter::find()->all(), 'id', 'title');
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('index');
        } else {
            return $this->render('create', [
                'model' => $model,
                'chapters' => $chapters
            ]);
        }
    }

    /**
     * Updates an existing Rule model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @param string $chapterId
     * @return mixed
     */
    public function actionUpdate($id, $chapterId)
    {
        $model = $this->findModel($id, $chapterId);
        $chapters = \yii\helpers\ArrayHelper::map(\app\models\Chapter::find()->all(), 'id', 'title');
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'chapterId' => $model->chapterId]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'chapters' => $chapters
            ]);
        }
    }

    /**
     * Deletes an existing Rule model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @param string $chapterId
     * @return mixed
     */
    public function actionDelete($id, $chapterId)
    {
        $this->findModel($id, $chapterId)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Rule model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @param string $chapterId
     * @return Rule the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $chapterId)
    {
        if (($model = Rule::findOne(['id' => $id, 'chapterId' => $chapterId])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
