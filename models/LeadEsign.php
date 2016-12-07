<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "lead_esign".
 *
 * @property integer $id
 * @property string $hotkey
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
 * @property string $bank_account_status_comment
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
 * @property string $discuss_not_involed_packaged
 * @property string $discuss_not_involed_packaged_details
 * @property string $did_they_give_advice_clarify
 * @property string $did_they_give_advice_clarify_details
 * @property string $felt_under_pressure
 * @property string $felt_under_pressure_details
 * @property string $had_free_bank
 * @property string $did_representative_explain_main_exclusions
 * @property string $did_representative_explain_receive_written_info
 * @property string $receive_any_mailing_post
 * @property string $explain_changes_effect_elligibility
 * @property string $explain_pay_excess_claim_on_insurance
 * @property string $has_uk_driving_license_during_upgrade
 * @property string $own_a_car
 * @property string $has_mobile_phone_during_upgrade
 * @property string $has_mobile_phone_during_upgrade_has_internet_connection
 * @property string $often_go_holiday_in_europe
 * @property string $often_go_holiday_outside_europe
 * @property string $often_go_holiday_and_winter_sports
 * @property string $has_health_problems_during_upgrade
 * @property string $has_health_problems_during_upgrade_details
 * @property string $did_rep_explain_eligibility
 * @property string $has_registered_doctor_during_upgrade
 * @property string $after_upgrade_already_has_products
 * @property string $further_details_help_evidence
 * @property string $did_kept_insurance_after_sale
 * @property string $did_kept_insurance_after_sale_details
 * @property string $reason_kept_existing_cover
 * @property string $when_opened_account_has_other_account
 * @property string $when_opened_account_has_other_account_details
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
 * @property string $security_key
 * @property string $complaint_reference
 * @property string $financial_business_name
 * @property string $last_3_digit_account_num
 * @property string $is_complain_about_sale_packaged_bank_account
 * @property string $is_complain_about_sale_packaged_bank_account_details
 * @property string $notice_account_fees_on_statements
 * @property string $notice_account_fees_on_statements_details
 * @property string $current_situation_packaged_bank_account
 * @property string $current_situation_packaged_bank_account_explanation
 * @property string $is_address_outside_UK_at_package_upgrade
 * @property string $has_registered_doctor_during_upgrade_details
 * @property string $after_upgrade_already_has_products_details
 * @property string $complaint_whole_details
 * @property string $declaration_confirmed_tick
 * @property string $occupation
 * @property string salutation_complain_with
 * @property string firstname_complain_with
 * @property string lastname_complain_with
 * @property string occupation_complain_with
 * @property string date_of_birth_complain_with
 * @property string postcode_complain_with
 * @property string address1_complain_with
 * @property string address2_complain_with
 * @property string address3_complain_with
 * @property string address4_complain_with
 * @property string mobile_complain_with 
 * @property string behalf_of_charity_official_name
 * @property string behalf_of_charity_num_of_employees
 * @property string behalf_of_charity_num_of_partners
 * @property string behalf_of_charity_annual_income 
 * @property string business_responsible_details_name
 * @property string business_responsible_details_address
 * @property string business_responsible_details_phone
 * @property string adviser_detail_name
 * @property string adviser_detail_phone
 * @property string adviser_detail_address
 * @property string kind_of_service_complain
 * @property string kind_of_service_complain_reference
 * @property string when_trasaction_happen
 * @property string when_first_complain_business
 * @property string has_business_complaining_sent_letter
 * @property string has_court_action_to_complain
 * @property string settlement_with_business_details
 * @property string is_ineed_of_practical_help
 * @property string is_ineed_of_practical_help_details
 * @property string final_tick_checklist 
 * @property string $created_at
 * @property string $updated_at
 */
