<?php

namespace app\controllers;

use app\models\NewLeadForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use kartik\mpdf\Pdf;

class SiteController extends Controller
{
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

    public function actionIndex()
    {
        $newLeadForm = new NewLeadForm();
        if ($newLeadForm->load(Yii::$app->request->post()) && $newLeadForm->validate()) {
//            $pdfEsign = Yii::$app->pdfEsign;
//            $pdfEsign->leadData = $newLeadForm->attributes;
//            $exportedPdfFile = $pdfEsign->export();
//            Yii::$app->response->xSendFile($exportedPdfFile);
            $imageSignatureTempContainer = $newLeadForm->prepareData();
            /*publish the image to asset folder and get url */
            $retArr = \Yii::$app->assetManager->publish($imageSignatureTempContainer);
            $publishedSignatureImage = $retArr[0];
            $content = $this->renderPartial("_pdf_template", compact('newLeadForm', 'publishedSignatureImage'));

            $mpdf = new \mPDF();
            $mpdf->WriteHTML($content);
            $mpdf->Output();
        }
        return $this->render('index', ['model' => $newLeadForm]);
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
