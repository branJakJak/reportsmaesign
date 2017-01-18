<?php
/* @var $scenario Codeception\Scenario */
$faker = Faker\Factory::create();
$apiBackendUrl = "http://esign.site8.co/api/v1/ppi/non-affiliate";
$I = new ApiTester($scenario);
$I->wantTo('Test /api/v1/ppi/non-affiliate function');
$I->amHttpAuthenticated('api', 'RlI1FOWCkuGLKEdNBi9j');
$fakeTitleMale = $faker->titleMale;
$fakeFirstname = $faker->firstName;
$fakeLastname = $faker->lastName;
$I->sendPOST( $apiBackendUrl, [
    "salutation" => $fakeTitleMale,
    "firstname" => $fakeFirstname,
    "lastname" => $fakeLastname,
    "account_start_date" => "",
    "account_end_date" => "",
    "finance_provider" => "",
    "did_broker_arrange" => "",
    "broker_name" => "",
    "ppi_claim_type" => "",
    "amount_ppi" => "",
    "daytime_phone" => "",
    "home_phone" => "",
    "mobile" => "",
    "email_address" => $faker->email,
    "financial_business_name" => "",
    "ppi_policy_number" => "",
    "when_did_you_takeout_ppi" => "",
    "can_remember_date_of_ppi_takeout" => "",
    "ppi_cover_type" => "",
    "how_was_ppi_sold" => "",
    "did_financial_business_give_advice" => "",
    "ppi_payment_method" => "",
    "ppi_insurance_current_situation" => "",
    "ppi_insurance_cancelled_situation_date" => "",
    "had_a_claim_ppi_insurance" => "",
    "had_a_claim_ppi_insurance_details" => "",
    "bought_cover_with_ppi_insurance" => "",
    "account_number" => "",
    "reason_of_borrowing" => "",
    "borrowed_money_to_payoff_debt_details" => "",
    "ever_missed_payments" => "",
    "ever_missed_payments_explanation" => "",
    "employment_status_during_ppi_payment_you" => "",
    "employment_status_during_ppi_payment_partner" => "",
    "employment_status_change_details" => "",
    "type_of_work_ppi_you" => "",
    "type_of_work_ppi_partner" => "",
    "name_of_employer_you" => "",
    "name_of_employer_partner" => "",
    "how_long_been_working_years_you" => "",
    "how_long_been_working_months_you" => "",
    "how_long_been_working_years_partner" => "",
    "how_long_been_working_months_partner" => "",
    "would_you_still_receive_payment" => "",
    "would_you_still_receive_payment_details" => "",
    "would_partner_still_receive_payment" => "",
    "would_partner_still_receive_payment_details" => "",
    "other_way_of_making_money_for_repayments_you" => "",
    "other_way_of_making_money_for_repayments_you_details" => "",
    "other_way_of_making_money_for_repayments_partner" => "",
    "has_health_problems_you" => "",
    "has_health_problems_you_details" => "",
    "has_health_problems_partner" => "",
    "what_happen_tookout_payment_protection" => "",
    "reason_of_unhappiness_with_insurance" => "",
    "complaining_on_behalf_name" => "",
    "complaining_on_behalf_relationship" => "",
    "complaining_on_behalf_daytime_phone" => "",
    "complaining_on_behalf_email" => "",
    "complaining_on_behalf_fax" => "",
    "complaining_on_behalf_ref" => "",
    "complaining_on_behalf_of_a_business_official_name" => "",
    "complaining_on_behalf_of_a_business_num_employees" => "",
    "complaining_on_behalf_of_a_business_num_partners" => "",
    "complaining_on_behalf_of_a_business_annual_income" => "",
    "company_details_responsible_on_complaint_name" => "",
    "company_details_responsible_on_complaint_address" => "",
    "company_details_responsible_on_complaint_phone" => "",
    "adviser_who_sold_product_name" => "",
    "adviser_who_sold_product_address" => "",
    "adviser_who_sold_product_phone_number" => "",
    "kind_of_service_complained" => "",
    "kind_of_service_complained_reference_number" => "",
    "full_complain_details" => "",
    "when_did_transaction_take_place" => "",
    "first_complain_took_place" => "",
    "did_company_sent_message" => "",
    "any_court_action" => "",
    "settlement_details" => "",
    "has_accessibility_problem" => "",
    "client_signature_image" => "",
    "pdf_template" => "",
    "security_key" => "",
    "created_at" => "",
    "updated_at" => "",

]);
$I->seeResponseCodeIs(201);
codecept_debug($I->grabResponse());

$I->canSeeResponseContains($fakeTitleMale);
$I->canSeeResponseContains($fakeFirstname);
$I->canSeeResponseContains($fakeLastname);

