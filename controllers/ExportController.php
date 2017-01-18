<?php

namespace app\controllers;

use app\components\PbaFormPdfEsign;
use app\components\PdfEsign;
use app\components\PPIAffiliatePdfEsign;
use app\components\PPIPdfEsignForm;
use app\models\PPILead;
use Yii;
use FPDI;
use app\models\LeadEsign;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;


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

    public function actionPba($securityKey)
    {
        /**
         * @var $leadObj LeadEsign
         */
        class_exists('TCPDF', true);
        $leadObj = LeadEsign::find()->where(['security_key' => $securityKey])->one();

        $pdfTemplte = Yii::getAlias("@app/documentation/pdf_template/PBA Form.pdf");
        $pdfEsign = new PbaFormPdfEsign();
        $pdfEsign->setTemplate($pdfTemplte);
        $pdfEsign->setLeadObject($leadObj);
        $pdfEsign->export();
        // if (isset($_GET['test'])) {
        //     $pdfTemplte = Yii::getAlias("@app/documentation/pdf_template/" . $leadObj->pdf_template . ".pdf");
        //     $pdfEsign = new PbaFormPdfEsign();
        //     $pdfEsign->setTemplate($pdfTemplte);
        //     $pdfEsign->setLeadObject($leadObj);
        //     $pdfEsign->export();
        // } else {
        //     $pdfTemplte = Yii::getAlias("@app/documentation/pdf_template/PPI Affiliate Form.pdf");
        //     $pdfEsign = new PPIAffiliatePdfEsign();
        //     $pdfEsign->setTemplate($pdfTemplte);
        //     $pdfEsign->setLeadObject($leadObj);
        //     $pdfEsign->export();
        // }
        Yii::$app->end();
    }

    public function actionPpi($securityKey)
    {
        /**
         * @var $leadObj LeadEsign
         */
        class_exists('TCPDF', true);
        $leadObj = PPILead::find()->where(['security_key' => $securityKey])->one();
        if ($leadObj) {
            $pdfTemplte = Yii::getAlias("@app/documentation/pdf_template/" . $leadObj->pdf_template . ".pdf");
            $pdfEsign = new PPIPdfEsignForm();
            $pdfEsign->setTemplate($pdfTemplte);
            $pdfEsign->setLeadObject($leadObj);
            $pdfEsign->export();
        } else {
            throw new NotFoundHttpException("Can't find the lead exception");
        }
        Yii::$app->end();
    }

}
