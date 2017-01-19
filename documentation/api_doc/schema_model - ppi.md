**Create lead record**
----
Create lead record

* **URL**
  http://esign.site8.co/api/v1/ppi/affiliate
* **Authentication**
  `Basic Access Authentication`
  * **Credentials**
        * **username** :api 
        * **password** : RlI1FOWCkuGLKEdNBi9j

* **Method:**
  `POST`
* **Data Params**
{
  "salutation" : "Mr",
  "firstname" : "John",
  "lastname" : "Doe",
  "account_start_date" : "",
  "account_end_date" : "",
  "finance_provider" : "Test",
  "did_broker_arrange" : "No",
  "broker_name" : "",
  "ppi_claim_type" : "single",
  "amount_ppi" : "",
  "daytime_phone" : "07321654987",
  "home_phone" : "07321654987",
  "mobile" : "07321654987",
  "email_address" : "john_doe@gmail.com",
  "date_of_birth":'2016-01-19',
  "financial_business_name" : "",
  "ppi_policy_number" : "",
  "when_did_you_takeout_ppi" : "",
  "can_remember_date_of_ppi_takeout" : "",
  "ppi_cover_type" : "",
  "how_was_ppi_sold" : "",
  "did_financial_business_give_advice" : "",
  "ppi_payment_method" : "",
  "ppi_insurance_current_situation" : "",
  "ppi_insurance_cancelled_situation_date" : "",
  "had_a_claim_ppi_insurance" : "",
  "had_a_claim_ppi_insurance_details" : "",
  "bought_cover_with_ppi_insurance" : "",
  "account_number" : "",
  "reason_of_borrowing" : "",
  "borrowed_money_to_payoff_debt_details" : "",
  "ever_missed_payments" : "",
  "ever_missed_payments_explanation" : "",
  "employment_status_during_ppi_payment_you" : "",
  "employment_status_during_ppi_payment_partner" : "",
  "employment_status_change_details" : "",
  "type_of_work_ppi_you" : "",
  "type_of_work_ppi_partner" : "",
  "name_of_employer_you" : "",
  "name_of_employer_partner" : "",
  "how_long_been_working_years_you" : "",
  "how_long_been_working_months_you" : "",
  "how_long_been_working_years_partner" : "",
  "how_long_been_working_months_partner" : "",
  "would_you_still_receive_payment" : "",
  "would_you_still_receive_payment_details" : "",
  "would_partner_still_receive_payment" : "",
  "would_partner_still_receive_payment_details" : "",
  "other_way_of_making_money_for_repayments_you" : "",
  "other_way_of_making_money_for_repayments_you_details" : "",
  "other_way_of_making_money_for_repayments_partner" : "",
  "has_health_problems_you" : "",
  "has_health_problems_you_details" : "",
  "has_health_problems_partner" : "",
  "what_happen_tookout_payment_protection" : "",
  "reason_of_unhappiness_with_insurance" : "",
  "complaining_on_behalf_name" : "",
  "complaining_on_behalf_relationship" : "",
  "complaining_on_behalf_daytime_phone" : "",
  "complaining_on_behalf_email" : "",
  "complaining_on_behalf_fax" : "",
  "complaining_on_behalf_ref" : "",
  "complaining_on_behalf_of_a_business_official_name" : "",
  "complaining_on_behalf_of_a_business_num_employees" : "",
  "complaining_on_behalf_of_a_business_num_partners" : "",
  "complaining_on_behalf_of_a_business_annual_income" : "",
  "company_details_responsible_on_complaint_name" : "",
  "company_details_responsible_on_complaint_address" : "",
  "company_details_responsible_on_complaint_phone" : "",
  "adviser_who_sold_product_name" : "",
  "adviser_who_sold_product_address" : "",
  "adviser_who_sold_product_phone_number" : "",
  "kind_of_service_complained" : "",
  "kind_of_service_complained_reference_number" : "",
  "full_complain_details" : "",
  "when_did_transaction_take_place" : "",
  "first_complain_took_place" : "",
  "did_company_sent_message" : "",
  "any_court_action" : "",
  "settlement_details" : "",
  "has_accessibility_problem" : "",
  "client_signature_image" : "",
  "pdf_template" : "",
  "security_key" : "",
  "created_at" : "",
  "updated_at" : "",
}


