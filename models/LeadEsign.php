<?php

namespace app\models;

use Yii;
use yii\base\ModelEvent;
use yii\db\BaseActiveRecord;

/**
 * This is the model class for table "lead_esign".
 *
 * @property integer $id
 * @property string $salutation
 * @property string $firstname
 * @property string $lastname
 * @property string $account_type
 * @property string $account_provider
 * @property double $monthly_account_charge
 * @property string $account_start_date
 * @property string $account_end_date
 * @property integer $is_ongoing
 * @property string $tried_to_claim_for_package
 * @property string $tried_to_claim_for_package_details
 * @property string $tried_to_claim_for_insurance_products
 * @property string $tried_to_claim_for_insurance_products_is_rejected
 * @property string $tried_to_claim_for_insurance_products_rejection_reason
 * @property string $used_benefits_packaged_bank
 * @property string $used_benefits_packaged_bank_details
 * @property string $know_benefit
 * @property string $registered_benefits_by_packaged_account
 * @property string $registered_benefits_by_packaged_account_details
 * @property string $understanding_of_features_and_benefits
 * @property string $address_while_bank_opened
 * @property string $bank_account_status
 * @property string $has_account_upgraded_downgraded
 * @property string $upgrade_comment
 * @property string $how_packaged_bank_account_sold
 * @property string $how_packaged_bank_account_sold_details
 * @property string $reason_to_takeout_packaged_account
 * @property string $reason_to_takeout_packaged_account_reason_of_speaking
 * @property string $noticed_account_fees
 * @property string $noticed_account_fees_details
 * @property string $actually_take_out_other_prodcuts
 * @property string $actually_take_out_other_prodcuts_details
 * @property string $did_they_give_advice
 * @property string $did_they_give_advice_clarify
 * @property string $felt_under_pressure
 * @property string $felt_under_pressure_details
 * @property string $had_free_bank
 * @property string $did_representative_explain_main_exclusions
 * @property string $did_representative_explain_receive_written_info
 * @property string $receive_any_mailing_post
 * @property string $explain_changes_effect_elligibility
 * @property string $explain_pay_excess_claim_on_insurance
 * @property string $has_uk_driving_license_during_upgrade
 * @property string $has_mobile_phone_during_upgrade
 * @property string $often_go_holiday_in_europe
 * @property string $often_go_holiday_outside_europe
 * @property string $often_go_holiday_and_winter_sports
 * @property string $has_health_problems_during_upgrade
 * @property string $has_registered_doctor_during_upgrade
 * @property string $products_owned_during_upgrade
 * @property string $has_packaged_account_during_upgrade
 * @property string $reason_why_unhappy
 * @property string $landline
 * @property string $mobile
 * @property string $work_number
 * @property string $email_address
 * @property string $preferred_method_of_contact
 * @property string $best_time_to_call
 * @property string $client_contact_notes
 * @property string $address1
 * @property string $address2
 * @property string $address3
 * @property string $address4
 * @property string $postcode
 * @property string $date_of_birth
 * @property string $previous_name
 * @property string $previous_address1
 * @property string $previous_address2
 * @property string $previous_address3
 * @property string $previous_address4
 * @property string $previous_postcode
 * @property string $other_previous_address
 * @property string $other_previous_address_details
 * @property string $account_number
 * @property string $sort_code
 * @property string $appointment_date
 * @property string $appointment_time
 * @property string $notes
 * @property string $client_signature_image
 * @property string $created_at
 * @property string $updated_at
 * @property string $hotkey
 * @property string $discuss_not_involed_packaged
 * @property string $discuss_not_involed_packaged_details
 * @property string $further_details_help_evidence
 */
