<?php

namespace app\models;

use Yii;
use yii\base\ModelEvent;
use yii\db\BaseActiveRecord;

/**
 * This is the model class for table "ppi_lead".
 *
 * @property integer $id
 * @property string $salutation
 * @property string $firstname
 * @property string $lastname
 * @property string $prev_salutation
 * @property string $prev_firstname
 * @property string $prev_lastname
 * @property string $partner_detail_title
 * @property string $partner_detail_firstname
 * @property string $partner_detail_lastname
 * @property string $partner_detail_date_of_birth
 * @property string $account_start_date
 * @property string $account_end_date
 * @property string $finance_provider
 * @property string $did_broker_arrange
 * @property string $broker_name
 * @property string $ppi_claim_type
 * @property double $amount_ppi
 * @property string $daytime_phone
 * @property string $home_phone
 * @property string $mobile
 * @property string $email_address
 * @property string $financial_business_name
 * @property string $ppi_policy_number
 * @property string $when_did_you_takeout_ppi
 * @property integer $can_remember_date_of_ppi_takeout
 * @property string $ppi_cover_type
 * @property string $how_was_ppi_sold
 * @property string $did_financial_business_give_advice
 * @property string $ppi_payment_method
 * @property string $ppi_insurance_current_situation
 * @property string $ppi_insurance_cancelled_situation_date
 * @property string $had_a_claim_ppi_insurance
 * @property string $had_a_claim_ppi_insurance_details
 * @property string $bought_cover_with_ppi_insurance
 * @property string $account_number
 * @property string $reason_of_borrowing
 * @property string $borrowed_money_to_payoff_debt_details
 * @property string $ever_missed_payments
 * @property string $ever_missed_payments_explanation
 * @property string $employment_status_during_ppi_payment_you
 * @property string $employment_status_during_ppi_payment_you_hours_work
 * @property string $employment_status_during_ppi_payment_partner
 * @property string $employment_status_during_ppi_payment_partner_hours_work
 * @property string $employment_status_change_details
 * @property string $type_of_work_ppi_you
 * @property string $type_of_work_ppi_partner
 * @property string $name_of_employer_you
 * @property string $name_of_employer_partfner
 * @property string $how_long_been_working_years_you
 * @property string $how_long_been_working_months_you
 * @property string $how_long_been_working_years_partner
 * @property string $how_long_been_working_months_partner
 * @property string $would_you_still_receive_payment
 * @property string $would_you_still_receive_payment_details
 * @property string $would_partner_still_receive_payment
 * @property string $would_partner_still_receive_payment_details
 * @property string $other_way_of_making_money_for_repayments_you
 * @property string $other_way_of_making_money_for_repayments_you_details
 * @property string $other_way_of_making_money_for_repayments_partner
 * @property string $has_health_problems_you
 * @property string $has_health_problems_you_details
 * @property string $has_health_problems_partner
 * @property string $what_happen_tookout_payment_protection
 * @property string $reason_of_unhappiness_with_insurance
 * @property string $complaining_on_behalf_name
 * @property string $complaining_on_behalf_relationship
 * @property string $complaining_on_behalf_daytime_phone
 * @property string $complaining_on_behalf_email
 * @property string $complaining_on_behalf_fax
 * @property string $complaining_on_behalf_ref
 * @property string $complaining_on_behalf_of_a_business_official_name
 * @property integer $complaining_on_behalf_of_a_business_num_employees
 * @property integer $complaining_on_behalf_of_a_business_num_partners
 * @property double $complaining_on_behalf_of_a_business_annual_income
 * @property string $company_details_responsible_on_complaint_name
 * @property string $company_details_responsible_on_complaint_address
 * @property string $company_details_responsible_on_complaint_phone
 * @property string $adviser_who_sold_product_name
 * @property string $adviser_who_sold_product_address
 * @property string $adviser_who_sold_product_phone_number
 * @property string $kind_of_service_complained
 * @property string $kind_of_service_complained_reference_number
 * @property string $full_complain_details
 * @property string $when_did_transaction_take_place
 * @property string $first_complain_took_place
 * @property string $did_company_sent_message
 * @property string $any_court_action
 * @property string $settlement_details
 * @property string $has_accessibility_problem
 * @property string $client_signature_image
 * @property string $pdf_template
 * @property string $security_key
 * @property string $address1
 * @property string $address2
 * @property string $address3
 * @property string $address4
 * @property string $address5
 * @property string $postcode
 * @property string $prev_address1
 * @property string $prev_address2
 * @property string $prev_address3
 * @property string $prev_address4  
 * @property string $prev_address5
 * @property string $prev_postcode
 * @property string $date_of_birth
 * @property string $account_provider
 * @property string $monthly_account_charge
 * @property string $finance_start
 * @property string $finance_end
 * @property string $is_joint
 * @property string $finance_status
 * @property string $final_tick_checklist
 * @property string $created_at
 * @property string $updated_at
 */
