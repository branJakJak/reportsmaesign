<?php
/* @var $scenario Codeception\Scenario */
$faker = Faker\Factory::create();

$apiBackendUrl = "http://esign.site8.co/api/v1/pba/non-affiliate";
$I = new ApiTester($scenario);
$I->wantTo('Test /api/v1/pba/non-affiliate function');
$I->amHttpAuthenticated('api', 'RlI1FOWCkuGLKEdNBi9j');
$fakeTitleMale = $faker->titleMale;
$fakeFirstname = $faker->firstName;
$fakeLastname = $faker->lastName;
$I->sendPOST( $apiBackendUrl, [
    "hotkey" => "",
    "salutation" => $fakeTitleMale, 
    "firstname" => $fakeFirstname,
    "lastname" => $fakeLastname,
    "account_type" => "",
    "account_provider" => "",
    "monthly_account_charge" => "",
    "account_start_date" => "",
    "account_end_date" => "",
    "is_ongoing" => 0,
    "tried_to_claim_for_package" => "",
    "tried_to_claim_for_package_details" => "",
    "tried_to_claim_for_insurance_products" => "",
    "tried_to_claim_for_insurance_products_is_rejected" => "",
    "tried_to_claim_for_insurance_products_rejection_reason" => "",
    "used_benefits_packaged_bank" => "",
    "used_benefits_packaged_bank_details" => "",
    "know_benefit" => "",
    "registered_benefits_by_packaged_account" => "",
    "registered_benefits_by_packaged_account_details" => "",
    "understanding_of_features_and_benefits" => "",
    "address_while_bank_opened" => "",
    "bank_account_status" => "",
    "bank_account_status_comment" => "",
    "has_account_upgraded_downgraded" => "",
    "upgrade_comment" => "",
    "how_packaged_bank_account_sold" => "",
    "how_packaged_bank_account_sold_details" => "",
    "reason_to_takeout_packaged_account" => "",
    "reason_to_takeout_packaged_account_reason_of_speaking" => "",
    "noticed_account_fees" => "",
    "noticed_account_fees_details" => "",
    "actually_take_out_other_prodcuts" => "",
    "actually_take_out_other_prodcuts_details" => "",
    "did_they_give_advice" => "",
    "discuss_not_involed_packaged" => "",
    "discuss_not_involed_packaged_details" => "",
    "did_they_give_advice_clarify" => "",
    "did_they_give_advice_clarify_details" => "",
    "felt_under_pressure" => "",
    "felt_under_pressure_details" => "",
    "had_free_bank" => "",
    "did_representative_explain_main_exclusions" => "",
    "did_representative_explain_receive_written_info" => "",
    "receive_any_mailing_post" => "",
    "explain_changes_effect_elligibility" => "",
    "explain_pay_excess_claim_on_insurance" => "",
    "has_uk_driving_license_during_upgrade" => "",
    "own_a_car" => "",
    "has_mobile_phone_during_upgrade" => "",
    "has_mobile_phone_during_upgrade_has_internet_connection" => "",
    "often_go_holiday_in_europe" => "",
    "often_go_holiday_outside_europe" => "",
    "often_go_holiday_and_winter_sports" => "",
    "has_health_problems_during_upgrade" => "",
    "has_health_problems_during_upgrade_details" => "",
    "did_rep_explain_eligibility" => "",
    "has_registered_doctor_during_upgrade" => "",
    "further_details_help_evidence" => "",
    "did_kept_insurance_after_sale" => "",
    "did_kept_insurance_after_sale_details" => "",
    "reason_kept_existing_cover" => "",
    "when_opened_account_has_other_account" => "",
    "when_opened_account_has_other_account_details" => "",
    "reason_why_unhappy" => "",
    "landline" => "",
    "mobile" => "",
    "work_number" => "",
    "email_address" => $faker->email,
    "preferred_method_of_contact" => "",
    "best_time_to_call" => "",
    "client_contact_notes" => "",
    "address1" => "",
    "address2" => "",
    "address3" => "",
    "address4" => "",
    "postcode" => "",
    "date_of_birth" => date("Y-m-d H:i:s"),
    "previous_name" => "",
    "previous_address1" => "",
    "previous_address2" => "",
    "previous_address3" => "",
    "previous_address4" => "",
    "previous_postcode" => "",
    "other_previous_address" => "",
    "other_previous_address_details" => "",
    "account_number" => "",
    "sort_code" => "",
    "appointment_date" => "",
    "appointment_time" => "",
    "notes" => "",
    "client_signature_image" => "",
    "pdf_template" => " original",
    "complaint_reference" => "",
    "financial_business_name" => "",
    "last_3_digit_account_num" => "",
    "is_complain_about_sale_packaged_bank_account" => "",
    "is_complain_about_sale_packaged_bank_account_details" => "",
    "open_or_upgrade_package_bank_account_date" => "",
    "notice_account_fees_on_statements" => "",
    "notice_account_fees_on_statements_details" => "",
    "current_situation_packaged_bank_account" => "",
    "current_situation_packaged_bank_account_explanation" => "",
    "is_address_outside_UK_at_package_upgrade" => "",
    "has_registered_doctor_during_upgrade_details" => "",
    "after_upgrade_already_has_products_details" => "",
    "complaint_whole_details" => "",
    "declaration_confirmed_tick" => "",
    "occupation" => "",
    "salutation_complain_with" => "",
    "firstname_complain_with" => "",
    "lastname_complain_with" => "",
    "occupation_complain_with" => "",
    "date_of_birth_complain_with" => "",
    "postcode_complain_with" => "",
    "address1_complain_with" => "",
    "address2_complain_with" => "",
    "address3_complain_with" => "",
    "address4_complain_with" => "",
    "mobile_complain_with" => "",
    "behalf_of_charity_official_name" => "",
    "behalf_of_charity_num_of_employees" => "",
    "behalf_of_charity_num_of_partners" => "",
    "behalf_of_charity_annual_income" => "",
    "business_responsible_details_name" => "",
    "business_responsible_details_address" => "",
    "business_responsible_details_phone" => "",
    "adviser_detail_name" => "",
    "adviser_detail_address" => "",
    "adviser_detail_phone" => "",
    "kind_of_service_complain" => "",
    "kind_of_service_complain_reference" => "",
    "when_trasaction_happen" => "",
    "when_first_complain_business" => "",
    "has_business_complaining_sent_letter" => "",
    "has_court_action_to_complain" => "",
    "settlement_with_business_details" => "",
    "is_ineed_of_practical_help" => "",
    "is_ineed_of_practical_help_details" => "",
    "final_tick_checklist" => "",
    "security_key" => "",
    "pdt_template"=>'original',
    "after_upgrade_already_has_products" => "",
    "created_at" => "",
    "updated_at" => ""
]);
$I->seeResponseCodeIs(201);
$returnedMessage = \GuzzleHttp\json_decode($I->grabResponse(), true);
$I->canSeeResponseContains($fakeTitleMale);
$I->canSeeResponseContains($fakeFirstname);
$I->canSeeResponseContains($fakeLastname);

