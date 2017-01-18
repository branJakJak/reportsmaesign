**Create lead record**
----
Create lead record

* **URL**
 http://esign.site8.co/api/v1/1

* **Method:**
  `POST`
* **Data Params**
{
  "hotkey" :"",
  "salutation" :"Mr.",
  "firstname" :"John",
  "lastname" :"Doe",
  "account_type" :"",
  "account_provider" :"",
  "monthly_account_charge" :"",
  "account_start_date" :"",
  "account_end_date" :"",
  "is_ongoing" :0,
  "tried_to_claim_for_package" :"",
  "tried_to_claim_for_package_details" :"",
  "tried_to_claim_for_insurance_products" :"",
  "tried_to_claim_for_insurance_products_is_rejected" :"",
  "tried_to_claim_for_insurance_products_rejection_reason" :"",
  "used_benefits_packaged_bank" :"",
  "used_benefits_packaged_bank_details" :"",
  "know_benefit" :"",
  "registered_benefits_by_packaged_account":"",
  "registered_benefits_by_packaged_account_details":"",
  "understanding_of_features_and_benefits":"",
  "address_while_bank_opened":"",
  "bank_account_status":"",
  "bank_account_status_comment":"",
  "has_account_upgraded_downgraded":"",
  "upgrade_comment":"",
  "how_packaged_bank_account_sold" :"",
  "how_packaged_bank_account_sold_details" :"",
  "reason_to_takeout_packaged_account" :"",
  "reason_to_takeout_packaged_account_reason_of_speaking" :"",
  "noticed_account_fees":"",
  "noticed_account_fees_details":"",
  "actually_take_out_other_prodcuts":"",
  "actually_take_out_other_prodcuts_details":"",
  "did_they_give_advice" :"",
  "discuss_not_involed_packaged" :"",
  "discuss_not_involed_packaged_details" :"",
  "did_they_give_advice_clarify" :"",
  "did_they_give_advice_clarify_details" :"",
  "felt_under_pressure" :"",
  "felt_under_pressure_details" :"",
  "had_free_bank" :"",
  "did_representative_explain_main_exclusions" :"",
  "did_representative_explain_receive_written_info" :"",
  "receive_any_mailing_post" :"",
  "explain_changes_effect_elligibility" :"",
  "explain_pay_excess_claim_on_insurance" :"",
  "has_uk_driving_license_during_upgrade" :"",
  "own_a_car" :"",
  "has_mobile_phone_during_upgrade" :"",
  "has_mobile_phone_during_upgrade_has_internet_connection" :"",
  "often_go_holiday_in_europe" :"",
  "often_go_holiday_outside_europe" :"",
  "often_go_holiday_and_winter_sports" :"",
  "has_health_problems_during_upgrade" :"",
  "has_health_problems_during_upgrade_details" :"",
  "did_rep_explain_eligibility" :"",
  "has_registered_doctor_during_upgrade" :"",
  "further_details_help_evidence" :"",
  "did_kept_insurance_after_sale" :"",
  "did_kept_insurance_after_sale_details" :"",
  "reason_kept_existing_cover" :"",
  "when_opened_account_has_other_account" :"",
  "when_opened_account_has_other_account_details" :"",
  "reason_why_unhappy" :"",
  "landline":"",
  "mobile":"",
  "work_number":"",
  "email_address":"john_doe@gmail.com",
  "preferred_method_of_contact":"",
  "best_time_to_call":"",
  "client_contact_notes":"",
  "address1":"",
  "address2":"",
  "address3":"",
  "address4":"",
  "postcode":"",
  "date_of_birth":"2016-12-30 00:00:00",
  "previous_name":"",
  "previous_address1":"",
  "previous_address2":"",
  "previous_address3":"",
  "previous_address4":"",
  "previous_postcode":"",
  "other_previous_address":"",
  "other_previous_address_details":"",
  "account_number":"",
  "sort_code":"",
  "appointment_date":"",
  "appointment_time":"",
  "notes":"",
  "client_signature_image" :"",
  "pdf_template" :"original",
  "complaint_reference":"",
  "financial_business_name":"",
  "last_3_digit_account_num":"",
  "is_complain_about_sale_packaged_bank_account":"",
  "is_complain_about_sale_packaged_bank_account_details":"",
  "open_or_upgrade_package_bank_account_date":"",
  "notice_account_fees_on_statements":"",
  "notice_account_fees_on_statements_details":"",
  "current_situation_packaged_bank_account":"",
  "current_situation_packaged_bank_account_explanation":"",
  "is_address_outside_UK_at_package_upgrade":"",
  "has_registered_doctor_during_upgrade_details":"",
  "after_upgrade_already_has_products_details":"",
  "complaint_whole_details":"",
  "declaration_confirmed_tick":"",
  "occupation":"",
  "salutation_complain_with":"",
  "firstname_complain_with":"",
  "lastname_complain_with":"",
  "occupation_complain_with":"",
  "date_of_birth_complain_with":"",
  "postcode_complain_with":"",
  "address1_complain_with":"",
  "address2_complain_with":"",
  "address3_complain_with":"",
  "address4_complain_with":"",
  "mobile_complain_with":"",
  "behalf_of_charity_official_name":"",
  "behalf_of_charity_num_of_employees":"",
  "behalf_of_charity_num_of_partners":"",
  "behalf_of_charity_annual_income":"",
  "business_responsible_details_name":"",
  "business_responsible_details_address":"",
  "business_responsible_details_phone":"",
  "adviser_detail_name":"",
  "adviser_detail_address":"",
  "adviser_detail_phone":"",
  "kind_of_service_complain":"",
  "kind_of_service_complain_reference":"",
  "when_trasaction_happen":"",
  "when_first_complain_business":"",
  "has_business_complaining_sent_letter":"",
  "has_court_action_to_complain":"",
  "settlement_with_business_details":"",
  "is_ineed_of_practical_help":"",
  "is_ineed_of_practical_help_details":"",
  "final_tick_checklist":"",
  "security_key":"",
  "after_upgrade_already_has_products":"",
  "created_at" :"",
  "updated_at" :""
}


