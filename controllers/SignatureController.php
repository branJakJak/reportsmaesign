<?php

namespace app\controllers;

use app\models\LeadEsign;
use yii\web\NotFoundHttpException;

class SignatureController extends \yii\web\Controller
{
    public function actionIndex($securityKey)
    {
        /**
         * @var $requestedLead LeadEsign
         */
        $requestedLead = LeadEsign::find()->where(['security_key' => $securityKey])->one();
        if ($requestedLead) {
            //load and save
            if ($requestedLead->load(\Yii::$app->request->post())) {
                $requestedLead->on(LeadEsign::SIGNATURE_FINAL_STEP, ['app\models\events\ClientSignatureLead', 'handle'],$requestedLead);
                $requestedLead->saveClientSignature();
                if ($requestedLead->save()) {
                    \Yii::$app->session->setFlash('success', "Success!");
                    $requestedLead->trigger(LeadEsign::SIGNATURE_FINAL_STEP);
                    return $this->redirect("/success");
                }
            }
            $requestedLead->account_start_date = date("d-m-Y", strtotime($requestedLead->account_start_date));
            $requestedLead->account_end_date = date("d-m-Y", strtotime($requestedLead->account_end_date));
            $requestedLead->date_of_birth = date("d-m-Y", strtotime($requestedLead->date_of_birth));

            return $this->render('index', ['model' => $requestedLead]);
        } else {
            throw new NotFoundHttpException("Record doesn't exists.");
        }
    }

}
