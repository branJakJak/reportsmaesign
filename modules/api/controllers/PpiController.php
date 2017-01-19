<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 1/10/17
 * Time: 1:32 AM
 */

namespace app\modules\api\controllers;


use app\models\LeadEsign;
use app\models\PPILead;
use app\modules\api\LeadBaseInterface;
use app\modules\api\NewPpiLeadFactory;
use yii\base\Event;
use yii\base\Response;
use yii\helpers\Json;


class PpiController extends LeadBaseController implements LeadBaseInterface{
    public $enableCsrfValidation = false;
    public function actionNonAffiliate()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $message = [];
        try {
            $ppiLead = NewPpiLeadFactory::create();
            $postedData['PPILead'] = \Yii::$app->request->post();
            if ($ppiLead->load(['PPILead' => \Yii::$app->request->post()]) && $ppiLead->validate()) {
                $ppiLead->pdf_template = 'PPI Form';
                $ppiLead->save();
                $eventArgs = new Event();
                $eventArgs->data = $ppiLead;
                $ppiLead->trigger(PPILead::EVENT_NEW_LEAD,$eventArgs);
                \Yii::$app->response->statusCode = 201;
                $message = $ppiLead;
            }else{
                \Yii::$app->response->statusCode = 400;
                $message = $ppiLead->getErrors();
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
            $ppiLead = NewPpiLeadFactory::create();
            $postedData['PPILead'] = \Yii::$app->request->post();
            if ($ppiLead->load(['PPILead' => \Yii::$app->request->post()]) && $ppiLead->validate()) {
                $ppiLead->pdf_template = 'PPI Affiliate Form';
                $ppiLead->save();
                $eventArgs = new Event();
                $eventArgs->data = $ppiLead;
                $ppiLead->trigger(PPILead::EVENT_NEW_LEAD,$eventArgs);
                \Yii::$app->response->statusCode = 201;
                $message = $ppiLead;
            }else{
                \Yii::$app->response->statusCode = 400;
                $message = $ppiLead->getErrors();
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