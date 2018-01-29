<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

use app\models\Rule;
use app\models\RulePoint;
use app\models\Chapter;
use app\models\WordCard;
use app\models\Wordcardset;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionExport(){
        $rules = Rule::find()->all();
        $rulePoints = RulePoint::find()->all();
        $chapters = Chapter::find()->all();
        $wordCards = WordCard::find()->all();
        $wordCardSets = Wordcardset::find()->all();
        
        $rulesJson = \yii\helpers\Json::encode($rules);
        $rulePointsJson = \yii\helpers\Json::encode($rulePoints);
        $chaptersJson = \yii\helpers\Json::encode($chapters);
        $wordCardsJson = \yii\helpers\Json::encode($wordCards);
        $wordCardSetsJson = \yii\helpers\Json::encode($wordCardSets);
        
        
        $rulesFile = fopen("export/rules.json", "w") or die("Unable to open file!");
        $rulePointsFile = fopen("export/rule_points.json", "w") or die("Unable to open file!");
        $chaptersFile = fopen("export/chapters.json", "w") or die("Unable to open file!");
        $wordCardsFile = fopen("export/word_cards.json", "w") or die("Unable to open file!");
        $wordCardSetsFile = fopen("export/word_card_sets.json", "w") or die("Unable to open file!");
        
        
        fwrite($rulesFile, $rulesJson);
        fwrite($rulePointsFile, $rulePointsJson);
        fwrite($chaptersFile, $chaptersJson);
        fwrite($wordCardsFile, $wordCardsJson);
        fwrite($wordCardSetsFile, $wordCardSetsJson);
        
        return $this->render('export');
    }
  
}