$I->wantTo("Test api using invalid data");
$fakeTitleMale = $faker->titleMale;
$fakeFirstname = $faker->firstName;
$I->sendPOST($apiBackendUrl, [
    "hotkey" => "",
    "salutation" => $fakeTitleMale,
    "firstname" => $fakeFirstname,
    "lastname" => "",//this should cause the error
    "account_type" => "",
    "account_provider" => "",
    "monthly_account_charge" => "",
    "account_start_date" => "",
    "account_end_date" => "",
    "is_ongoing" => 0,
    "tried_to_claim_for_package" => "",
    "tried_to_claim_for_package_details" => "",
    "tried_to_claim_for_insurance_products" => "",
    "tried_to_claim_for_insurance_products_is_rejected" => "",
    "tried_to_claim_for_insurance_products_rejection_reason" => "",
    "used_benefits_packaged_bank" => "",
    "used_benefits_packaged_bank_details" => "",
    "know_benefit" => "",
    "registered_benefits_by_packaged_account" => "",
    "registered_benefits_by_packaged_account_details" => "",
    "understanding_of_features_and_benefits" => "",
    "address_while_bank_opened" => "",
    "bank_account_status" => "",
    "bank_account_status_comment" => "",
    "has_account_upgraded_downgraded" => "",
    "upgrade_comment" => "",
    "how_packaged_bank_account_sold" => "",
    "how_packaged_bank_account_sold_details" => "",
    "reason_to_takeout_packaged_account" => "",
    "reason_to_takeout_packaged_account_reason_of_speaking" => "",
    "noticed_account_fees" => "",
    "noticed_account_fees_details" => "",
    "actually_take_out_other_prodcuts" => "",
    "actually_take_out_other_prodcuts_details" => "",
    "did_they_give_advice" => "",
    "discuss_not_involed_packaged" => "",
    "discuss_not_involed_packaged_details" => "",
    "did_they_give_advice_clarify" => "",
    "did_they_give_advice_clarify_details" => "",
    "felt_under_pressure" => "",
    "felt_under_pressure_details" => "",
    "had_free_bank" => "",
    "did_representative_explain_main_exclusions" => "",
    "did_representative_explain_receive_written_info" => "",
    "receive_any_mailing_post" => "",
    "explain_changes_effect_elligibility" => "",
    "explain_pay_excess_claim_on_insurance" => "",
    "has_uk_driving_license_during_upgrade" => "",
    "own_a_car" => "",
    "has_mobile_phone_during_upgrade" => "",
    "has_mobile_phone_during_upgrade_has_internet_connection" => "",
    "often_go_holiday_in_europe" => "",
    "often_go_holiday_outside_europe" => "",
    "often_go_holiday_and_winter_sports" => "",
    "has_health_problems_during_upgrade" => "",
    "has_health_problems_during_upgrade_details" => "",
    "did_rep_explain_eligibility" => "",
    "has_registered_doctor_during_upgrade" => "",
    "further_details_help_evidence" => "",
    "did_kept_insurance_after_sale" => "",
    "did_kept_insurance_after_sale_details" => "",
    "reason_kept_existing_cover" => "",
    "when_opened_account_has_other_account" => "",
    "when_opened_account_has_other_account_details" => "",
    "reason_why_unhappy" => "",
    "landline" => "",
    "mobile" => "",
    "work_number" => "",
    "email_address" => $faker->email,
    "preferred_method_of_contact" => "",
    "best_time_to_call" => "",
    "client_contact_notes" => "",
    "address1" => "",
    "address2" => "",
    "address3" => "",
    "address4" => "",
    "postcode" => "",
    "date_of_birth" => date("Y-m-d H:i:s"),
    "previous_name" => "",
    "previous_address1" => "",
    "previous_address2" => "",
    "previous_address3" => "",
    "previous_address4" => "",
    "previous_postcode" => "",
    "other_previous_address" => "",
    "other_previous_address_details" => "",
    "account_number" => "",
    "sort_code" => "",
    "appointment_date" => "",
    "appointment_time" => "",
    "notes" => "",
    "client_signature_image" => "",
    "pdf_template" => " original",
    "complaint_reference" => "",
    "financial_business_name" => "",
    "last_3_digit_account_num" => "",
    "is_complain_about_sale_packaged_bank_account" => "",
    "is_complain_about_sale_packaged_bank_account_details" => "",
    "open_or_upgrade_package_bank_account_date" => "",
    "notice_account_fees_on_statements" => "",
    "notice_account_fees_on_statements_details" => "",
    "current_situation_packaged_bank_account" => "",
    "current_situation_packaged_bank_account_explanation" => "",
    "is_address_outside_UK_at_package_upgrade" => "",
    "has_registered_doctor_during_upgrade_details" => "",
    "after_upgrade_already_has_products_details" => "",
    "complaint_whole_details" => "",
    "declaration_confirmed_tick" => "",
    "occupation" => "",
    "salutation_complain_with" => "",
    "firstname_complain_with" => "",
    "lastname_complain_with" => "",
    "occupation_complain_with" => "",
    "date_of_birth_complain_with" => "",
    "postcode_complain_with" => "",
    "address1_complain_with" => "",
    "address2_complain_with" => "",
    "address3_complain_with" => "",
    "address4_complain_with" => "",
    "mobile_complain_with" => "",
    "behalf_of_charity_official_name" => "",
    "behalf_of_charity_num_of_employees" => "",
    "behalf_of_charity_num_of_partners" => "",
    "behalf_of_charity_annual_income" => "",
    "business_responsible_details_name" => "",
    "business_responsible_details_address" => "",
    "business_responsible_details_phone" => "",
    "adviser_detail_name" => "",
    "adviser_detail_address" => "",
    "adviser_detail_phone" => "",
    "kind_of_service_complain" => "",
    "kind_of_service_complain_reference" => "",
    "when_trasaction_happen" => "",
    "when_first_complain_business" => "",
    "has_business_complaining_sent_letter" => "",
    "has_court_action_to_complain" => "",
    "settlement_with_business_details" => "",
    "is_ineed_of_practical_help" => "",
    "is_ineed_of_practical_help_details" => "",
    "final_tick_checklist" => "",
    "security_key" => "",
    "pdt_template"=>'original',
    "after_upgrade_already_has_products" => "",
    "created_at" => "",
    "updated_at" => ""
]);
$I->canSeeResponseCodeIs(400);
$I->canSeeResponseContains('Lastname cannot be blank');
//codecept_debug($I->grabResponse());

