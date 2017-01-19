<?php

namespace app\controllers;

use app\models\events\ClientSignaturePpiLead;
use app\models\events\PPIPdfFactory;
use app\models\LeadEsign;
use app\models\PPILead;
use yii\web\NotFoundHttpException;

class SignatureController extends \yii\web\Controller
{
    public $layout = "customer";
    public function actionPba($securityKey)
    {
        /**
         * @var $requestedLead LeadEsign
         */
        $requestedLead = LeadEsign::find()->where(['security_key' => $securityKey])->one();
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


            return $this->render('pba', ['model' => $requestedLead]);
        } else {
            throw new NotFoundHttpException("Record doesn't exists.");
        }
    }


    public function actionPpi($securityKey)
    {
        /**
         * @var $requestedLead PPILead
         */
        $requestedLead = PPILead::find()->where(['security_key' => $securityKey])->one();
        if ($requestedLead) {
            //load and save
            if ($requestedLead->load(\Yii::$app->request->post())) {
                $clientSignaturePpiLeadEventListener = new ClientSignaturePpiLead();
                $clientSignaturePpiLeadEventListener->esignPdfFactory = new PPIPdfFactory();

                if ($requestedLead->would_you_still_receive_payment_details === 'other (please tell us more below)') {
                    $requestedLead->would_you_still_receive_payment_details = \Yii::$app->request->post('would_you_still_receive_payment_details_other');
                }

                // $requestedLead->on(PPILead::SIGNATURE_FINAL_STEP, [$clientSignaturePpiLeadEventListener, 'handle'],$requestedLead);

                $requestedLead->saveClientSignature();
                if (isset($requestedLead->date_of_birth)) {
                    $requestedLead->date_of_birth = date("Y-m-d",strtotime($requestedLead->date_of_birth));
                }

                if (isset($requestedLead->reason_of_borrowing)) {
                    $requestedLead->reason_of_borrowing = implode(",", $requestedLead->reason_of_borrowing);
                }
                if (isset($requestedLead->bought_cover_with_ppi_insurance)) {
                    $requestedLead->bought_cover_with_ppi_insurance = implode(",", $requestedLead->bought_cover_with_ppi_insurance);
                }


                $borrowed_money_to_payoff_debt_details_temp_container = json_encode( \Yii::$app->request->post('borrowed_money_to_payoff_debt_details') );
                $requestedLead->borrowed_money_to_payoff_debt_details = $borrowed_money_to_payoff_debt_details_temp_container;
                if ($requestedLead->save()) {
                    \Yii::$app->session->setFlash('success', "Success!");
                    $requestedLead->trigger(PPILead::SIGNATURE_FINAL_STEP);
                    return $this->redirect("/success");
                }
            }
            if (isset($requestedLead->bought_cover_with_ppi_insurance)) {
                $requestedLead->bought_cover_with_ppi_insurance = explode(",",$requestedLead->bought_cover_with_ppi_insurance);
            }
            if (isset($requestedLead->reason_of_borrowing)) {
                $requestedLead->reason_of_borrowing = explode(",",$requestedLead->reason_of_borrowing);
            }
            if (isset($requestedLead->final_tick_checklist) && is_array($requestedLead->final_tick_checklist)) {
                $requestedLead->final_tick_checklist = implode(",",$requestedLead->final_tick_checklist);
            }
            if ($requestedLead->account_start_date) {
                $requestedLead->account_start_date = date("d-m-Y", strtotime($requestedLead->account_start_date));
            }
            if ($requestedLead->account_end_date) {
                $requestedLead->account_end_date = date("d-m-Y", strtotime($requestedLead->account_end_date));
            }
            if ($requestedLead->date_of_birth) {
                $requestedLead->date_of_birth = date("d-m-Y", strtotime($requestedLead->date_of_birth));
            }
            if ($requestedLead->when_did_transaction_take_place) {
                $requestedLead->when_did_transaction_take_place = date("d-m-Y", strtotime($requestedLead->when_trasaction_happen));
            }
            if ($requestedLead->first_complain_took_place) {
                $requestedLead->first_complain_took_place = date("d-m-Y", strtotime($requestedLead->when_first_complain_business));
            }
            return $this->render('ppi', ['model' => $requestedLead]);
        } else {
            throw new NotFoundHttpException("Record doesn't exists.");
        }
    }
}
