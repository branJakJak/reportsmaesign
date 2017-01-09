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
            'hotkey' => $this->text(),
            'salutation' => $this->text(),
            'firstname' => $this->text(),
            'lastname' => $this->text(),
            'account_type' => $this->text(),//[joint,single]
            'account_provider' => $this->text(),
            'monthly_account_charge' => $this->double(),
            'account_start_date' => $this->dateTime(),
            'account_end_date' => $this->dateTime(),
            'is_ongoing' => $this->boolean(),//if yes , account end date is not required
            'tried_to_claim_for_package' => $this->text(),//
            'tried_to_claim_for_package_details' => $this->text(),//if tried to claim is yes
            'tried_to_claim_for_insurance_products' => $this->text(),//
            'tried_to_claim_for_insurance_products_is_rejected' => $this->text(),
            'tried_to_claim_for_insurance_products_rejection_reason' => $this->text(),
            'used_benefits_packaged_bank' => $this->text(),//[yes , no , don't know]
            'used_benefits_packaged_bank_details' => $this->text(),//show this if used_benefits_packaged_bank is yes
            'know_benefit' => $this->text(),//show this if used_benefits_packaged_bank is yes
            'registered_benefits_by_packaged_account'=> $this->text(),
            'registered_benefits_by_packaged_account_details'=> $this->text(),//show this if registered_benefits_by_packaged_account is yes
            'understanding_of_features_and_benefits'=> $this->text(),//show this if registered_benefits_by_packaged_account is yes
            'address_while_bank_opened'=> $this->text(),//[non uk address, uk address]
            'bank_account_status'=> $this->text(),//[account in Arrears , Account in Debt Management , Account in IVA , Bankrupt]
            'bank_account_status_comment'=> $this->text(),//[account in Arrears , Account in Debt Management , Account in IVA , Bankrupt]
            'has_account_upgraded_downgraded'=> $this->text(),//[yes,no]
            'upgrade_comment'=> $this->text(),//
            'how_packaged_bank_account_sold' => $this->text(),//
            'how_packaged_bank_account_sold_details' => $this->text(),//
            'reason_to_takeout_packaged_account' => $this->text(),//
            //if The Account was suggested by the bank/building society representative   , Account was suggested to me but I only discovered the actual charges & type of account at a later stage
            'reason_to_takeout_packaged_account_reason_of_speaking' => $this->text(),// add check box to include cant remember
            'noticed_account_fees'=>$this->text(),
            'noticed_account_fees_details'=>$this->text(),
            'actually_take_out_other_prodcuts'=> $this->text(),
            'actually_take_out_other_prodcuts_details'=> $this->text(),
            'did_they_give_advice' => $this->text(),

            'discuss_not_involed_packaged' => $this->text(),
            'discuss_not_involed_packaged_details' => $this->text(),

            'did_they_give_advice_clarify' => $this->text(),
            'did_they_give_advice_clarify_details' => $this->text(),

            'felt_under_pressure' => $this->text(),//[yes,no]
            'felt_under_pressure_details' => $this->text(),
            'had_free_bank' => $this->text(),
            'did_representative_explain_main_exclusions' => $this->text(),
            'did_representative_explain_receive_written_info' => $this->text(),
            'receive_any_mailing_post' => $this->text(),
            'explain_changes_effect_elligibility' => $this->text(),
            'explain_pay_excess_claim_on_insurance' => $this->text(),
            'has_uk_driving_license_during_upgrade' => $this->text(),

            'own_a_car' => $this->text(),

            'has_mobile_phone_during_upgrade' => $this->text(),
            'has_mobile_phone_during_upgrade_has_internet_connection' => $this->text(),

            'often_go_holiday_in_europe' => $this->text(),
            'often_go_holiday_outside_europe' => $this->text(),
            'often_go_holiday_and_winter_sports' => $this->text(),

            'has_health_problems_during_upgrade' => $this->text(),
            'has_health_problems_during_upgrade_details' => $this->text(),
            'did_rep_explain_eligibility' => $this->text(),

            'has_registered_doctor_during_upgrade' => $this->text(),

            'further_details_help_evidence' => $this->text(),

            'did_kept_insurance_after_sale' => $this->text(),
            'did_kept_insurance_after_sale_details' => $this->text(),
            'reason_kept_existing_cover' => $this->text(),

            'when_opened_account_has_other_account' => $this->text(),
            'when_opened_account_has_other_account_details' => $this->text(),

            'reason_why_unhappy' => $this->text(),

            /*Contact Information*/
            'landline'=>$this->text(),
            'mobile'=>$this->text(),
            'work_number'=>$this->text(),
            'email_address'=>$this->text(),
            'preferred_method_of_contact'=>$this->text(),
            'best_time_to_call'=>$this->text(),
            'client_contact_notes'=>$this->text(),
            'address1'=>$this->text(),
            'address2'=>$this->text(),
            'address3'=>$this->text(),
            'address4'=>$this->text(),
            'postcode'=>$this->text(),
            'date_of_birth'=>$this->date(),
            'previous_name'=>$this->text(),
            'previous_address1'=>$this->text(),
            'previous_address2'=>$this->text(),
            'previous_address3'=>$this->text(),
            'previous_address4'=>$this->text(),
            'previous_postcode'=>$this->text(),
            'other_previous_address'=>$this->text(),//[yes , no]
            'other_previous_address_details'=>$this->text(),//[yes , no]
            'account_number'=>$this->text(),
            'sort_code'=>$this->text(),
            /*appointment*/
            'appointment_date'=>$this->text(),
            'appointment_time'=>$this->text(),
            'notes'=>$this->text(),

            'client_signature_image' => $this->text(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime()
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%lead_esign}}');
    }

}
