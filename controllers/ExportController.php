<?php

namespace app\controllers;


use app\components\PbaAffiliatePdfEsign;
use app\components\PbaNonAffiliateForm;
use app\components\PPINonAffiliatePdfEsign;
use app\components\PPIAffiliatePdf;
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
        if ($leadObj) {
            $pdfTemplte = Yii::getAlias("@app/documentation/pdf_template/" . $leadObj->pdf_template . ".pdf");

            if ($leadObj->pdf_template === 'Original') {
                $pdfEsign = new PbaNonAffiliateForm();
            } else if ($leadObj->pdf_template === 'PBA Affiliate Form') {
                $pdfEsign = new PbaAffiliatePdfEsign();
            }

            $pdfEsign->setTemplate($pdfTemplte);
            $pdfEsign->setLeadObject($leadObj);
            $pdfEsign->export();
        } else {
            throw new NotFoundHttpException("Can't find the lead exception");
        }

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
            if ($leadObj->pdf_template === 'PPI Form') {
                $pdfEsign = new PPINonAffiliatePdfEsign();
            } else if ($leadObj->pdf_template === 'PPI Affiliate Form') {
                $pdfEsign = new PPIAffiliatePdf();
            }
            $pdfEsign->setTemplate($pdfTemplte);
            $pdfEsign->setLeadObject($leadObj);
            $pdfEsign->export();
        } else {
            throw new NotFoundHttpException("Can't find the lead exception");
        }
        Yii::$app->end();
    }

}