* **Success Response:**

  * **Code:** 201
  * **Content:** Example return
{
  "id":38,
  "salutation" : "Mr",
  "firstname" : "John",
  "lastname" : "Doe",
  "account_start_date" : "",
  "account_end_date" : "",
  "finance_provider" : "Test",
  "did_broker_arrange" : "No",
  "broker_name" : "",
  "ppi_claim_type" : "single",
  "amount_ppi" : "",
  "daytime_phone" : "07321654987",
  "home_phone" : "07321654987",
  "mobile" : "07321654987",
  "email_address" : "john_doe@gmail.com",
  "date_of_birth":'2016-01-19',
  "financial_business_name" : "",
  "ppi_policy_number" : "",
  "when_did_you_takeout_ppi" : "",
  "can_remember_date_of_ppi_takeout" : "",
  "ppi_cover_type" : "",
  "how_was_ppi_sold" : "",
  "did_financial_business_give_advice" : "",
  "ppi_payment_method" : "",
  "ppi_insurance_current_situation" : "",
  "ppi_insurance_cancelled_situation_date" : "",
  "had_a_claim_ppi_insurance" : "",
  "had_a_claim_ppi_insurance_details" : "",
  "bought_cover_with_ppi_insurance" : "",
  "account_number" : "",
  "reason_of_borrowing" : "",
  "borrowed_money_to_payoff_debt_details" : "",
  "ever_missed_payments" : "",
  "ever_missed_payments_explanation" : "",
  "employment_status_during_ppi_payment_you" : "",
  "employment_status_during_ppi_payment_partner" : "",
  "employment_status_change_details" : "",
  "type_of_work_ppi_you" : "",
  "type_of_work_ppi_partner" : "",
  "name_of_employer_you" : "",
  "name_of_employer_partner" : "",
  "how_long_been_working_years_you" : "",
  "how_long_been_working_months_you" : "",
  "how_long_been_working_years_partner" : "",
  "how_long_been_working_months_partner" : "",
  "would_you_still_receive_payment" : "",
  "would_you_still_receive_payment_details" : "",
  "would_partner_still_receive_payment" : "",
  "would_partner_still_receive_payment_details" : "",
  "other_way_of_making_money_for_repayments_you" : "",
  "other_way_of_making_money_for_repayments_you_details" : "",
  "other_way_of_making_money_for_repayments_partner" : "",
  "has_health_problems_you" : "",
  "has_health_problems_you_details" : "",
  "has_health_problems_partner" : "",
  "what_happen_tookout_payment_protection" : "",
  "reason_of_unhappiness_with_insurance" : "",
  "complaining_on_behalf_name" : "",
  "complaining_on_behalf_relationship" : "",
  "complaining_on_behalf_daytime_phone" : "",
  "complaining_on_behalf_email" : "",
  "complaining_on_behalf_fax" : "",
  "complaining_on_behalf_ref" : "",
  "complaining_on_behalf_of_a_business_official_name" : "",
  "complaining_on_behalf_of_a_business_num_employees" : "",
  "complaining_on_behalf_of_a_business_num_partners" : "",
  "complaining_on_behalf_of_a_business_annual_income" : "",
  "company_details_responsible_on_complaint_name" : "",
  "company_details_responsible_on_complaint_address" : "",
  "company_details_responsible_on_complaint_phone" : "",
  "adviser_who_sold_product_name" : "",
  "adviser_who_sold_product_address" : "",
  "adviser_who_sold_product_phone_number" : "",
  "kind_of_service_complained" : "",
  "kind_of_service_complained_reference_number" : "",
  "full_complain_details" : "",
  "when_did_transaction_take_place" : "",
  "first_complain_took_place" : "",
  "did_company_sent_message" : "",
  "any_court_action" : "",
  "settlement_details" : "",
  "has_accessibility_problem" : "",
  "client_signature_image" : "",
  "pdf_template" : "",
  "security_key" : "",
  "created_at": {
    "expression": "NOW()",
    "params": []
  },
  "updated_at": {
    "expression": "NOW()",
    "params": []
  }
}