class PPILead extends \yii\db\ActiveRecord
{

    public $complaining_on_behalf_name = "Money Active Limited";
    public $complaining_on_behalf_relationship = "Claims Handler";
    public $complaining_on_behalf_daytime_phone = "01455 530 034";
    public $complaining_on_behalf_email = "";
    public $complaining_on_behalf_fax = "0845 358 2510";
    public $complaining_on_behalf_ref = "n/a";
    public $complaining_on_behalf_of_a_business_official_name = "";
    public $complaining_on_behalf_of_a_business_num_employees = "";
    public $complaining_on_behalf_of_a_business_num_partners = "";
    public $complaining_on_behalf_of_a_business_annual_income = "";

    const EVENT_NEW_LEAD = 'EVENT_NEW_LEAD';
    const SIGNATURE_FINAL_STEP = 'EVENT_CLIENT_SIGNATURE';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ppi_lead';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $safeAttributes = [
            'account_start_date',
            'account_end_date',
            'when_did_you_takeout_ppi',
            'ppi_insurance_cancelled_situation_date',
            'created_at',
            'updated_at',
            'date_of_birth',
            'partner_detail_date_of_birth'
        ];

        return [
            [['salutation','firstname','lastname', 'email_address','finance_provider','home_phone','mobile','email_address','date_of_birth','did_broker_arrange','ppi_claim_type'], 'required'],
            [['prev_salutation','prev_firstname', 'prev_lastname','salutation', 'firstname', 'lastname', 'finance_provider', 'did_broker_arrange', 'broker_name', 'ppi_claim_type', 'daytime_phone', 'home_phone', 'mobile', 'email_address', 'financial_business_name', 'ppi_policy_number', 'ppi_cover_type', 'how_was_ppi_sold', 'did_financial_business_give_advice', 'ppi_payment_method', 'ppi_insurance_current_situation', 'had_a_claim_ppi_insurance', 'had_a_claim_ppi_insurance_details', 'bought_cover_with_ppi_insurance', 'account_number', 'reason_of_borrowing', 'borrowed_money_to_payoff_debt_details', 'ever_missed_payments', 'ever_missed_payments_explanation', 'employment_status_during_ppi_payment_you', 'employment_status_during_ppi_payment_partner', 'employment_status_change_details', 'type_of_work_ppi_you', 'type_of_work_ppi_partner', 'name_of_employer_you', 'name_of_employer_partner', 'how_long_been_working_years_you', 'how_long_been_working_months_you', 'how_long_been_working_years_partner', 'how_long_been_working_months_partner', 'would_you_still_receive_payment', 'would_you_still_receive_payment_details', 'would_partner_still_receive_payment', 'would_partner_still_receive_payment_details', 'other_way_of_making_money_for_repayments_you', 'other_way_of_making_money_for_repayments_you_details', 'other_way_of_making_money_for_repayments_partner', 'has_health_problems_you', 'has_health_problems_you_details', 'has_health_problems_partner', 'what_happen_tookout_payment_protection', 'reason_of_unhappiness_with_insurance', 'complaining_on_behalf_name', 'complaining_on_behalf_relationship', 'complaining_on_behalf_daytime_phone', 'complaining_on_behalf_email', 'complaining_on_behalf_fax', 'complaining_on_behalf_ref', 'complaining_on_behalf_of_a_business_official_name', 'company_details_responsible_on_complaint_name', 'company_details_responsible_on_complaint_address', 'company_details_responsible_on_complaint_phone', 'adviser_who_sold_product_name', 'adviser_who_sold_product_address', 'adviser_who_sold_product_phone_number', 'kind_of_service_complained', 'kind_of_service_complained_reference_number', 'full_complain_details', 'when_did_transaction_take_place', 'first_complain_took_place', 'did_company_sent_message', 'any_court_action', 'settlement_details', 'has_accessibility_problem', 'client_signature_image','pdf_template','security_key','address1','address2','address3','address4','address5','postcode','account_provider','prev_address1', 'prev_address2', 'prev_address3', 'prev_address4', 'prev_address5', 'prev_postcode','finance_start','finance_end','prev_salutation', 'prev_firstname', 'prev_lastname','finance_status','partner_detail_title','partner_detail_firstname','partner_detail_lastname','employment_status_during_ppi_payment_you_hours_work','employment_status_during_ppi_payment_partner_hours_work','final_tick_checklist','address1','address2','address3','address4','address5','postcode'], 'string'],
            [$safeAttributes, 'safe'],
            [['amount_ppi', 'complaining_on_behalf_of_a_business_annual_income','monthly_account_charge'], 'number'],
            [['can_remember_date_of_ppi_takeout', 'complaining_on_behalf_of_a_business_num_employees', 'complaining_on_behalf_of_a_business_num_partners','is_joint'], 'integer'],
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
            'prev_salutation' => 'Salutation',
            'prev_firstname' => 'Firstname',
            'prev_lastname' => 'Lastname',
            'account_start_date' => 'Account Start Date',
            'account_end_date' => 'Account End Date',
            'finance_provider' => 'Finance Provider',
            'did_broker_arrange' => 'Did Broker Arrange',
            'broker_name' => 'Broker Name',
            'ppi_claim_type' => 'Ppi Claim Type',
            'amount_ppi' => 'Amount Ppi',
            'daytime_phone' => 'Daytime Phone',
            'home_phone' => 'Home Phone',
            'mobile' => 'Mobile',
            'email_address' => 'Email Address',
            'financial_business_name' => 'Financial Business Name',
            'ppi_policy_number' => 'Ppi Policy Number',
            'when_did_you_takeout_ppi' => 'When Did You Takeout Ppi',
            'can_remember_date_of_ppi_takeout' => 'Can Remember Date Of Ppi Takeout',
            'ppi_cover_type' => 'Ppi Cover Type',
            'how_was_ppi_sold' => 'How Was Ppi Sold',
            'did_financial_business_give_advice' => 'Did Financial Business Give Advice',
            'ppi_payment_method' => 'Ppi Payment Method',
            'ppi_insurance_current_situation' => 'Ppi Insurance Current Situation',
            'ppi_insurance_cancelled_situation_date' => 'Ppi Insurance Cancelled Situation Date',
            'had_a_claim_ppi_insurance' => 'Had A Claim Ppi Insurance',
            'had_a_claim_ppi_insurance_details' => 'Had A Claim Ppi Insurance Details',
            'bought_cover_with_ppi_insurance' => 'Bought Cover With Ppi Insurance',
            'account_number' => 'Account Number',
            'reason_of_borrowing' => 'Reason for borrowing',
            'borrowed_money_to_payoff_debt_details' => 'Borrowed Money To Payoff Debt Details',
            'ever_missed_payments' => 'Ever Missed Payments',
            'ever_missed_payments_explanation' => 'Ever Missed Payments Explanation',
            'employment_status_during_ppi_payment_you' => 'Employment Status During Ppi Payment You',
            'employment_status_during_ppi_payment_partner' => 'Employment Status During Ppi Payment Partner',
            'employment_status_during_ppi_payment_you_hours_work' => 'Hours each week(You)',
            'employment_status_during_ppi_payment_partner_hours_work' => 'Hours each week(Partner)',
            'employment_status_change_details' => 'Employment Status Change Details',
            'type_of_work_ppi_you' => 'Type Of Work Ppi You',
            'type_of_work_ppi_partner' => 'Type Of Work Ppi Partner',
            'name_of_employer_you' => 'Name Of Employer You',
            'name_of_employer_partner' => 'Name Of Employer Partner',
            'how_long_been_working_years_you' => 'How Long Been Working Years You',
            'how_long_been_working_months_you' => 'How Long Been Working Months You',
            'how_long_been_working_years_partner' => 'How Long Been Working Years Partner',
            'how_long_been_working_months_partner' => 'How Long Been Working Months Partner',
            'would_you_still_receive_payment' => 'Would You Still Receive Payment',
            'would_you_still_receive_payment_details' => 'Would You Still Receive Payment Details',
            'would_partner_still_receive_payment' => 'Would Partner Still Receive Payment',
            'would_partner_still_receive_payment_details' => 'Would Partner Still Receive Payment Details',
            'other_way_of_making_money_for_repayments_you' => 'Other Way Of Making Money For Repayments You',
            'other_way_of_making_money_for_repayments_you_details' => 'Other Way Of Making Money For Repayments You Details',
            'other_way_of_making_money_for_repayments_partner' => 'Other Way Of Making Money For Repayments Partner',
            'has_health_problems_you' => 'Has Health Problems You',
            'has_health_problems_you_details' => 'Has Health Problems You Details',
            'has_health_problems_partner' => 'Has Health Problems Partner',
            'what_happen_tookout_payment_protection' => 'What Happen Tookout Payment Protection',
            'reason_of_unhappiness_with_insurance' => 'Reason Of Unhappiness With Insurance',
            'complaining_on_behalf_name' => 'Complaining On Behalf Name',
            'complaining_on_behalf_relationship' => 'Complaining On Behalf Relationship',
            'complaining_on_behalf_daytime_phone' => 'Complaining On Behalf Daytime Phone',
            'complaining_on_behalf_email' => 'Complaining On Behalf Email',
            'complaining_on_behalf_fax' => 'Complaining On Behalf Fax',
            'complaining_on_behalf_ref' => 'Complaining On Behalf Ref',
            'complaining_on_behalf_of_a_business_official_name' => 'Complaining On Behalf Of A Business Official Name',
            'complaining_on_behalf_of_a_business_num_employees' => 'Complaining On Behalf Of A Business Num Employees',
            'complaining_on_behalf_of_a_business_num_partners' => 'Complaining On Behalf Of A Business Num Partners',
            'complaining_on_behalf_of_a_business_annual_income' => 'Complaining On Behalf Of A Business Annual Income',
            'company_details_responsible_on_complaint_name' => 'Company Details Responsible On Complaint Name',
            'company_details_responsible_on_complaint_address' => 'Company Details Responsible On Complaint Address',
            'company_details_responsible_on_complaint_phone' => 'Company Details Responsible On Complaint Phone',
            'adviser_who_sold_product_name' => 'Adviser Who Sold Product Name',
            'adviser_who_sold_product_address' => 'Adviser Who Sold Product Address',
            'adviser_who_sold_product_phone_number' => 'Adviser Who Sold Product Phone Number',
            'kind_of_service_complained' => 'Kind Of Service Complained',
            'kind_of_service_complained_reference_number' => 'Kind Of Service Complained Reference Number',
            'full_complain_details' => 'Full Complain Details',
            'when_did_transaction_take_place' => 'When Did Transaction Take Place',
            'first_complain_took_place' => 'First Complain Took Place',
            'did_company_sent_message' => 'Did Company Sent Message',
            'any_court_action' => 'Any Court Action',
            'settlement_details' => 'Settlement Details',
            'has_accessibility_problem' => 'Has Accessibility Problem',
            'client_signature_image' => 'Client Signature Image',
            'pdf_template' => 'PDF Template',
            'security_key' => 'Reference Number',
            'address1' => 'House Number/Name',
            'address2' => 'Street Name',
            'address3' => 'Locality',
            'address4' => 'City/Town',
            'address5' => 'County',
            'postcode' => 'Postal Code',
            'prev_address1' => 'House Number/Name',
            'prev_address2' => 'Street Name',
            'prev_address3' => 'Locality',
            'prev_address4' => 'City/Town',
            'prev_address5' => 'County',
            'prev_postcode' => 'Postal Code',
            'partner_detail_title' => 'Title',
            'partner_detail_firstname' => 'Firstname',
            'partner_detail_lastname' => 'Lastname',
            'partner_detail_date_of_birth' => 'Date of birth',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->security_key = uniqid();
        }

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
}
