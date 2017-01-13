<?php

use yii\db\Migration;

class m170109_104906_create_ppi_lead_model extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%ppi_lead}}', [
            'id' => $this->primaryKey(),
            /*personal information*/
            'salutation' => $this->text(),
            'firstname' => $this->text(),
            'lastname' => $this->text(),
            'account_start_date' => $this->dateTime(),
            'account_end_date' => $this->dateTime(),            
            'finance_provider' => $this->text(),
            'did_broker_arrange' => $this->text(),
            'broker_name' => $this->text(),
            'ppi_claim_type' => $this->text(),
            'amount_ppi' => $this->double(),
            /*Contact Information*/
            'daytime_phone'=>$this->text(),
            'home_phone'=>$this->text(),
            'mobile'=>$this->text(),
            'email_address'=>$this->text(),

            /* Section B ppi information*/
            'financial_business_name'=>$this->text(),
            'ppi_policy_number'=>$this->text(),
            'when_did_you_takeout_ppi'=>$this->datetime(),
            'can_remember_date_of_ppi_takeout'=>$this->boolean(),// automatically true if  when_did_you_takeout_ppi has value
            'ppi_cover_type'=>$this->text(),
            'how_was_ppi_sold'=>$this->text(),
            'did_financial_business_give_advice'=>$this->text(),
            'ppi_payment_method'=>$this->text(),//
            'ppi_insurance_current_situation'=>$this->text(),//
            'ppi_insurance_cancelled_situation_date'=>$this->date(),//
            'had_a_claim_ppi_insurance'=>$this->text(),//
            'had_a_claim_ppi_insurance_details'=>$this->text(),//
            /*section C*/
            'bought_cover_with_ppi_insurance'=>$this->text(),//            
            'account_number'=>$this->text(),//            
            'reason_of_borrowing'=>$this->text(),//
            // json format using schema model
            'borrowed_money_to_payoff_debt_details'=>$this->text(),            
            /**
            **  
            [
                {
                    'company_name':"",
                    'type':"[credit_cards|loans]",
                    'amount':"",
                    'takeout_date':"",
                    'takeoff_date':"",
                }
            ]
            **  
            **/
            'ever_missed_payments'=>$this->text(),
            'ever_missed_payments_explanation'=>$this->text(),
            /*section D*/
            'employment_status_during_ppi_payment_you'=>$this->text(),
            'employment_status_during_ppi_payment_partner'=>$this->text(),
            'employment_status_change_details'=>$this->text(),
            'type_of_work_ppi_you'=>$this->text(),
            'type_of_work_ppi_partner'=>$this->text(),
            'name_of_employer_you'=>$this->text(),
            'name_of_employer_partner'=>$this->text(),
            'how_long_been_working_years_you'=>$this->text(),
            'how_long_been_working_months_you'=>$this->text(),
            'how_long_been_working_years_partner'=>$this->text(),
            'how_long_been_working_months_partner'=>$this->text(),
            'would_you_still_receive_payment'=>$this->text(),
            'would_you_still_receive_payment_details'=>$this->text(),
            'would_partner_still_receive_payment'=>$this->text(),
            'would_partner_still_receive_payment_details'=>$this->text(),
            'other_way_of_making_money_for_repayments_you'=>$this->text(),
            'other_way_of_making_money_for_repayments_you_details'=>$this->text(),
            'other_way_of_making_money_for_repayments_partner'=>$this->text(),
            'has_health_problems_you'=>$this->text(),
            'has_health_problems_you_details'=>$this->text(),
            'has_health_problems_partner'=>$this->text(),
            'what_happen_tookout_payment_protection'=>$this->text(),
            'reason_of_unhappiness_with_insurance'=>$this->text(),
            'complaining_on_behalf_name'=>$this->text(),
            'complaining_on_behalf_relationship'=>$this->text(),
            'complaining_on_behalf_daytime_phone'=>$this->text(),
            'complaining_on_behalf_email'=>$this->text(),
            'complaining_on_behalf_fax'=>$this->text(),
            'complaining_on_behalf_ref'=>$this->text(),
            'complaining_on_behalf_of_a_business_official_name'=>$this->text(),
            'complaining_on_behalf_of_a_business_num_employees'=>$this->integer(),
            'complaining_on_behalf_of_a_business_num_partners'=>$this->integer(),
            'complaining_on_behalf_of_a_business_annual_income'=>$this->double(),
            'company_details_responsible_on_complaint_name'=>$this->text(),
            'company_details_responsible_on_complaint_address'=>$this->text(),
            'company_details_responsible_on_complaint_phone'=>$this->text(),
            'adviser_who_sold_product_name'=>$this->text(),
            'adviser_who_sold_product_address'=>$this->text(),
            'adviser_who_sold_product_phone_number'=>$this->text(),
            'kind_of_service_complained'=>$this->text(),
            'kind_of_service_complained_reference_number'=>$this->text(),
            'full_complain_details'=>$this->text(),
            'when_did_transaction_take_place'=>$this->text(),
            'first_complain_took_place'=>$this->text(),
            'did_company_sent_message'=>$this->text(),
            'any_court_action'=>$this->text(),
            'settlement_details'=>$this->text(),
            'has_accessibility_problem'=>$this->text(),
            'client_signature_image' => $this->text(),
            
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime()
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%ppi_lead}}');
    }

}
