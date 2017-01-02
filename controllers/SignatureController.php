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
                if (isset($requestedLead->final_tick_checklist) && is_array($requestedLead->final_tick_checklist)) {
                    $requestedLead->final_tick_checklist = implode(",",$requestedLead->final_tick_checklist);
                }
                if (!empty($requestedLead->when_trasaction_happen)) {
                    $requestedLead->when_trasaction_happen = date("Y-m-d H:i:s", strtotime($requestedLead->when_trasaction_happen));
                }
                if (!empty($requestedLead->when_first_complain_business)) {
                    $requestedLead->when_first_complain_business = date("Y-m-d H:i:s",strtotime($requestedLead->when_first_complain_business));
                }
                if (!empty($requestedLead->open_or_upgrade_package_bank_account_date)) {
                    $requestedLead->open_or_upgrade_package_bank_account_date = date("Y-m-d H:i:s",strtotime($requestedLead->open_or_upgrade_package_bank_account_date));
                }
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
            $requestedLead->when_trasaction_happen = date("d-m-Y", strtotime($requestedLead->when_trasaction_happen));
            $requestedLead->when_first_complain_business = date("d-m-Y", strtotime($requestedLead->when_first_complain_business));
            $requestedLead->open_or_upgrade_package_bank_account_date = date("d-m-Y", strtotime($requestedLead->open_or_upgrade_package_bank_account_date));
            
            $requestedLead->after_upgrade_already_has_products = explode(",", $requestedLead->after_upgrade_already_has_products);
            $requestedLead->declaration_confirmed_tick = explode(",", $requestedLead->declaration_confirmed_tick);
            $requestedLead->final_tick_checklist = explode(",",$requestedLead->final_tick_checklist);
            $requestedLead->complaint_reference = $requestedLead->security_key;


            return $this->render('index', ['model' => $requestedLead]);
        } else {
            throw new NotFoundHttpException("Record doesn't exists.");
        }
    }
    // public function actionTest($securityKey)
    // {
    //     /**
    //      * @var $requestedLead LeadEsign
    //      */
    //     $requestedLead = LeadEsign::find()->where(['security_key' => $securityKey])->one();
    //     if ($requestedLead) {
    //         //load and save
    //         if ($requestedLead->load(\Yii::$app->request->post())) {
    //             // $requestedLead->after_upgrade_already_has_products = $_POST['LeadEsign']['after_upgrade_already_has_products'];
    //             $requestedLead->on(LeadEsign::SIGNATURE_FINAL_STEP, ['app\models\events\ClientSignatureLead', 'handle'],$requestedLead);
    //             $requestedLead->saveClientSignature();
    //             if ($requestedLead->save()) {
    //                 \Yii::$app->session->setFlash('success', "Success!");
    //                 $requestedLead->trigger(LeadEsign::SIGNATURE_FINAL_STEP);
    //                 return $this->redirect("/success");
    //             }
    //         }
    //         $requestedLead->account_start_date = date("d-m-Y", strtotime($requestedLead->account_start_date));
    //         $requestedLead->account_end_date = date("d-m-Y", strtotime($requestedLead->account_end_date));
    //         $requestedLead->date_of_birth = date("d-m-Y", strtotime($requestedLead->date_of_birth));
    //         $requestedLead->after_upgrade_already_has_products = explode(",", $requestedLead->after_upgrade_already_has_products);
    //         return $this->render('test', ['model' => $requestedLead]);
    //     } else {
    //         throw new NotFoundHttpException("Record doesn't exists.");
    //     }
    // }

}