* **Error Response:**

  * **Code:** 500 Unexpected Error 
    **Content:** `An error occured in the server`

  * **Code:** 401 UNAUTHORIZED 
    **Description:** `You are unauthorized to make this request.`

  * **Code:** 400 Validation error  
    **Description:** `Some required field are not set.`

* **Schema Model: ** PPILead
  * **id** : integer
  * **salutation** : string(0,255) , required
  * **firstname** : string(0,255) , required
  * **lastname** : string(0,255) , lastname
  * **prev_salutation** : string(0,255)
  * **prev_firstname** : string(0,255)
  * **prev_lastname** : string(0,255)
  * **partner_detail_title** : string(0,255)
  * **partner_detail_firstname** : string(0,255)
  * **partner_detail_lastname** : string(0,255)
  * **partner_detail_date_of_birth** : date , format(Y-m-d). e.g 2016-12-30
  * **account_start_date** : datetime , format(Y-m-d H:i:s). e.g 2016-12-30 00:00:00  
  * **account_end_date** : datetime , format(Y-m-d H:i:s). e.g 2016-12-30 00:00:00  
  * **finance_provider** : string(0,255) , required
  * **did_broker_arrange** : string(0,255) , required [Yes/No]
  * **broker_name** : string(0,255)
  * **ppi_claim_type** : string(0,255) , required [single/joint]
  * **amount_ppi** : string(0,255)
  * **daytime_phone** : string(0,255)
  * **home_phone** : string(0,255) , required
  * **mobile** : string(0,255), required
  * **email_address** : string(0,255) , required
  * **financial_business_name** : string(0,255)
  * **ppi_policy_number** : string(0,255)
  * **when_did_you_takeout_ppi** : date , format(Y-m-d). e.g 2016-12-30
  * **can_remember_date_of_ppi_takeout** : string(0,255)
  * **ppi_cover_type** : string(0,255)
  * **how_was_ppi_sold** : string(0,255)
  * **did_financial_business_give_advice** : string(0,255)
  * **ppi_payment_method** : string(0,255)
  * **ppi_insurance_current_situation** : string(0,255)
  * **ppi_insurance_cancelled_situation_date** : date , format(Y-m-d). e.g 2016-12-30
  * **had_a_claim_ppi_insurance** : string(0,255)
  * **had_a_claim_ppi_insurance_details** : string(0,   65,535)  
  * **bought_cover_with_ppi_insurance** : string(0,255)
  * **account_number** : string(0,255)
  * **reason_of_borrowing** : string(0,255)
  * **borrowed_money_to_payoff_debt_details** : string(0,   65,535)  
  * **ever_missed_payments** : string(0,255)
  * **ever_missed_payments_explanation** : string(0,255)
  * **employment_status_during_ppi_payment_you** : string(0,255)
  * **employment_status_during_ppi_payment_you_hours_w** : orkstring(0,255)
  * **employment_status_during_ppi_payment_partner** : string(0,255)
  * **employment_status_during_ppi_payment_partner_hours_work** : string(0,255) 
  * **employment_status_change_details** : string(0,   65,535)  
  * **type_of_work_ppi_you** : string(0,255)
  * **type_of_work_ppi_partner** : string(0,255)
  * **name_of_employer_you** : string(0,255)
  * **name_of_employer_partfner** : string(0,255)
  * **how_long_been_working_years_you** : string(0,255)
  * **how_long_been_working_months_you** : string(0,255)
  * **how_long_been_working_years_partner** : string(0,255)
  * **how_long_been_working_months_partner** : string(0,255)
  * **would_you_still_receive_payment** : string(0,255)
  * **would_you_still_receive_payment_details** : string(0,   65,535)  
  * **would_partner_still_receive_payment** : string(0,255)
  * **would_partner_still_receive_payment_details** : string(0,   65,535)  
  * **other_way_of_making_money_for_repayments_you** : string(0,255)
  * **other_way_of_making_money_for_repayments_you_details** : string(0,65,535)
  * **other_way_of_making_money_for_repayments_partner** : string(0,255)
  * **has_health_problems_you** : string(0,255)
  * **has_health_problems_you_details** : string(0,   65,535)  
  * **has_health_problems_partner** : string(0,255)
  * **what_happen_tookout_payment_protection** : string(0,255)
  * **reason_of_unhappiness_with_insurance** : string(0,255)
  * **complaining_on_behalf_name** : string(0,255)
  * **complaining_on_behalf_relationship** : string(0,255)
  * **complaining_on_behalf_daytime_phone** : string(0,255)
  * **complaining_on_behalf_email** : string(0,255)
  * **complaining_on_behalf_fax** : string(0,255)
  * **complaining_on_behalf_ref** : string(0,255)
  * **complaining_on_behalf_of_a_business_official_name** : string(0,255)
  * **complaining_on_behalf_of_a_business_num_employees** : string(0,255)
  * **complaining_on_behalf_of_a_business_num_partners** : string(0,255)
  * **complaining_on_behalf_of_a_business_annual_income** : string(0,255)
  * **company_details_responsible_on_complaint_name** : string(0,255)
  * **company_details_responsible_on_complaint_address** : string(0,255)
  * **company_details_responsible_on_complaint_phone** : string(0,255)
  * **adviser_who_sold_product_name** : string(0,255)
  * **adviser_who_sold_product_address** : string(0,255)
  * **adviser_who_sold_product_phone_number** : string(0,255)
  * **kind_of_service_complained** : string(0,255)
  * **kind_of_service_complained_reference_number** : string(0,255)
  * **full_complain_details** : string(0,   65,535)  
  * **when_did_transaction_take_place** : date , format(Y-m-d). e.g 2016-12-30
  * **first_complain_took_place** : date , format(Y-m-d). e.g 2016-12-30
  * **did_company_sent_message** : string(0,255)
  * **any_court_action** : string(0,255)
  * **settlement_details** : string(0,   65,535)  
  * **has_accessibility_problem** : string(0,255)
  * **client_signature_image** : string(0,255)
  * **pdf_template** : string(0,255)
  * **security_key** : string(0,255)
  * **address1** : string(0,255)
  * **address2** : string(0,255)
  * **address3** : string(0,255)
  * **address4** : string(0,255)
  * **address5** : string(0,255)
  * **postcode** : string(0,255)
  * **prev_address1** : string(0,255)
  * **prev_address2** : string(0,255)
  * **prev_address3** : string(0,255)
  * **prev_address4** : string(0,255)
  * **prev_address5** : string(0,255)
  * **prev_postcode** : string(0,255)
  * **date_of_birth** : date , format(Y-m-d). e.g 2016-12-30 , required
  * **account_provider** : string(0,255)
  * **monthly_account_charge** : string(0,255)
  * **finance_start** : datetime , format(Y-m-d H:i:s). e.g 2016-12-30 00:00:00  
  * **finance_end** : datetime , format(Y-m-d H:i:s). e.g 2016-12-30 00:00:00  
  * **is_joint** : string(0,255)
  * **finance_status** : string(0,255)
  * **final_tick_checklist** : string(0,255)
  * **created_at** : datetime , format(Y-m-d H:i:s). e.g 2016-12-30 00:00:00  
  * **updated_at** : datetime , format(Y-m-d H:i:s). e.g 2016-12-30 00:00:00  