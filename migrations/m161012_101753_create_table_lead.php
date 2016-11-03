<?php

use yii\db\Migration;

class m161012_101753_create_table_lead extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%lead_esign}}', [
            'id' => $this->primaryKey(),
            'hotkey' => $this->string(),
            'salutation' => $this->string(),
            'firstname' => $this->string(),
            'lastname' => $this->string(),
            'account_type' => $this->string(),//[joint,single]
            'account_provider' => $this->string(),
            'monthly_account_charge' => $this->float(),
            'account_start_date' => $this->dateTime(),
            'account_end_date' => $this->dateTime(),
            'is_ongoing' => $this->boolean(),//if yes , account end date is not required
            'tried_to_claim_for_package' => $this->string(),//
            'tried_to_claim_for_package_details' => $this->text(),//if tried to claim is yes
            'tried_to_claim_for_insurance_products' => $this->string(),//
            'tried_to_claim_for_insurance_products_is_rejected' => $this->string(),
            'tried_to_claim_for_insurance_products_rejection_reason' => $this->text(),
            'used_benefits_packaged_bank' => $this->string(),//[yes , no , don't know]
            'used_benefits_packaged_bank_details' => $this->text(),//show this if used_benefits_packaged_bank is yes
            'know_benefit' => $this->string(),//show this if used_benefits_packaged_bank is yes
            'registered_benefits_by_packaged_account'=> $this->string(),
            'registered_benefits_by_packaged_account_details'=> $this->text(),//show this if registered_benefits_by_packaged_account is yes
            'understanding_of_features_and_benefits'=> $this->text(),//show this if registered_benefits_by_packaged_account is yes
            'address_while_bank_opened'=> $this->text(),//[non uk address, uk address]
            'bank_account_status'=> $this->text(),//[account in Arrears , Account in Debt Management , Account in IVA , Bankrupt]
            'bank_account_status_comment'=> $this->text(),//[account in Arrears , Account in Debt Management , Account in IVA , Bankrupt]
            'has_account_upgraded_downgraded'=> $this->string(),//[yes,no]
            'upgrade_comment'=> $this->text(),//[yes,no]
            'how_packaged_bank_account_sold' => $this->string(),//
            'how_packaged_bank_account_sold_details' => $this->text(),//
            'reason_to_takeout_packaged_account' => $this->string(),//
            //if The Account was suggested by the bank/building society representative   , Account was suggested to me but I only discovered the actual charges & type of account at a later stage
            'reason_to_takeout_packaged_account_reason_of_speaking' => $this->text(),// add check box to include cant remember
            'noticed_account_fees'=>$this->string(),
            'noticed_account_fees_details'=>$this->text(),
            'actually_take_out_other_prodcuts'=> $this->string(),
            'actually_take_out_other_prodcuts_details'=> $this->text(),
            'did_they_give_advice' => $this->string(),

            'discuss_not_involed_packaged' => $this->string(),
            'discuss_not_involed_packaged_details' => $this->text(),

            'did_they_give_advice_clarify' => $this->string(),
            'did_they_give_advice_clarify_details' => $this->text(),

            'felt_under_pressure' => $this->string(),//[yes,no]
            'felt_under_pressure_details' => $this->text(),
            'had_free_bank' => $this->string(),
            'did_representative_explain_main_exclusions' => $this->string(),
            'did_representative_explain_receive_written_info' => $this->string(),
            'receive_any_mailing_post' => $this->string(),
            'explain_changes_effect_elligibility' => $this->string(),
            'explain_pay_excess_claim_on_insurance' => $this->string(),
            'has_uk_driving_license_during_upgrade' => $this->string(),

            'own_a_car' => $this->string(),

            'has_mobile_phone_during_upgrade' => $this->string(),
            'has_mobile_phone_during_upgrade_has_internet_connection' => $this->string(),

            'often_go_holiday_in_europe' => $this->string(),
            'often_go_holiday_outside_europe' => $this->string(),
            'often_go_holiday_and_winter_sports' => $this->string(),

            'has_health_problems_during_upgrade' => $this->string(),
            'has_health_problems_during_upgrade_details' => $this->text(),
            'did_rep_explain_eligibility' => $this->string(),

            'has_registered_doctor_during_upgrade' => $this->string(),

            'further_details_help_evidence' => $this->string(),

            'did_kept_insurance_after_sale' => $this->string(),
            'did_kept_insurance_after_sale_details' => $this->text(),
            'reason_kept_existing_cover' => $this->string(),

            'when_opened_account_has_other_account' => $this->string(),
            'when_opened_account_has_other_account_details' => $this->text(),

            'reason_why_unhappy' => $this->text(),
            
            /*Contact Information*/
            'landline'=>$this->string(),
            'mobile'=>$this->string(),
            'work_number'=>$this->string(),
            'email_address'=>$this->string(),
            'preferred_method_of_contact'=>$this->string(),
            'best_time_to_call'=>$this->string(),
            'client_contact_notes'=>$this->string(),
            'address1'=>$this->string(),
            'address2'=>$this->string(),
            'address3'=>$this->string(),
            'address4'=>$this->string(),
            'postcode'=>$this->string(),
            'date_of_birth'=>$this->date(),
            'previous_name'=>$this->string(),
            'previous_address1'=>$this->string(),
            'previous_address2'=>$this->string(),
            'previous_address3'=>$this->string(),
            'previous_address4'=>$this->string(),
            'previous_postcode'=>$this->string(),
            'other_previous_address'=>$this->string(),//[yes , no]
            'other_previous_address_details'=>$this->string(),//[yes , no]
            'account_number'=>$this->string(),
            'sort_code'=>$this->string(),
            /*appointment*/
            'appointment_date'=>$this->string(),
            'appointment_time'=>$this->string(),
            'notes'=>$this->text(),

            'client_signature_image' => $this->string(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime()
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%lead_esign}}');
    }
    
}