class LeadEsign extends \yii\db\ActiveRecord
{
    public $discuss_not_involed_packaged;
    public $discuss_not_involed_packaged_details;
    public $further_details_help_evidence;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lead_esign';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['salutation', 'firstname', 'lastname', 'monthly_account_charge', 'client_signature_image'], 'required'],
            [['monthly_account_charge'], 'number'],
            [['discuss_not_involed_packaged','discuss_not_involed_packaged_details','account_start_date', 'account_end_date', 'date_of_birth', 'appointment_date', 'created_at', 'updated_at'], 'safe'],
            [['is_ongoing'], 'integer'],
            [['tried_to_claim_for_package_details', 'tried_to_claim_for_insurance_products_rejection_reason', 'used_benefits_packaged_bank_details', 'registered_benefits_by_packaged_account_details', 'understanding_of_features_and_benefits', 'address_while_bank_opened', 'bank_account_status', 'upgrade_comment', 'how_packaged_bank_account_sold_details', 'reason_to_takeout_packaged_account_reason_of_speaking', 'noticed_account_fees_details', 'did_they_give_advice_clarify', 'reason_why_unhappy', 'notes','discuss_not_involed_packaged','discuss_not_involed_packaged_details','further_details_help_evidence'], 'string'],
            [['salutation', 'firstname', 'lastname', 'account_type', 'account_provider', 'tried_to_claim_for_package', 'tried_to_claim_for_insurance_products', 'tried_to_claim_for_insurance_products_is_rejected', 'used_benefits_packaged_bank', 'know_benefit', 'registered_benefits_by_packaged_account', 'has_account_upgraded_downgraded', 'how_packaged_bank_account_sold', 'reason_to_takeout_packaged_account', 'noticed_account_fees', 'actually_take_out_other_prodcuts', 'actually_take_out_other_prodcuts_details', 'did_they_give_advice', 'felt_under_pressure', 'felt_under_pressure_details', 'had_free_bank', 'did_representative_explain_main_exclusions', 'did_representative_explain_receive_written_info', 'receive_any_mailing_post', 'explain_changes_effect_elligibility', 'explain_pay_excess_claim_on_insurance', 'has_uk_driving_license_during_upgrade', 'has_mobile_phone_during_upgrade', 'often_go_holiday_in_europe', 'often_go_holiday_outside_europe', 'often_go_holiday_and_winter_sports', 'has_health_problems_during_upgrade', 'has_registered_doctor_during_upgrade', 'products_owned_during_upgrade', 'has_packaged_account_during_upgrade', 'landline', 'mobile', 'work_number', 'email_address', 'preferred_method_of_contact', 'best_time_to_call', 'client_contact_notes', 'address1', 'address2', 'address3', 'address4', 'postcode', 'previous_name', 'previous_address1', 'previous_address2', 'previous_address3', 'previous_address4', 'previous_postcode', 'other_previous_address', 'other_previous_address_details', 'account_number', 'sort_code', 'appointment_time', 'client_signature_image', 'hotkey'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'salutation' => 'Salutation',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'account_type' => 'Account Type',
            'account_provider' => 'Account Provider',
            'monthly_account_charge' => 'Monthly Account Charge',
            'account_start_date' => 'Account Start Date',
            'account_end_date' => 'Account End Date',
            'is_ongoing' => 'Is Ongoing',
            'tried_to_claim_for_package' => 'Tried To Claim For Package',
            'tried_to_claim_for_package_details' => 'Tried To Claim For Package Details',
            'tried_to_claim_for_insurance_products' => 'Tried To Claim For Insurance Products',
            'tried_to_claim_for_insurance_products_is_rejected' => 'Tried To Claim For Insurance Products Is Rejected',
            'tried_to_claim_for_insurance_products_rejection_reason' => 'Tried To Claim For Insurance Products Rejection Reason',
            'used_benefits_packaged_bank' => 'Used Benefits Packaged Bank',
            'used_benefits_packaged_bank_details' => 'Used Benefits Packaged Bank Details',
            'know_benefit' => 'Know Benefit',
            'registered_benefits_by_packaged_account' => 'Registered Benefits By Packaged Account',
            'registered_benefits_by_packaged_account_details' => 'Registered Benefits By Packaged Account Details',
            'understanding_of_features_and_benefits' => 'Understanding Of Features And Benefits',
            'address_while_bank_opened' => 'Address While Bank Opened',
            'bank_account_status' => 'Bank Account Status',
            'has_account_upgraded_downgraded' => 'Has Account Upgraded Downgraded',
            'upgrade_comment' => 'Upgrade Comment',
            'how_packaged_bank_account_sold' => 'How Packaged Bank Account Sold',
            'how_packaged_bank_account_sold_details' => 'How Packaged Bank Account Sold Details',
            'reason_to_takeout_packaged_account' => 'Reason To Takeout Packaged Account',
            'reason_to_takeout_packaged_account_reason_of_speaking' => 'Reason To Takeout Packaged Account Reason Of Speaking',
            'noticed_account_fees' => 'Noticed Account Fees',
            'noticed_account_fees_details' => 'Noticed Account Fees Details',
            'actually_take_out_other_prodcuts' => 'Actually Take Out Other Prodcuts',
            'actually_take_out_other_prodcuts_details' => 'Actually Take Out Other Prodcuts Details',
            'did_they_give_advice' => 'Did They Give Advice',
            'did_they_give_advice_clarify' => 'Did They Give Advice Clarify',
            'felt_under_pressure' => 'Felt Under Pressure',
            'felt_under_pressure_details' => 'Felt Under Pressure Details',
            'had_free_bank' => 'Had Free Bank',
            'did_representative_explain_main_exclusions' => 'Did Representative Explain Main Exclusions',
            'did_representative_explain_receive_written_info' => 'Did Representative Explain Receive Written Info',
            'receive_any_mailing_post' => 'Receive Any Mailing Post',
            'explain_changes_effect_elligibility' => 'Explain Changes Effect Elligibility',
            'explain_pay_excess_claim_on_insurance' => 'Explain Pay Excess Claim On Insurance',
            'has_uk_driving_license_during_upgrade' => 'Has Uk Driving License During Upgrade',
            'has_mobile_phone_during_upgrade' => 'Has Mobile Phone During Upgrade',
            'often_go_holiday_in_europe' => 'Often Go Holiday In Europe',
            'often_go_holiday_outside_europe' => 'Often Go Holiday Outside Europe',
            'often_go_holiday_and_winter_sports' => 'Often Go Holiday And Winter Sports',
            'has_health_problems_during_upgrade' => 'Has Health Problems During Upgrade',
            'has_registered_doctor_during_upgrade' => 'Has Registered Doctor During Upgrade',
            'products_owned_during_upgrade' => 'Products Owned During Upgrade',
            'has_packaged_account_during_upgrade' => 'Has Packaged Account During Upgrade',
            'reason_why_unhappy' => 'Reason Why Unhappy',
            'landline' => 'Landline',
            'mobile' => 'Mobile',
            'work_number' => 'Work Number',
            'email_address' => 'Email Address',
            'preferred_method_of_contact' => 'Preferred Method Of Contact',
            'best_time_to_call' => 'Best Time To Call',
            'client_contact_notes' => 'Client Contact Notes',
            'address1' => 'Address1',
            'address2' => 'Address2',
            'address3' => 'Address3',
            'address4' => 'Address4',
            'postcode' => 'Postcode',
            'date_of_birth' => 'Date Of Birth',
            'previous_name' => 'Previous Name',
            'previous_address1' => 'Previous Address1',
            'previous_address2' => 'Previous Address2',
            'previous_address3' => 'Previous Address3',
            'previous_address4' => 'Previous Address4',
            'previous_postcode' => 'Previous Postcode',
            'other_previous_address' => 'Other Previous Address',
            'other_previous_address_details' => 'Other Previous Address Details',
            'account_number' => 'Account Number',
            'sort_code' => 'Sort Code',
            'appointment_date' => 'Appointment Date',
            'appointment_time' => 'Appointment Time',
            'notes' => 'Notes',
            'client_signature_image' => 'Client Signature Image',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'hotkey' => 'Hotkey',
        ];
    }

    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $outputfile = Yii::getAlias('@app/signatures/')
                .DIRECTORY_SEPARATOR
                .sprintf("%s_%s_%s", $this->firstname,$this->lastname,uniqid())
                .'.png';
            touch($outputfile);
            file_put_contents($outputfile, base64_decode($this->client_signature_image));
            $this->client_signature_image = $outputfile;
        }
        return parent::beforeSave($insert);
    }

}
