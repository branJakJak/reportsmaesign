<?php

namespace app\controllers;

use app\models\LeadEsign;
use yii\web\NotFoundHttpException;

class SignatureController extends \yii\web\Controller
{
    public $layout = "customer";
    public function actionIndex($securityKey)
    {
        /**
         * @var $requestedLead LeadEsign
         */
        $requestedLead = LeadEsign::find()->where(['security_key' => $securityKey])->one();
        // var_dump($requestedLead->how_packaged_bank_account_sold);
        // die();
        if ($requestedLead) {

            //load and save
            if ($requestedLead->load(\Yii::$app->request->post())) {
                if (isset($requestedLead->declaration_confirmed_tick) && is_array($requestedLead->declaration_confirmed_tick)) {
                    $requestedLead->declaration_confirmed_tick = implode(",", $requestedLead->declaration_confirmed_tick);
                }
                // $requestedLead->after_upgrade_already_has_products = $_POST['LeadEsign']['after_upgrade_already_has_products'];
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
            $requestedLead->after_upgrade_already_has_products = explode(",", $requestedLead->after_upgrade_already_has_products);
            $requestedLead->declaration_confirmed_tick = explode(",", $requestedLead->declaration_confirmed_tick);

            return $this->render('index', ['model' => $requestedLead]);
        } else {
            throw new NotFoundHttpException("Record doesn't exists.");
        }
    }
    public function actionTest($securityKey)
    {
        /**
         * @var $requestedLead LeadEsign
         */
        $requestedLead = LeadEsign::find()->where(['security_key' => $securityKey])->one();
        if ($requestedLead) {
            //load and save
            if ($requestedLead->load(\Yii::$app->request->post())) {
                // $requestedLead->after_upgrade_already_has_products = $_POST['LeadEsign']['after_upgrade_already_has_products'];
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
            $requestedLead->after_upgrade_already_has_products = explode(",", $requestedLead->after_upgrade_already_has_products);
            return $this->render('test', ['model' => $requestedLead]);
        } else {
            throw new NotFoundHttpException("Record doesn't exists.");
        }
    }

}
