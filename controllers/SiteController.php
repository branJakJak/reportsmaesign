<?php

namespace app\controllers;

use app\components\PdfEsign;
use app\models\LeadEsign;
use app\models\NewLeadForm;
use FPDI;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use kartik\mpdf\Pdf;
use yii\web\HttpException;
use Dompdf\Dompdf;
use yii\helpers\Html;
use yii\helpers\Url;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout','index'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['admin','agent'],
                    ],
                ],
            ],
        ];
    }

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
    public function actionSuccess()
    {
        $this->layout = "customer";        
        return $this->render('success');
    }
    public function actionLead()
    {
        $faker = \Faker\Factory::create();
        $dataProvider = new ActiveDataProvider([
            'query'=>LeadEsign::find()
        ]);
        return $this->render('lead', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndex()
    {
        $model = new LeadEsign();
        $model->on(LeadEsign::LEAD_ESIGN_NEW_LEAD, ['app\models\events\NewLeadEventHandler', 'handle'],$model);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "New lead created. Reference id : ".$model->security_key);
            return $this->redirect("/");
        }
        return $this->render('//lead-esign/create', [
            'model' => $model,
        ]);

    }
   public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }


}
