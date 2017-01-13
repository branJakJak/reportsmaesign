<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'PPI leads';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ppilead-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="hidden">
        <?= Html::a('Create Ppilead', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'salutation:ntext',
            'firstname:ntext',
            'lastname:ntext',
            'account_start_date',
            // 'account_end_date',
            // 'finance_provider:ntext',
            // 'did_broker_arrange:ntext',
            // 'broker_name:ntext',
            // 'ppi_claim_type:ntext',
            // 'amount_ppi',
            // 'daytime_phone:ntext',
            // 'home_phone:ntext',
            // 'mobile:ntext',
            // 'email_address:ntext',
            // 'financial_business_name:ntext',
            // 'ppi_policy_number:ntext',
            // 'when_did_you_takeout_ppi',
            // 'can_remember_date_of_ppi_takeout',
            // 'ppi_cover_type:ntext',
            // 'how_was_ppi_sold:ntext',
            // 'did_financial_business_give_advice:ntext',
            // 'ppi_payment_method:ntext',
            // 'ppi_insurance_current_situation:ntext',
            // 'ppi_insurance_cancelled_situation_date',
            // 'had_a_claim_ppi_insurance:ntext',
            // 'had_a_claim_ppi_insurance_details:ntext',
            // 'bought_cover_with_ppi_insurance:ntext',
            // 'account_number:ntext',
            // 'reason_of_borrowing:ntext',
            // 'borrowed_money_to_payoff_debt_details:ntext',
            // 'ever_missed_payments:ntext',
            // 'ever_missed_payments_explanation:ntext',
            // 'employment_status_during_ppi_payment_you:ntext',
            // 'employment_status_during_ppi_payment_partner:ntext',
            // 'employment_status_change_details:ntext',
            // 'type_of_work_ppi_you:ntext',
            // 'type_of_work_ppi_partner:ntext',
            // 'name_of_employer_you:ntext',
            // 'name_of_employer_partner:ntext',
            // 'how_long_been_working_years_you:ntext',
            // 'how_long_been_working_months_you:ntext',
            // 'how_long_been_working_years_partner:ntext',
            // 'how_long_been_working_months_partner:ntext',
            // 'would_you_still_receive_payment:ntext',
            // 'would_you_still_receive_payment_details:ntext',
            // 'would_partner_still_receive_payment:ntext',
            // 'would_partner_still_receive_payment_details:ntext',
            // 'other_way_of_making_money_for_repayments_you:ntext',
            // 'other_way_of_making_money_for_repayments_you_details:ntext',
            // 'other_way_of_making_money_for_repayments_partner:ntext',
            // 'has_health_problems_you:ntext',
            // 'has_health_problems_you_details:ntext',
            // 'has_health_problems_partner:ntext',
            // 'what_happen_tookout_payment_protection:ntext',
            // 'reason_of_unhappiness_with_insurance:ntext',
            // 'complaining_on_behalf_name:ntext',
            // 'complaining_on_behalf_relationship:ntext',
            // 'complaining_on_behalf_daytime_phone:ntext',
            // 'complaining_on_behalf_email:ntext',
            // 'complaining_on_behalf_fax:ntext',
            // 'complaining_on_behalf_ref:ntext',
            // 'complaining_on_behalf_of_a_business_official_name:ntext',
            // 'complaining_on_behalf_of_a_business_num_employees',
            // 'complaining_on_behalf_of_a_business_num_partners',
            // 'complaining_on_behalf_of_a_business_annual_income',
            // 'company_details_responsible_on_complaint_name:ntext',
            // 'company_details_responsible_on_complaint_address:ntext',
            // 'company_details_responsible_on_complaint_phone:ntext',
            // 'adviser_who_sold_product_name:ntext',
            // 'adviser_who_sold_product_address:ntext',
            // 'adviser_who_sold_product_phone_number:ntext',
            // 'kind_of_service_complained:ntext',
            // 'kind_of_service_complained_reference_number:ntext',
            // 'full_complain_details:ntext',
            // 'when_did_transaction_take_place:ntext',
            // 'first_complain_took_place:ntext',
            // 'did_company_sent_message:ntext',
            // 'any_court_action:ntext',
            // 'settlement_details:ntext',
            // 'has_accessibility_problem:ntext',
            // 'client_signature_image:ntext',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