$I->wantTo("Test that without the correct login credentials , this request will not pass through");
$I->amHttpAuthenticated('api', 'asdasd');
$I->sendPOST($apiBackendUrl, [
    "hotkey" => "",
    "salutation" => $fakeTitleMale,
    "firstname" => $fakeFirstname,
    "lastname" => $fakeLastname,
    "account_type" => "",
    "account_provider" => "",
    "monthly_account_charge" => "",
    "account_start_date" => "",
    "account_end_date" => "",
    "is_ongoing" => 0,
    "tried_to_claim_for_package" => "",
    "tried_to_claim_for_package_details" => "",
    "tried_to_claim_for_insurance_products" => "",
    "tried_to_claim_for_insurance_products_is_rejected" => "",
    "tried_to_claim_for_insurance_products_rejection_reason" => "",
    "used_benefits_packaged_bank" => "",
    "used_benefits_packaged_bank_details" => "",
    "know_benefit" => "",
    "registered_benefits_by_packaged_account" => "",
    "registered_benefits_by_packaged_account_details" => "",
    "understanding_of_features_and_benefits" => "",
    "address_while_bank_opened" => "",
    "bank_account_status" => "",
    "bank_account_status_comment" => "",
    "has_account_upgraded_downgraded" => "",
    "upgrade_comment" => "",
    "how_packaged_bank_account_sold" => "",
    "how_packaged_bank_account_sold_details" => "",
    "reason_to_takeout_packaged_account" => "",
    "reason_to_takeout_packaged_account_reason_of_speaking" => "",
    "noticed_account_fees" => "",
    "noticed_account_fees_details" => "",
    "actually_take_out_other_prodcuts" => "",
    "actually_take_out_other_prodcuts_details" => "",
    "did_they_give_advice" => "",
    "discuss_not_involed_packaged" => "",
    "discuss_not_involed_packaged_details" => "",
    "did_they_give_advice_clarify" => "",
    "did_they_give_advice_clarify_details" => "",
    "felt_under_pressure" => "",
    "felt_under_pressure_details" => "",
    "had_free_bank" => "",
    "did_representative_explain_main_exclusions" => "",
    "did_representative_explain_receive_written_info" => "",
    "receive_any_mailing_post" => "",
    "explain_changes_effect_elligibility" => "",
    "explain_pay_excess_claim_on_insurance" => "",
    "has_uk_driving_license_during_upgrade" => "",
    "own_a_car" => "",
    "has_mobile_phone_during_upgrade" => "",
    "has_mobile_phone_during_upgrade_has_internet_connection" => "",
    "often_go_holiday_in_europe" => "",
    "often_go_holiday_outside_europe" => "",
    "often_go_holiday_and_winter_sports" => "",
    "has_health_problems_during_upgrade" => "",
    "has_health_problems_during_upgrade_details" => "",
    "did_rep_explain_eligibility" => "",
    "has_registered_doctor_during_upgrade" => "",
    "further_details_help_evidence" => "",
    "did_kept_insurance_after_sale" => "",
    "did_kept_insurance_after_sale_details" => "",
    "reason_kept_existing_cover" => "",
    "when_opened_account_has_other_account" => "",
    "when_opened_account_has_other_account_details" => "",
    "reason_why_unhappy" => "",
    "landline" => "",
    "mobile" => "",
    "work_number" => "",
    "email_address" => $faker->email,
    "preferred_method_of_contact" => "",
    "best_time_to_call" => "",
    "client_contact_notes" => "",
    "address1" => "",
    "address2" => "",
    "address3" => "",
    "address4" => "",
    "postcode" => "",
    "date_of_birth" => date("Y-m-d H:i:s"),
    "previous_name" => "",
    "previous_address1" => "",
    "previous_address2" => "",
    "previous_address3" => "",
    "previous_address4" => "",
    "previous_postcode" => "",
    "other_previous_address" => "",
    "other_previous_address_details" => "",
    "account_number" => "",
    "sort_code" => "",
    "appointment_date" => "",
    "appointment_time" => "",
    "notes" => "",
    "client_signature_image" => "",
    "pdf_template" => " original",
    "complaint_reference" => "",
    "financial_business_name" => "",
    "last_3_digit_account_num" => "",
    "is_complain_about_sale_packaged_bank_account" => "",
    "is_complain_about_sale_packaged_bank_account_details" => "",
    "open_or_upgrade_package_bank_account_date" => "",
    "notice_account_fees_on_statements" => "",
    "notice_account_fees_on_statements_details" => "",
    "current_situation_packaged_bank_account" => "",
    "current_situation_packaged_bank_account_explanation" => "",
    "is_address_outside_UK_at_package_upgrade" => "",
    "has_registered_doctor_during_upgrade_details" => "",
    "after_upgrade_already_has_products_details" => "",
    "complaint_whole_details" => "",
    "declaration_confirmed_tick" => "",
    "occupation" => "",
    "salutation_complain_with" => "",
    "firstname_complain_with" => "",
    "lastname_complain_with" => "",
    "occupation_complain_with" => "",
    "date_of_birth_complain_with" => "",
    "postcode_complain_with" => "",
    "address1_complain_with" => "",
    "address2_complain_with" => "",
    "address3_complain_with" => "",
    "address4_complain_with" => "",
    "mobile_complain_with" => "",
    "behalf_of_charity_official_name" => "",
    "behalf_of_charity_num_of_employees" => "",
    "behalf_of_charity_num_of_partners" => "",
    "behalf_of_charity_annual_income" => "",
    "business_responsible_details_name" => "",
    "business_responsible_details_address" => "",
    "business_responsible_details_phone" => "",
    "adviser_detail_name" => "",
    "adviser_detail_address" => "",
    "adviser_detail_phone" => "",
    "kind_of_service_complain" => "",
    "kind_of_service_complain_reference" => "",
    "when_trasaction_happen" => "",
    "when_first_complain_business" => "",
    "has_business_complaining_sent_letter" => "",
    "has_court_action_to_complain" => "",
    "settlement_with_business_details" => "",
    "is_ineed_of_practical_help" => "",
    "is_ineed_of_practical_help_details" => "",
    "final_tick_checklist" => "",
    "security_key" => "",
    "pdt_template"=>'original',
    "after_upgrade_already_has_products" => "",
    "created_at" => "",
    "updated_at" => ""
]);
$I->canSeeResponseCodeIs(401);


$I->wantTo("Test if http method other than POST will return invalid message");
$I->amHttpAuthenticated('api', 'RlI1FOWCkuGLKEdNBi9j');
$I->sendGET("http://localhost:8080/api/v1/pba/non-affiliate");
$I->sendHEAD("http://localhost:8080/api/v1/pba/non-affiliate");
$I->sendOPTIONS("http://localhost:8080/api/v1/pba/non-affiliate");
$I->sendPUT("http://localhost:8080/api/v1/pba/non-affiliate");
$I->sendPATCH("http://localhost:8080/api/v1/pba/non-affiliate");
