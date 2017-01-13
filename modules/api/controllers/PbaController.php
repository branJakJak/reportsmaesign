<?php

namespace app\modules\api\controllers;



use app\models\LeadEsign;
use app\modules\api\LeadBaseInterface;
use yii\console\Exception;
use yii\helpers\Json;

class PbaController extends LeadBaseController implements LeadBaseInterface {

    public function actionNonAffiliate()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $message = [];
        try {
            $pbaLead = new LeadEsign();
            $postedData['LeadEsign'] = \Yii::$app->request->post();
            if ($pbaLead->load(['LeadEsign' => \Yii::$app->request->post()]) && $pbaLead->validate()) {
                $pbaLead->pdf_template = 'Original';
                $pbaLead->save();
                \Yii::$app->response->statusCode = 201;
                $message = $pbaLead;
            }else{
                \Yii::$app->response->statusCode = 400;
                $message = $pbaLead->getErrors();
            }

        } catch (\Exception $ex) {
            \Yii::$app->response->statusCode = 500;
            $message = [
                'message'=> $ex->getMessage()
            ];
        }
        return Json::encode($message);
    }

    public function actionAffiliate()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $message = [];
        try {
            $pbaLead = new LeadEsign();
            $postedData['LeadEsign'] = \Yii::$app->request->post();
            if ($pbaLead->load(['LeadEsign' => \Yii::$app->request->post()]) && $pbaLead->validate()) {
                $pbaLead->pdf_template = 'PBA Affiliate Form';
                $pbaLead->save();
                \Yii::$app->response->statusCode = 201;
                $message = $pbaLead;
            }else{
                \Yii::$app->response->statusCode = 400;
                $message = $pbaLead->getErrors();
            }

        } catch (\Exception $ex) {
            \Yii::$app->response->statusCode = 500;
            $message = [
                'message'=> $ex->getMessage()
            ];
        }
        return Json::encode($message);
    }
}