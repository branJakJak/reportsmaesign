<?php

namespace app\controllers;

use app\models\LeadEsign;
use app\models\NewLeadForm;
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
                        'actions' => ['logout','index'],
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
        if ($model->load(Yii::$app->request->post())) {
            $model->save();
            Yii::$app->getSession()->setFlash('success', "New lead added");
            $this->redirect(Yii::$app->homeUrl);
            Yii::$app->end();
        }
        return $this->render('//lead-esign/create', [
            'model' => $model,
        ]);

    }
    public function actionPdf($leadId)
    {
        /**
         * @var $leadObj LeadEsign
         */
        $leadObj = null;
        if(LeadEsign::find()->where(['id' => $leadId])->exists()){
            $leadObj = LeadEsign::find()->where(['id' => $leadId])->one();
        }else{
            throw new HttpException(404);
        }
        $newLeadForm = new NewLeadForm();
        $newLeadForm->attributes = $leadObj->attributes;
        $retArr = \Yii::$app->assetManager->publish($leadObj->client_signature_image);
        $publishedSignatureImage = $retArr[0];
        $content = $this->renderPartial("_pdf_template", compact('newLeadForm', 'publishedSignatureImage'));
        $mpdf = new \mPDF();
        $mpdf->WriteHTML($content);
        $mpdf->Output();
    }
    public function actionTest()
    {
        echo Yii::getAlias('@app/signatures/');
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

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
}