$I->wantTo("Test api using invalid data");
$fakeTitleMale = $faker->titleMale;
$fakeFirstname = $faker->firstName;
$I->sendPOST($apiBackendUrl, [
    "salutation" => $fakeTitleMale,
    "firstname" => $fakeFirstname,
    "lastname" => "",
    "account_start_date" => "",
    "account_end_date" => "",
    "finance_provider" => "",
    "did_broker_arrange" => "",
    "broker_name" => "",
    "ppi_claim_type" => "",
    "amount_ppi" => "",
    "daytime_phone" => "",
    "home_phone" => "",
    "mobile" => "",
    "email_address" => $faker->email,
    "date_of_birth"=>date("Y-m-d"),
    "account_provider"=>"Acme Company",
    "monthly_account_charge"=>12.12,
    "financial_business_name" => "",
    "ppi_policy_number" => "",
    "when_did_you_takeout_ppi" => "",
    "can_remember_date_of_ppi_takeout" => "",
    "ppi_cover_type" => "",
    "how_was_ppi_sold" => "",
    "did_financial_business_give_advice" => "",
    "ppi_payment_method" => "",
    "ppi_insurance_current_situation" => "",
    "ppi_insurance_cancelled_situation_date" => "",
    "had_a_claim_ppi_insurance" => "",
    "had_a_claim_ppi_insurance_details" => "",
    "bought_cover_with_ppi_insurance" => "",
    "account_number" => "",
    "reason_of_borrowing" => "",
    "borrowed_money_to_payoff_debt_details" => "",
    "ever_missed_payments" => "",
    "ever_missed_payments_explanation" => "",
    "employment_status_during_ppi_payment_you" => "",
    "employment_status_during_ppi_payment_partner" => "",
    "employment_status_change_details" => "",
    "type_of_work_ppi_you" => "",
    "type_of_work_ppi_partner" => "",
    "name_of_employer_you" => "",
    "name_of_employer_partner" => "",
    "how_long_been_working_years_you" => "",
    "how_long_been_working_months_you" => "",
    "how_long_been_working_years_partner" => "",
    "how_long_been_working_months_partner" => "",
    "would_you_still_receive_payment" => "",
    "would_you_still_receive_payment_details" => "",
    "would_partner_still_receive_payment" => "",
    "would_partner_still_receive_payment_details" => "",
    "other_way_of_making_money_for_repayments_you" => "",
    "other_way_of_making_money_for_repayments_you_details" => "",
    "other_way_of_making_money_for_repayments_partner" => "",
    "has_health_problems_you" => "",
    "has_health_problems_you_details" => "",
    "has_health_problems_partner" => "",
    "what_happen_tookout_payment_protection" => "",
    "reason_of_unhappiness_with_insurance" => "",
    "complaining_on_behalf_name" => "",
    "complaining_on_behalf_relationship" => "",
    "complaining_on_behalf_daytime_phone" => "",
    "complaining_on_behalf_email" => "",
    "complaining_on_behalf_fax" => "",
    "complaining_on_behalf_ref" => "",
    "complaining_on_behalf_of_a_business_official_name" => "",
    "complaining_on_behalf_of_a_business_num_employees" => "",
    "complaining_on_behalf_of_a_business_num_partners" => "",
    "complaining_on_behalf_of_a_business_annual_income" => "",
    "company_details_responsible_on_complaint_name" => "",
    "company_details_responsible_on_complaint_address" => "",
    "company_details_responsible_on_complaint_phone" => "",
    "adviser_who_sold_product_name" => "",
    "adviser_who_sold_product_address" => "",
    "adviser_who_sold_product_phone_number" => "",
    "kind_of_service_complained" => "",
    "kind_of_service_complained_reference_number" => "",
    "full_complain_details" => "",
    "when_did_transaction_take_place" => "",
    "first_complain_took_place" => "",
    "did_company_sent_message" => "",
    "any_court_action" => "",
    "settlement_details" => "",
    "has_accessibility_problem" => "",
    "client_signature_image" => "",
    "pdf_template" => "",
    "security_key" => "",
    "created_at" => "",
    "updated_at" => ""
]);
$I->canSeeResponseCodeIs(400);
$I->canSeeResponseContains('Lastname cannot be blank');


$I->wantTo("Test that without the correct login credentials , this request will not pass through");
$I->amHttpAuthenticated('api', 'asdasd');
$I->sendPOST($apiBackendUrl, [

]);
$I->canSeeResponseCodeIs(401);


$I->wantTo("Test if http method other than POST will return invalid message");
$I->amHttpAuthenticated('api', 'RlI1FOWCkuGLKEdNBi9j');
$I->sendGET($apiBackendUrl);
$I->sendHEAD($apiBackendUrl);
$I->sendOPTIONS($apiBackendUrl);
$I->sendPUT($apiBackendUrl);
$I->sendPATCH($apiBackendUrl);
