<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PPILead */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ppilead-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'salutation')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'firstname')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'lastname')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'account_start_date')->textInput() ?>

    <?= $form->field($model, 'account_end_date')->textInput() ?>

    <?= $form->field($model, 'finance_provider')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'did_broker_arrange')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'broker_name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ppi_claim_type')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'amount_ppi')->textInput() ?>

    <?= $form->field($model, 'daytime_phone')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'home_phone')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'mobile')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'email_address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'financial_business_name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ppi_policy_number')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'when_did_you_takeout_ppi')->textInput() ?>

    <?= $form->field($model, 'can_remember_date_of_ppi_takeout')->textInput() ?>

    <?= $form->field($model, 'ppi_cover_type')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'how_was_ppi_sold')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'did_financial_business_give_advice')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ppi_payment_method')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ppi_insurance_current_situation')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ppi_insurance_cancelled_situation_date')->textInput() ?>

    <?= $form->field($model, 'had_a_claim_ppi_insurance')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'had_a_claim_ppi_insurance_details')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'bought_cover_with_ppi_insurance')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'account_number')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'reason_of_borrowing')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'borrowed_money_to_payoff_debt_details')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ever_missed_payments')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ever_missed_payments_explanation')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'employment_status_during_ppi_payment_you')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'employment_status_during_ppi_payment_partner')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'employment_status_change_details')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'type_of_work_ppi_you')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'type_of_work_ppi_partner')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'name_of_employer_you')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'name_of_employer_partner')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'how_long_been_working_years_you')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'how_long_been_working_months_you')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'how_long_been_working_years_partner')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'how_long_been_working_months_partner')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'would_you_still_receive_payment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'would_you_still_receive_payment_details')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'would_partner_still_receive_payment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'would_partner_still_receive_payment_details')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'other_way_of_making_money_for_repayments_you')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'other_way_of_making_money_for_repayments_you_details')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'other_way_of_making_money_for_repayments_partner')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'has_health_problems_you')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'has_health_problems_you_details')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'has_health_problems_partner')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'what_happen_tookout_payment_protection')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'reason_of_unhappiness_with_insurance')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'complaining_on_behalf_name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'complaining_on_behalf_relationship')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'complaining_on_behalf_daytime_phone')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'complaining_on_behalf_email')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'complaining_on_behalf_fax')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'complaining_on_behalf_ref')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'complaining_on_behalf_of_a_business_official_name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'complaining_on_behalf_of_a_business_num_employees')->textInput() ?>

    <?= $form->field($model, 'complaining_on_behalf_of_a_business_num_partners')->textInput() ?>

    <?= $form->field($model, 'complaining_on_behalf_of_a_business_annual_income')->textInput() ?>

    <?= $form->field($model, 'company_details_responsible_on_complaint_name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'company_details_responsible_on_complaint_address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'company_details_responsible_on_complaint_phone')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'adviser_who_sold_product_name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'adviser_who_sold_product_address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'adviser_who_sold_product_phone_number')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'kind_of_service_complained')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'kind_of_service_complained_reference_number')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'full_complain_details')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'when_did_transaction_take_place')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'first_complain_took_place')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'did_company_sent_message')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'any_court_action')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'settlement_details')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'has_accessibility_problem')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'client_signature_image')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
