<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\LeadEsign */

$this->title = "$model->firstname $model->lastname";
$this->params['breadcrumbs'][] = ['label' => 'Lead Esigns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lead-esign-view">

    <h1><?= Html::encode($this->title) ?> ,</h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('<i class="fa fa-file-pdf-o"></i> View PDF', ['/export/'.$model->security_key,], ['class' => 'btn btn-default pull-right']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'hotkey',
            'salutation',
            'firstname',
            'lastname',
            'account_type',
            'account_provider',
            'monthly_account_charge',
            'account_start_date',
            'account_end_date',
            'is_ongoing',
            'tried_to_claim_for_package',
            'tried_to_claim_for_package_details:ntext',
            'tried_to_claim_for_insurance_products',
            'tried_to_claim_for_insurance_products_is_rejected',
            'tried_to_claim_for_insurance_products_rejection_reason:ntext',
            'used_benefits_packaged_bank',
            'used_benefits_packaged_bank_details:ntext',
            'know_benefit',
            'registered_benefits_by_packaged_account',
            'registered_benefits_by_packaged_account_details:ntext',
            'understanding_of_features_and_benefits:ntext',
            'address_while_bank_opened:ntext',
            'bank_account_status:ntext',
            'bank_account_status_comment:ntext',
            'has_account_upgraded_downgraded',
            'upgrade_comment:ntext',
            'how_packaged_bank_account_sold',
            'how_packaged_bank_account_sold_details:ntext',
            'reason_to_takeout_packaged_account',
            'reason_to_takeout_packaged_account_reason_of_speaking:ntext',
            'noticed_account_fees',
            'noticed_account_fees_details:ntext',
            'actually_take_out_other_prodcuts',
            'actually_take_out_other_prodcuts_details:ntext',
            'did_they_give_advice',
            'discuss_not_involed_packaged',
            'discuss_not_involed_packaged_details:ntext',
            'did_they_give_advice_clarify',
            'did_they_give_advice_clarify_details:ntext',
            'felt_under_pressure',
            'felt_under_pressure_details:ntext',
            'had_free_bank',
            'did_representative_explain_main_exclusions',
            'did_representative_explain_receive_written_info',
            'receive_any_mailing_post',
            'explain_changes_effect_elligibility',
            'explain_pay_excess_claim_on_insurance',
            'has_uk_driving_license_during_upgrade',
            'own_a_car',
            'has_mobile_phone_during_upgrade',
            'has_mobile_phone_during_upgrade_has_internet_connection',
            'often_go_holiday_in_europe',
            'often_go_holiday_outside_europe',
            'often_go_holiday_and_winter_sports',
            'has_health_problems_during_upgrade',
            'has_health_problems_during_upgrade_details:ntext',
            'did_rep_explain_eligibility',
            'has_registered_doctor_during_upgrade',
            'after_upgrade_already_has_products',
            'further_details_help_evidence',
            'did_kept_insurance_after_sale',
            'did_kept_insurance_after_sale_details:ntext',
            'reason_kept_existing_cover',
            'when_opened_account_has_other_account',
            'when_opened_account_has_other_account_details:ntext',
            'reason_why_unhappy:ntext',
            'landline',
            'mobile',
            'work_number',
            'email_address:email',
            'preferred_method_of_contact',
            'best_time_to_call',
            'client_contact_notes',
            'address1',
            'address2',
            'address3',
            'address4',
            'postcode',
            'date_of_birth',
            'previous_name',
            'previous_address1',
            'previous_address2',
            'previous_address3',
            'previous_address4',
            'previous_postcode',
            'other_previous_address',
            'other_previous_address_details',
            'account_number',
            'sort_code',
            'appointment_date',
            'appointment_time',
            'notes:ntext',
            'client_signature_image',
            'security_key',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
