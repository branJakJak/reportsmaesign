<?php

use yii\db\Migration;

class m161205_143309_add_new_cols_lead_esign extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%lead_esign}}', 'complaint_reference', $this->text());
        $this->addColumn('{{%lead_esign}}', 'financial_business_name', $this->text());
        $this->addColumn('{{%lead_esign}}', 'last_3_digit_account_num', $this->text());
        $this->addColumn('{{%lead_esign}}', 'is_complain_about_sale_packaged_bank_account', $this->text());
        $this->addColumn('{{%lead_esign}}', 'is_complain_about_sale_packaged_bank_account_details', $this->text());
        $this->addColumn('{{%lead_esign}}', 'open_or_upgrade_package_bank_account_date', $this->date());
        $this->addColumn('{{%lead_esign}}', 'notice_account_fees_on_statements', $this->text());
        $this->addColumn('{{%lead_esign}}', 'notice_account_fees_on_statements_details', $this->text());
        $this->addColumn('{{%lead_esign}}', 'current_situation_packaged_bank_account', $this->text());
        $this->addColumn('{{%lead_esign}}', 'current_situation_packaged_bank_account_explanation', $this->text());
        $this->addColumn('{{%lead_esign}}', 'is_address_outside_UK_at_package_upgrade', $this->text());
        $this->addColumn('{{%lead_esign}}', 'has_registered_doctor_during_upgrade_details', $this->text());
        $this->addColumn('{{%lead_esign}}', 'after_upgrade_already_has_products_details', $this->text());
        $this->addColumn('{{%lead_esign}}', 'complaint_whole_details', $this->text());
        $this->addColumn('{{%lead_esign}}', 'declaration_confirmed_tick', $this->text());
        $this->addColumn('{{%lead_esign}}', 'occupation', $this->text());
        /*complain with*/
        $this->addColumn('{{%lead_esign}}', 'salutation_complain_with', $this->text());
        $this->addColumn('{{%lead_esign}}', 'firstname_complain_with', $this->text());
        $this->addColumn('{{%lead_esign}}', 'lastname_complain_with', $this->text());
        $this->addColumn('{{%lead_esign}}', 'occupation_complain_with', $this->text());
        $this->addColumn('{{%lead_esign}}', 'date_of_birth_complain_with', $this->text());
        $this->addColumn('{{%lead_esign}}', 'postcode_complain_with', $this->text());
        $this->addColumn('{{%lead_esign}}', 'address1_complain_with', $this->text());
        $this->addColumn('{{%lead_esign}}', 'address2_complain_with', $this->text());
        $this->addColumn('{{%lead_esign}}', 'address3_complain_with', $this->text());
        $this->addColumn('{{%lead_esign}}', 'address4_complain_with', $this->text());
        $this->addColumn('{{%lead_esign}}', 'mobile_complain_with', $this->text());

        $this->addColumn('{{%lead_esign}}', 'behalf_of_charity_official_name', $this->text());
        $this->addColumn('{{%lead_esign}}', 'behalf_of_charity_num_of_employees', $this->text());
        $this->addColumn('{{%lead_esign}}', 'behalf_of_charity_num_of_partners', $this->text());
        $this->addColumn('{{%lead_esign}}', 'behalf_of_charity_annual_income', $this->text());

        $this->addColumn('{{%lead_esign}}', 'business_responsible_details_name', $this->text());
        $this->addColumn('{{%lead_esign}}', 'business_responsible_details_address', $this->text());
        $this->addColumn('{{%lead_esign}}', 'business_responsible_details_phone', $this->text());

        $this->addColumn('{{%lead_esign}}', 'adviser_detail_name', $this->text());
        $this->addColumn('{{%lead_esign}}', 'adviser_detail_address', $this->text());
        $this->addColumn('{{%lead_esign}}', 'adviser_detail_phone', $this->text());

        $this->addColumn('{{%lead_esign}}', 'kind_of_service_complain', $this->text());
        $this->addColumn('{{%lead_esign}}', 'kind_of_service_complain_reference', $this->text());

        $this->addColumn('{{%lead_esign}}', 'when_trasaction_happen', $this->date());
        $this->addColumn('{{%lead_esign}}', 'when_first_complain_business', $this->date());

        $this->addColumn('{{%lead_esign}}', 'has_business_complaining_sent_letter', $this->text());
        $this->addColumn('{{%lead_esign}}', 'has_court_action_to_complain', $this->text());
        $this->addColumn('{{%lead_esign}}', 'settlement_with_business_details', $this->text());
        $this->addColumn('{{%lead_esign}}', 'is_ineed_of_practical_help', $this->text());
        $this->addColumn('{{%lead_esign}}', 'is_ineed_of_practical_help_details', $this->text());
        $this->addColumn('{{%lead_esign}}', 'final_tick_checklist', $this->text());

        // $this->addColumn('{{%lead_esign}}', 'when_opened_account_has_other_account', $this->text());



    }

    public function safeDown()
    {
        $this->dropColumn('{{%lead_esign}}', 'complaint_reference');
        $this->dropColumn('{{%lead_esign}}', 'financial_business_name');
        $this->dropColumn('{{%lead_esign}}', 'last_3_digit_account_num');
        $this->dropColumn('{{%lead_esign}}', 'is_complain_about_sale_packaged_bank_account');
        $this->dropColumn('{{%lead_esign}}', 'is_complain_about_sale_packaged_bank_account_details');
        $this->dropColumn('{{%lead_esign}}', 'open_or_upgrade_package_bank_account_date');
        $this->dropColumn('{{%lead_esign}}', 'notice_account_fees_on_statements');
        $this->dropColumn('{{%lead_esign}}', 'notice_account_fees_on_statements_details');
        $this->dropColumn('{{%lead_esign}}', 'current_situation_packaged_bank_account');
        $this->dropColumn('{{%lead_esign}}', 'current_situation_packaged_bank_account_explanation');
        $this->dropColumn('{{%lead_esign}}', 'is_address_outside_UK_at_package_upgrade');
        $this->dropColumn('{{%lead_esign}}', 'has_registered_doctor_during_upgrade_details');
        $this->dropColumn('{{%lead_esign}}', 'after_upgrade_already_has_products_details');
        $this->dropColumn('{{%lead_esign}}', 'complaint_whole_details');
        $this->dropColumn('{{%lead_esign}}', 'declaration_confirmed_tick');
        $this->dropColumn('{{%lead_esign}}', 'occupation');
        /*complain with*/
        $this->dropColumn('{{%lead_esign}}','salutation_complain_with');
        $this->dropColumn('{{%lead_esign}}','firstname_complain_with');
        $this->dropColumn('{{%lead_esign}}','lastname_complain_with');
        $this->dropColumn('{{%lead_esign}}','occupation_complain_with');
        $this->dropColumn('{{%lead_esign}}','date_of_birth_complain_with');
        $this->dropColumn('{{%lead_esign}}','postcode_complain_with');
        $this->dropColumn('{{%lead_esign}}','address1_complain_with');
        $this->dropColumn('{{%lead_esign}}','address2_complain_with');
        $this->dropColumn('{{%lead_esign}}','address3_complain_with');
        $this->dropColumn('{{%lead_esign}}','address4_complain_with');
        $this->dropColumn('{{%lead_esign}}','mobile_complain_with');

        $this->dropColumn('{{%lead_esign}}', 'behalf_of_charity_official_name');
        $this->dropColumn('{{%lead_esign}}', 'behalf_of_charity_num_of_employees');
        $this->dropColumn('{{%lead_esign}}', 'behalf_of_charity_num_of_partners');
        $this->dropColumn('{{%lead_esign}}', 'behalf_of_charity_annual_income');

        $this->dropColumn('{{%lead_esign}}', 'business_responsible_details_name');
        $this->dropColumn('{{%lead_esign}}', 'business_responsible_details_address');
        $this->dropColumn('{{%lead_esign}}', 'business_responsible_details_phone');

        $this->dropColumn('{{%lead_esign}}', 'adviser_detail_name');
        $this->dropColumn('{{%lead_esign}}', 'adviser_detail_address');
        $this->dropColumn('{{%lead_esign}}', 'adviser_detail_phone');

        $this->dropColumn('{{%lead_esign}}', 'kind_of_service_complain');
        $this->dropColumn('{{%lead_esign}}', 'kind_of_service_complain_reference');

        $this->dropColumn('{{%lead_esign}}', 'when_trasaction_happen');
        $this->dropColumn('{{%lead_esign}}', 'when_first_complain_business');

        $this->dropColumn('{{%lead_esign}}','has_business_complaining_sent_letter');
        $this->dropColumn('{{%lead_esign}}','has_court_action_to_complain');
        $this->dropColumn('{{%lead_esign}}','settlement_with_business_details');
        $this->dropColumn('{{%lead_esign}}','is_ineed_of_practical_help');
        $this->dropColumn('{{%lead_esign}}','is_ineed_of_practical_help_details');
        $this->dropColumn('{{%lead_esign}}','final_tick_checklist');

    }
}