class LeadEsign extends \yii\db\ActiveRecord
{
    const LEAD_ESIGN_NEW_LEAD = 0x1;
    const SIGNATURE_FINAL_STEP = 0x2;

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
            [['firstname', 'lastname', 'email_address'], 'required'],
            [['monthly_account_charge'], 'number'],
            [['after_upgrade_already_has_products', 'security_key', 'account_start_date', 'account_end_date', 'date_of_birth', 'appointment_date', 'created_at', 'updated_at'], 'safe'],
            [['is_ongoing'], 'integer'],
            [['behalf_of_charity_num_of_employees','behalf_of_charity_num_of_partners','behalf_of_charity_annual_income','salutation_complain_with' ,'firstname_complain_with' ,'lastname_complain_with' ,'occupation_complain_with' ,'date_of_birth_complain_with','postcode_complain_with','address1_complain_with','address2_complain_with','address3_complain_with','address4_complain_with','mobile_complain_with','occupation','declaration_confirmed_tick','complaint_whole_details','after_upgrade_already_has_products_details','has_registered_doctor_during_upgrade_details','is_address_outside_UK_at_package_upgrade','current_situation_packaged_bank_account','current_situation_packaged_bank_account_explanation','notice_account_fees_on_statements','notice_account_fees_on_statements_details','is_complain_about_sale_packaged_bank_account','is_complain_about_sale_packaged_bank_account_details','complaint_reference','financial_business_name','last_3_digit_account_num','tried_to_claim_for_package_details', 'tried_to_claim_for_insurance_products_rejection_reason', 'used_benefits_packaged_bank_details', 'registered_benefits_by_packaged_account_details', 'understanding_of_features_and_benefits', 'address_while_bank_opened', 'bank_account_status', 'bank_account_status_comment', 'upgrade_comment', 'how_packaged_bank_account_sold_details', 'reason_to_takeout_packaged_account_reason_of_speaking', 'noticed_account_fees_details', 'actually_take_out_other_prodcuts_details', 'discuss_not_involed_packaged_details', 'did_they_give_advice_clarify_details', 'felt_under_pressure_details', 'has_health_problems_during_upgrade_details', 'did_kept_insurance_after_sale_details', 'when_opened_account_has_other_account_details', 'reason_why_unhappy', 'notes'], 'string'],
            /*safe*/            
            [['has_business_complaining_sent_letter','has_court_action_to_complain','settlement_with_business_details','is_ineed_of_practical_help','is_ineed_of_practical_help_details','final_tick_checklist','when_trasaction_happen','when_first_complain_business','kind_of_service_complain_reference','kind_of_service_complain','business_responsible_details_name','business_responsible_details_address','business_responsible_details_phone','adviser_detail_name','adviser_detail_address','adviser_detail_phone','behalf_of_charity_num_of_employees','behalf_of_charity_num_of_partners','behalf_of_charity_annual_income','salutation_complain_with' ,'firstname_complain_with' ,'lastname_complain_with' ,'occupation_complain_with' ,'date_of_birth_complain_with','postcode_complain_with','address1_complain_with','address2_complain_with','address3_complain_with','address4_complain_with','mobile_complain_with','occupation','declaration_confirmed_tick','complaint_whole_details','after_upgrade_already_has_products_details','has_registered_doctor_during_upgrade_details','is_address_outside_UK_at_package_upgrade','current_situation_packaged_bank_account','current_situation_packaged_bank_account_explanation','notice_account_fees_on_statements','notice_account_fees_on_statements_details','is_complain_about_sale_packaged_bank_account','is_complain_about_sale_packaged_bank_account_details','complaint_reference','financial_business_name','last_3_digit_account_num','hotkey', 'salutation', 'firstname', 'lastname', 'account_type', 'account_provider', 'tried_to_claim_for_package', 'tried_to_claim_for_insurance_products', 'tried_to_claim_for_insurance_products_is_rejected', 'used_benefits_packaged_bank', 'know_benefit', 'registered_benefits_by_packaged_account', 'has_account_upgraded_downgraded', 'how_packaged_bank_account_sold', 'reason_to_takeout_packaged_account', 'noticed_account_fees', 'actually_take_out_other_prodcuts', 'did_they_give_advice', 'discuss_not_involed_packaged', 'did_they_give_advice_clarify', 'felt_under_pressure', 'had_free_bank', 'did_representative_explain_main_exclusions', 'did_representative_explain_receive_written_info', 'receive_any_mailing_post', 'explain_changes_effect_elligibility', 'explain_pay_excess_claim_on_insurance', 'has_uk_driving_license_during_upgrade', 'own_a_car', 'has_mobile_phone_during_upgrade', 'has_mobile_phone_during_upgrade_has_internet_connection', 'often_go_holiday_in_europe', 'often_go_holiday_outside_europe', 'often_go_holiday_and_winter_sports', 'has_health_problems_during_upgrade', 'did_rep_explain_eligibility', 'further_details_help_evidence', 'did_kept_insurance_after_sale', 'reason_kept_existing_cover', 'when_opened_account_has_other_account', 'landline', 'mobile', 'work_number', 'email_address', 'preferred_method_of_contact', 'best_time_to_call', 'client_contact_notes', 'address1', 'address2', 'address3', 'address4', 'postcode', 'previous_name', 'previous_address1', 'previous_address2', 'previous_address3', 'previous_address4', 'previous_postcode', 'other_previous_address', 'other_previous_address_details', 'account_number', 'sort_code', 'appointment_time', 'client_signature_image', 'has_registered_doctor_during_upgrade'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hotkey' => 'Hotkey',
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
            'bank_account_status_comment' => 'Bank Account Status Comment',
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
            'discuss_not_involed_packaged' => 'Discuss Not Involed Packaged',
            'discuss_not_involed_packaged_details' => 'Discuss Not Involed Packaged Details',
            'did_they_give_advice_clarify' => 'Did They Give Advice Clarify',
            'did_they_give_advice_clarify_details' => 'Did They Give Advice Clarify Details',
            'felt_under_pressure' => 'Felt Under Pressure',
            'felt_under_pressure_details' => 'Felt Under Pressure Details',
            'had_free_bank' => 'Had Free Bank',
            'did_representative_explain_main_exclusions' => 'Did Representative Explain Main Exclusions',
            'did_representative_explain_receive_written_info' => 'Did Representative Explain Receive Written Info',
            'receive_any_mailing_post' => 'Receive Any Mailing Post',
            'explain_changes_effect_elligibility' => 'Explain Changes Effect Elligibility',
            'explain_pay_excess_claim_on_insurance' => 'Explain Pay Excess Claim On Insurance',
            'has_uk_driving_license_during_upgrade' => 'Has Uk Driving License During Upgrade',
            'own_a_car' => 'Own A Car',
            'has_mobile_phone_during_upgrade' => 'Has Mobile Phone During Upgrade',
            'has_mobile_phone_during_upgrade_has_internet_connection' => 'Has Mobile Phone During Upgrade Has Internet Connection',
            'often_go_holiday_in_europe' => 'Often Go Holiday In Europe',
            'often_go_holiday_outside_europe' => 'Often Go Holiday Outside Europe',
            'often_go_holiday_and_winter_sports' => 'Often Go Holiday And Winter Sports',
            'has_health_problems_during_upgrade' => 'Has Health Problems During Upgrade',
            'has_health_problems_during_upgrade_details' => 'Has Health Problems During Upgrade Details',
            'did_rep_explain_eligibility' => 'Did Rep Explain Eligibility',
            'has_registered_doctor_during_upgrade' => 'Has Registered Doctor During Upgrade',
            'after_upgrade_already_has_products' => 'After upgrade already has products',
            'further_details_help_evidence' => 'Further Details Help Evidence',
            'did_kept_insurance_after_sale' => 'Did Kept Insurance After Sale',
            'did_kept_insurance_after_sale_details' => 'Did Kept Insurance After Sale Details',
            'reason_kept_existing_cover' => 'Reason Kept Existing Cover',
            'when_opened_account_has_other_account' => 'When Opened Account Has Other Account',
            'when_opened_account_has_other_account_details' => 'When Opened Account Has Other Account Details',
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
            'complaint_reference' => 'Complaint Reference',
            'financial_business_name' => 'Financial Business Name',
            'last_3_digit_account_num' => 'Last 3 Digit Account Number',
            'is_complain_about_sale_packaged_bank_account' => 'Is complain about sale packaged bank account',
            'is_complain_about_sale_packaged_bank_account_details' => 'Complain about sale packaged bank account (details)',
            'current_situation_packaged_bank_account' => 'Current situation of packaged bank account',
            'current_situation_packaged_bank_account_explanation' => 'Current situation of packaged bank account (details)',
            'is_address_outside_UK_at_package_upgrade' => 'Is address outside UK during package bank open or upgrade',
            'has_registered_doctor_during_upgrade_details' => 'Registered for any of the benefits provided by your packaged bank account (details)',
            'after_upgrade_already_has_products_details' => 'After upgrade already has products (details)',
            'complaint_whole_details' => 'Whole complain (details)',
            'declaration_confirmed_tick' => 'Declaration confirmed tick',
            'salutation_complain_with' => 'Title',
            'firstname_complain_with' => 'Firstname',
            'lastname_complain_with' => 'Lastname',
            'occupation_complain_with' => 'Occupation',
            'date_of_birth_complain_with' => 'Date of birth',
            'postcode_complain_with'=>'Postcode',
            'address1_complain_with'=>'Address1',
            'address2_complain_with'=>'Address2',
            'address3_complain_with'=>'Address3',
            'address4_complain_with'=>'Address4',
            'mobile_complain_with'=>'Mobile',
            'occupation' => 'Occupation',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }


    public function beforeSave($insert)
    {
        $tempContainer = [];
        if ($this->isNewRecord) {
            $this->security_key = uniqid();
            $this->trigger(LeadEsign::LEAD_ESIGN_NEW_LEAD);
        }
        if (isset($this->after_upgrade_already_has_products) && is_array($this->after_upgrade_already_has_products)) {
            $tempContainer = array_values($this->after_upgrade_already_has_products);
        } else if (!is_array($this->after_upgrade_already_has_products) && is_string($this->after_upgrade_already_has_products)) {
            $tempContainer[] = $this->after_upgrade_already_has_products;
        }
        $this->after_upgrade_already_has_products = implode(",", $tempContainer);
        $this->account_start_date = date("Y-m-d H:i:s",strtotime($this->account_start_date));
        $this->account_end_date = date("y-m-d H:i:s",strtotime($this->account_end_date));
        $this->date_of_birth = date("Y-m-d H:i:s",strtotime($this->date_of_birth));
        $this->monthly_account_charge = floatval($this->monthly_account_charge);
        $this->is_ongoing = intval($this->is_ongoing);

        return parent::beforeSave($insert);
    }

    public function saveClientSignature()
    {
        if (isset($this->client_signature_image) && !is_null($this->client_signature_image) && !empty($this->client_signature_image)) {
            $outputfile = Yii::getAlias('@app/signatures/')
                . DIRECTORY_SEPARATOR
                . sprintf("%s_%s_%s", $this->firstname, $this->lastname, uniqid())
                . '.png';
            touch($outputfile);
            file_put_contents($outputfile, base64_decode($this->client_signature_image));
            $this->client_signature_image = $outputfile;
        }
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression("NOW()"),
            ],
        ];
    }


}