* **Success Response:**

  * **Code:** 200 
    **Content: ** Example return
{
  "id":38,
  "hotkey": "",
  "salutation": "Mr.",
  "firstname": "John",
  "lastname": "Doe",
  "account_type": "",
  "account_provider": "",
  "monthly_account_charge": 0,
  "account_start_date": "2017-01-05 11:21:06",
  "account_end_date": "2017-01-05 11:21:06",
  "is_ongoing": 0,
  "tried_to_claim_for_package": "",
  "tried_to_claim_for_package_details": "",
  "tried_to_claim_for_insurance_products": "",
  "tried_to_claim_for_insurance_products_is_rejected": "",
  "tried_to_claim_for_insurance_products_rejection_reason": "",
  "used_benefits_packaged_bank": "",
  "used_benefits_packaged_bank_details": "",
  "know_benefit": "",
  "registered_benefits_by_packaged_account": "",
  "registered_benefits_by_packaged_account_details": "",
  "understanding_of_features_and_benefits": "",
  "address_while_bank_opened": "",
  "bank_account_status": "",
  "bank_account_status_comment": "",
  "has_account_upgraded_downgraded": "",
  "upgrade_comment": "",
  "how_packaged_bank_account_sold": "",
  "how_packaged_bank_account_sold_details": "",
  "reason_to_takeout_packaged_account": "",
  "reason_to_takeout_packaged_account_reason_of_speaking": "",
  "noticed_account_fees": "",
  "noticed_account_fees_details": "",
  "actually_take_out_other_prodcuts": "",
  "actually_take_out_other_prodcuts_details": "",
  "did_they_give_advice": "",
  "discuss_not_involed_packaged": "",
  "discuss_not_involed_packaged_details": "",
  "did_they_give_advice_clarify": "",
  "did_they_give_advice_clarify_details": "",
  "felt_under_pressure": "",
  "felt_under_pressure_details": "",
  "had_free_bank": "",
  "did_representative_explain_main_exclusions": "",
  "did_representative_explain_receive_written_info": "",
  "receive_any_mailing_post": "",
  "explain_changes_effect_elligibility": "",
  "explain_pay_excess_claim_on_insurance": "",
  "has_uk_driving_license_during_upgrade": "",
  "own_a_car": "",
  "has_mobile_phone_during_upgrade": "",
  "has_mobile_phone_during_upgrade_has_internet_connection": "",
  "often_go_holiday_in_europe": "",
  "often_go_holiday_outside_europe": "",
  "often_go_holiday_and_winter_sports": "",
  "has_health_problems_during_upgrade": "",
  "has_health_problems_during_upgrade_details": "",
  "did_rep_explain_eligibility": "",
  "has_registered_doctor_during_upgrade": "",
  "further_details_help_evidence": "",
  "did_kept_insurance_after_sale": "",
  "did_kept_insurance_after_sale_details": "",
  "reason_kept_existing_cover": "",
  "when_opened_account_has_other_account": "",
  "when_opened_account_has_other_account_details": "",
  "reason_why_unhappy": "",
  "landline": "",
  "mobile": "",
  "work_number": "",
  "email_address": "john_doe@gmail.com",
  "preferred_method_of_contact": "",
  "best_time_to_call": "",
  "client_contact_notes": "",
  "address1": "",
  "address2": "",
  "address3": "",
  "address4": "",
  "postcode": "",
  "date_of_birth": "2017-01-05 19:21:03",
  "previous_name": "",
  "previous_address1": "",
  "previous_address2": "",
  "previous_address3": "",
  "previous_address4": "",
  "previous_postcode": "",
  "other_previous_address": "",
  "other_previous_address_details": "",
  "account_number": "",
  "sort_code": "",
  "appointment_date": "",
  "appointment_time": "",
  "notes": "",
  "client_signature_image": "",
  "pdf_template": " original",
  "complaint_reference": "",
  "financial_business_name": "",
  "last_3_digit_account_num": "",
  "is_complain_about_sale_packaged_bank_account": "",
  "is_complain_about_sale_packaged_bank_account_details": "",
  "open_or_upgrade_package_bank_account_date": "2017-01-05 11:21:06",
  "notice_account_fees_on_statements": "",
  "notice_account_fees_on_statements_details": "",
  "current_situation_packaged_bank_account": "",
  "current_situation_packaged_bank_account_explanation": "",
  "is_address_outside_UK_at_package_upgrade": "",
  "has_registered_doctor_during_upgrade_details": "",
  "after_upgrade_already_has_products_details": "",
  "complaint_whole_details": "",
  "declaration_confirmed_tick": "",
  "occupation": "",
  "salutation_complain_with": "",
  "firstname_complain_with": "",
  "lastname_complain_with": "",
  "occupation_complain_with": "",
  "date_of_birth_complain_with": "",
  "postcode_complain_with": "",
  "address1_complain_with": "",
  "address2_complain_with": "",
  "address3_complain_with": "",
  "address4_complain_with": "",
  "mobile_complain_with": "",
  "behalf_of_charity_official_name": "",
  "behalf_of_charity_num_of_employees": "",
  "behalf_of_charity_num_of_partners": "",
  "behalf_of_charity_annual_income": "",
  "business_responsible_details_name": "",
  "business_responsible_details_address": "",
  "business_responsible_details_phone": "",
  "adviser_detail_name": "",
  "adviser_detail_address": "",
  "adviser_detail_phone": "",
  "kind_of_service_complain": "",
  "kind_of_service_complain_reference": "",
  "when_trasaction_happen": "2017-01-05 11:21:06",
  "when_first_complain_business": "2017-01-05 11:21:06",
  "has_business_complaining_sent_letter": "",
  "has_court_action_to_complain": "",
  "settlement_with_business_details": "",
  "is_ineed_of_practical_help": "",
  "is_ineed_of_practical_help_details": "",
  "final_tick_checklist": "",
  "security_key": "586e2c2255398",
  "after_upgrade_already_has_products": "",
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

* **Schema Model: ** Lead Esign
  * **id:** integer  
  * **hotkey:** string(0,255)  
  * **salutation:** string(0,255) , required 
  * **firstname:** string(0,255) , required 
  * **lastname:** string(0,255) , required 
  * **account_type:** string(0,255)  
  * **account_provider:** string(0,255)  
  * **monthly_account_charge:** string(0,255)  
  * **account_start_date:** datetime , format(Y-m-d H:i:s). e.g 2016-12-30 00:00:00  
  * **account_end_date:**  datetime , format(Y-m-d H:i:s). e.g 2016-12-30 00:00:00  
  * **is_ongoing:** string(0,255)  
  * **tried_to_claim_for_package:** string(0,255)  
  * **tried_to_claim_for_package_details:** string(0,65,535)  
  * **tried_to_claim_for_insurance_products:** string(0,255)  
  * **tried_to_claim_for_insurance_products_is_rejected:** string(0,255)  
  * **tried_to_claim_for_insurance_products_rejection_reason:** string(0,255)  
  * **used_benefits_packaged_bank:** string(0,255)  
  * **used_benefits_packaged_bank_details:**  string(  0  ,  65,535) 
  * **know_benefit:** string(0,255)  
  * **registered_benefits_by_packaged_account:** string(0,255)  
  * **registered_benefits_by_packaged_account_details:**  string(  0  ,  65,535)  
  * **understanding_of_features_and_benefits:** string(0,255)  
  * **address_while_bank_opened:** string(0,255)  
  * **bank_account_status:** string(0,255)  
  * **bank_account_status_comment:** string(0,255)  
  * **has_account_upgraded_downgraded:** string(0,255)  
  * **upgrade_comment:** string(0,255)  
  * **how_packaged_bank_account_sold:** string(0,255)  
  * **how_packaged_bank_account_sold_details:** string(0,  65,535)  
  * **reason_to_takeout_packaged_account:** string(0,255)  
  * **reason_to_takeout_packaged_account_reason_of_speaking:** string(0,255)  
  * **noticed_account_fees:** string(0,255)  
  * **noticed_account_fees_details:** string(0,255)  
  * **actually_take_out_other_prodcuts:** string(0,255)  
  * **actually_take_out_other_prodcuts_details:** string(0,   65,535)  
  * **did_they_give_advice:** string(0,255)  
  * **discuss_not_involed_packaged:** string(0,255)  
  * **discuss_not_involed_packaged_details:** string(0,   65,535)  
  * **did_they_give_advice_clarify:** string(0,255)  
  * **did_they_give_advice_clarify_details:** string(0,  65,535)  
  * **felt_under_pressure:** string(0,255)  
  * **felt_under_pressure_details:** string(0,   65,535)  
  * **had_free_bank:** string(0,255)  
  * **did_representative_explain_main_exclusions:** string(0,255)  
  * **did_representative_explain_receive_written_info:** string(0,255)  
  * **receive_any_mailing_post:** string(0,255)  
  * **explain_changes_effect_elligibility:** string(0,255)  
  * **explain_pay_excess_claim_on_insurance:** string(0,255)  
  * **has_uk_driving_license_during_upgrade:** string(0,255)  
  * **own_a_car:** string(0,255)  
  * **has_mobile_phone_during_upgrade:** string(0,255)  
  * **has_mobile_phone_during_upgrade_has_internet_connection:** string(0,255)  
  * **often_go_holiday_in_europe:** string(0,255)  
  * **often_go_holiday_outside_europe:** string(0,255)  
  * **often_go_holiday_and_winter_sports:** string(0,255)  
  * **has_health_problems_during_upgrade:** string(0,255)  
  * **has_health_problems_during_upgrade_details:** string(0,255)  
  * **did_rep_explain_eligibility:** string(0,255)  
  * **has_registered_doctor_during_upgrade:** string(0,255)  
  * **further_details_help_evidence:** string(0,255)  
  * **did_kept_insurance_after_sale:** string(0,255)  
  * **did_kept_insurance_after_sale_details:** string(0,255)  
  * **reason_kept_existing_cover:** string(0,   65,535)  
  * **when_opened_account_has_other_account:** string(0,255)  
  * **when_opened_account_has_other_account_details:** string(0,   65,535)  
  * **reason_why_unhappy:** string(0,   65,535)  
  * **landline:** string(0,255)  
  * **mobile:** string(0,255)  
  * **work_number:** string(0,255)  
  * **email_address:** string(0,255), required  
  * **preferred_method_of_contact:** string(0,255)  
  * **best_time_to_call:** string(0,255)  
  * **client_contact_notes:** string(0,255)  
  * **address1:** string(0,255)  
  * **address2:** string(0,255)  
  * **address3:** string(0,255)  
  * **address4:** string(0,255)  
  * **postcode:** string(0,255)  
  * **date_of_birth:** string(0,255) , required 
  * **previous_name:** string(0,255)  
  * **previous_address1:** string(0,255)  
  * **previous_address2:** string(0,255)  
  * **previous_address3:** string(0,255)  
  * **previous_address4:** string(0,255)  
  * **previous_postcode:** string(0,255)  
  * **other_previous_address:** string(0,255)  
  * **other_previous_address_details:** string(0,   65,535)  
  * **account_number:** string(0,255)  
  * **sort_code:** string(0,255)  
  * **appointment_date:** string(0,255)  
  * **appointment_time:** string(0,255)  
  * **notes:** string(0,255)  
  * **client_signature_image:** string(0,255)  
  * **pdf_template:** string(0,255)  
  * **complaint_reference:** string(0,255)  
  * **financial_business_name:** string(0,255)  
  * **last_3_digit_account_num:** string(0,255)  
  * **is_complain_about_sale_packaged_bank_account:** string(0,255)  
  * **is_complain_about_sale_packaged_bank_account_details:** string(0,255)  
  * **open_or_upgrade_package_bank_account_date:** string(0,255)  
  * **notice_account_fees_on_statements:** string(0,255)  
  * **notice_account_fees_on_statements_details:** string(0,  65,535)  
  * **current_situation_packaged_bank_account:** string(0,255)  
  * **current_situation_packaged_bank_account_explanation:** string(0,255)  
  * **is_address_outside_UK_at_package_upgrade:** string(0,255)  
  * **has_registered_doctor_during_upgrade_details:** string(0,   65,535)  
  * **after_upgrade_already_has_products_details:** string(0,   65,535)  
  * **complaint_whole_details:** string(0,   65,535)  
  * **declaration_confirmed_tick:** string(0,255)  
  * **occupation:** string(0,255)  
  * **salutation_complain_with:** string(0,255)  
  * **firstname_complain_with:** string(0,255)  
  * **lastname_complain_with:** string(0,255)  
  * **occupation_complain_with:** string(0,255)  
  * **date_of_birth_complain_with:** string(0,255)  
  * **postcode_complain_with:** string(0,255)  
  * **address1_complain_with:** string(0,255)  
  * **address2_complain_with:** string(0,255)  
  * **address3_complain_with:** string(0,255)  
  * **address4_complain_with:** string(0,255)  
  * **mobile_complain_with:** string(0,255)  
  * **behalf_of_charity_official_name:** string(0,255)  
  * **behalf_of_charity_num_of_employees:** string(0,255)  
  * **behalf_of_charity_num_of_partners:** string(0,255)  
  * **behalf_of_charity_annual_income:** string(0,255)  
  * **business_responsible_details_name:** string(0,255)  
  * **business_responsible_details_address:** string(0, 65,535)  
  * **business_responsible_details_phone:** string(0,255)  
  * **adviser_detail_name:** string(0,255)  
  * **adviser_detail_address:** string(0,   65,535)  
  * **adviser_detail_phone:** string(0,255)  
  * **kind_of_service_complain:** string(0,255)  
  * **kind_of_service_complain_reference:** string(0,255)  
  * **when_trasaction_happen:** string(0,255)  
  * **when_first_complain_business:** string(0,255)  
  * **has_business_complaining_sent_letter:** string(0,255)  
  * **has_court_action_to_complain:** string(0,255)  
  * **settlement_with_business_details:** string(0,    65,535)  
  * **is_ineed_of_practical_help:** string(0,255)  
  * **is_ineed_of_practical_help_details:** string(0,   65,535)  
  * **final_tick_checklist:** string(0,   65,535)  
  * **security_key:** string(0,255)  
  * **after_upgrade_already_has_products:** string(0,255)  
  * **created_at:**  datetime , format(Y-m-d H:i:s). e.g 2016-12-30 00:00:00  
  * **updated_at:**  datetime , format(Y-m-d H:i:s). e.g 2016-12-30 00:00:00  
