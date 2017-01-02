<?php

namespace app\controllers;
use app\components\PbaFormPdfEsign;
use app\components\PdfEsign;
use Yii;
use FPDI;
use app\models\LeadEsign;
use yii\filters\AccessControl;


class ExportController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex($securityKey)
    {
        /**
         * @var $leadObj LeadEsign
         */
        class_exists('TCPDF', true);        
        $leadObj = LeadEsign::find()->where(['security_key' => $securityKey])->one();
        
        // $pdfTemplte = Yii::getAlias("@app/documentation/pdf_template/PBA Form.pdf");
        // $pdfEsign = new PbaFormPdfEsign();
        // $pdfEsign->setTemplate($pdfTemplte);
        // $pdfEsign->setLeadObject($leadObj);
        // $pdfEsign->export();

        $pdfTemplte = Yii::getAlias("@app/documentation/pdf_template/".$leadObj->pdf_template.".pdf");
        $pdfEsign = new PbaFormPdfEsign();
        $pdfEsign->setTemplate($pdfTemplte);
        $pdfEsign->setLeadObject($leadObj);
        $pdfEsign->export();


        Yii::$app->end();
    }

}
