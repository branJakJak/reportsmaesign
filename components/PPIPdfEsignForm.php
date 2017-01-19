<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 1/5/17
 * Time: 10:50 PM
 */

namespace app\components;


use app\models\LeadEsign;
use FPDI;

class PPIPdfEsignForm extends PdfEsign{
    public function export()
    {
        /**
         * @var $leadObj LeadEsign
         */
        class_exists('TCPDF', true);
        $pdf = new FPDI();
        $pdf->addPage();
        $pdf->SetFont("Helvetica",'',8);
        $pdf->setSourceFile($this->pdfTemplate);
        $leadObj = $this->leadObject;
        $leadObj->date_of_birth = date("d/m/Y",strtotime($leadObj->date_of_birth));

        /*page 1*/
        $tplIdx = $pdf->importPage(1);
        $this->writeToPdf($pdf,$tplIdx , 80 , 39 +4 ,$leadObj->salutation);
        $this->writeToPdf($pdf,$tplIdx , 110 , 39 +4 ,$leadObj->firstname);
        $this->writeToPdf($pdf,$tplIdx , 153 , 39 +4 ,$leadObj->lastname);
        $this->writeToPdf($pdf,$tplIdx , 69 , 80 +2 ,$leadObj->address1);
        $this->writeToPdf($pdf,$tplIdx , 69 , 86 +2 ,$leadObj->address2);
        $this->writeToPdf($pdf,$tplIdx , 69 , 93 +2 ,$leadObj->address3);
        $this->writeToPdf($pdf,$tplIdx , 69 , 100  +2,$leadObj->address4);
        $this->writeToPdf($pdf,$tplIdx , 69 , 113 +1 ,$leadObj->postcode);
        $this->writeToPdf($pdf,$tplIdx , 69 , 106 +2 ,"United Kingdom");
        $this->writeToPdf($pdf,$tplIdx , 69 , 126 -6 ,$leadObj->home_phone);
        $this->writeToPdf($pdf,$tplIdx , 69 , 126 +1 ,$leadObj->mobile);
        $this->writeToPdf($pdf,$tplIdx , 69 , 132 +1 ,$leadObj->email_address);
        $this->writeToPdf($pdf,$tplIdx , 69 , 137  +2,$leadObj->date_of_birth);
        $this->writeToPdf($pdf,$tplIdx , 69 , 143  +2,$leadObj->account_provider);
        if ($leadObj->did_broker_arrange === 'Yes') {
            $this->writeToPdf($pdf,$tplIdx , 69 , 150  +2 ,"Yes");
        }else{
            $this->writeToPdf($pdf,$tplIdx , 69 , 150  +2 ,"No");
        }
        $this->writeToPdf($pdf,$tplIdx , 72 , 156  +4 ,$leadObj->amount_ppi );
        $this->writeToPdf($pdf,$tplIdx , 72 , 160  +7 ,$leadObj->finance_start );
        $this->writeToPdf($pdf,$tplIdx , 155 , 160  +7 ,$leadObj->finance_end );
        $this->writeToPdf($pdf,$tplIdx , 72 , 181 +2,$leadObj->amount_ppi );


        $this->writeToPdf($pdf,$tplIdx , 165, 22 , $leadObj->security_key);

        $this->writeToPdf($pdf,$tplIdx , 60, 270, date("d/m/Y",time()).'wee');
        $pdf->Image($leadObj->client_signature_image, 18, 255, 100,18);

        /*page 2*/
        $pdf->addPage();
        $tplIdx = $pdf->importPage(2);
        $pdf->useTemplate($tplIdx, 0, 0, 0, 0, true);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(20, 20);
        $this->writeToPdf($pdf,$tplIdx , 130, 11 , $leadObj->security_key);
        /*page 3*/
        $pdf->addPage();
        $tplIdx = $pdf->importPage(3);
        $pdf->useTemplate($tplIdx, 0, 0, 0, 0, true);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(20, 20);
        $this->writeToPdf($pdf,$tplIdx , 130, 11 , $leadObj->security_key);
        /*fullname*/
        $this->writeToPdf($pdf,$tplIdx , 35 , 230,  sprintf("%s %s %s",$leadObj->salutation , $leadObj->firstname,$leadObj->lastname) );
        /*full address*/
        $fullAddress = sprintf(
            "%s %s %s %s %s" ,
            $leadObj->address1 ,
            $leadObj->address2 ,
            $leadObj->address3 ,
            $leadObj->address4,
            $leadObj->address5
        );
        $this->writeToPdf($pdf,$tplIdx , 35 , 242, $fullAddress );
        $this->writeToPdf($pdf,$tplIdx , 150 , 242 , $leadObj->postcode);
        $pdf->Image($leadObj->client_signature_image, 30, 248, 100,18);
        $this->writeToPdf($pdf,$tplIdx , 35, 267 , date("d/m/Y",time()));


        /*page 4*/
        $pdf->addPage();
        $tplIdx = $pdf->importPage(4);
        $pdf->useTemplate($tplIdx, 0, 0, 0, 0, true);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(20, 20);

        /*fullname*/
        $this->writeToPdf($pdf,$tplIdx , 28 , 219, $leadObj->salutation  );
        $this->writeToPdf($pdf,$tplIdx , 60 , 219, $leadObj->firstname );
        $this->writeToPdf($pdf,$tplIdx , 36 , 225, $leadObj->lastname );
        $this->writeToPdf($pdf,$tplIdx , 45 , 232, $leadObj->date_of_birth );
        // /*full address*/
        $fullAddress = sprintf(
            "%s %s %s" ,
            $leadObj->address1 ,
            $leadObj->address2 ,
            $leadObj->address3
        );
        $this->writeToPdf($pdf,$tplIdx , 35 , 238, $fullAddress );
        $this->writeToPdf($pdf,$tplIdx , 35 , 242,  sprintf('%s %s',$leadObj->address4,$leadObj->address5) );
        $this->writeToPdf($pdf,$tplIdx , 38 , 251 , $leadObj->postcode);

        $pdf->Image($leadObj->client_signature_image, 26, 255, 100,18);
        $this->writeToPdf($pdf,$tplIdx , 27, 270 , date("d/m/Y",time()));

        /*page 5*/
        $pdf->addPage();
        $tplIdx = $pdf->importPage(5);
        $pdf->useTemplate($tplIdx, 0, 0, 0, 0, true);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(20, 20);

        /*fullname*/
        $this->writeToPdf($pdf,$tplIdx , 28 , 219  + 3, $leadObj->salutation  );
        $this->writeToPdf($pdf,$tplIdx , 60 , 219 + 3, $leadObj->firstname );
        $this->writeToPdf($pdf,$tplIdx , 36 , 225 + 3, $leadObj->lastname );
        $this->writeToPdf($pdf,$tplIdx , 45 , 232 + 3, $leadObj->date_of_birth );
        // /*full address*/
        $fullAddress = sprintf(
            "%s %s %s" ,
            $leadObj->address1 ,
            $leadObj->address2 ,
            $leadObj->address3
        );
        $this->writeToPdf($pdf,$tplIdx , 35 , 238 + 3, $fullAddress );
        $this->writeToPdf($pdf,$tplIdx , 35 , 242 + 3,  sprintf('%s %s',$leadObj->address4,$leadObj->address5) );
        $this->writeToPdf($pdf,$tplIdx , 38 , 251 + 3, $leadObj->postcode);

        $pdf->Image($leadObj->client_signature_image, 26, 255 + 3, 100,18);
        $this->writeToPdf($pdf,$tplIdx , 27, 270 + 3, date("d/m/Y",time()));

        /*page 6*/
        $pdf->addPage();
        $tplIdx = $pdf->importPage(6);
        $pdf->useTemplate($tplIdx, 0, 0, 0, 0, true);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(20, 20);


        /*fullname*/
        $this->writeToPdf($pdf,$tplIdx , 28 , 219  + 3, $leadObj->salutation  );
        $this->writeToPdf($pdf,$tplIdx , 60 , 219 + 3, $leadObj->firstname );
        $this->writeToPdf($pdf,$tplIdx , 36 , 225 + 3, $leadObj->lastname );
        $this->writeToPdf($pdf,$tplIdx , 45 , 232 + 3, $leadObj->date_of_birth );
        // /*full address*/
        $fullAddress = sprintf(
            "%s %s %s" ,
            $leadObj->address1 ,
            $leadObj->address2 ,
            $leadObj->address3
        );
        $this->writeToPdf($pdf,$tplIdx , 35 , 238 + 3, $fullAddress );
        $this->writeToPdf($pdf,$tplIdx , 35 , 242 + 3,  sprintf('%s %s',$leadObj->address4,$leadObj->address5) );
        $this->writeToPdf($pdf,$tplIdx , 38 , 251 + 3, $leadObj->postcode);

        $pdf->Image($leadObj->client_signature_image, 26, 255 + 3, 100,18);
        $this->writeToPdf($pdf,$tplIdx , 27, 270 + 3, date("d/m/Y",time()));

        /*page 7*/
        $pdf->addPage();
        $tplIdx = $pdf->importPage(7);
        $pdf->useTemplate($tplIdx, 0, 0, 0, 0, true);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(20, 20);

        /*fullname*/
        $this->writeToPdf($pdf,$tplIdx , 28 , 219  + 3, $leadObj->salutation  );
        $this->writeToPdf($pdf,$tplIdx , 60 , 219 + 3, $leadObj->firstname );
        $this->writeToPdf($pdf,$tplIdx , 36 , 225 + 3, $leadObj->lastname );
        $this->writeToPdf($pdf,$tplIdx , 45 , 232 + 3, $leadObj->date_of_birth );
        /*full address*/
        $fullAddress = sprintf(
            "%s %s %s" ,
            $leadObj->address1 ,
            $leadObj->address2 ,
            $leadObj->address3
        );
        $this->writeToPdf($pdf,$tplIdx , 35 , 238 + 3, $fullAddress );
        $this->writeToPdf($pdf,$tplIdx , 35 , 242 + 3,  sprintf('%s %s',$leadObj->address4,$leadObj->address5) );
        $this->writeToPdf($pdf,$tplIdx , 38 , 251 + 3, $leadObj->postcode);

        $pdf->Image($leadObj->client_signature_image, 26, 255 + 3, 100,18);
        $this->writeToPdf($pdf,$tplIdx , 27, 270 + 3, date("d/m/Y",time()));


        /*page 8*/
        $pdf->addPage();
        $tplIdx = $pdf->importPage(8);
        $pdf->useTemplate($tplIdx, 0, 0, 0, 0, true);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(20, 20);
        $this->writeToPdf($pdf,$tplIdx , 38 , 110, $leadObj->lastname );
        $this->writeToPdf($pdf,$tplIdx , 104 , 110, $leadObj->salutation );
        $this->writeToPdf($pdf,$tplIdx , 38 , 118, $leadObj->firstname );
        /*date*/
        $this->writeToPdf($pdf,$tplIdx , 41 , 124, $leadObj->date_of_birth[0]);
        $this->writeToPdf($pdf,$tplIdx , 50 , 124, $leadObj->date_of_birth[1]);
        // /*month*/
        $this->writeToPdf($pdf,$tplIdx , 60 , 124, $leadObj->date_of_birth[3]);
        $this->writeToPdf($pdf,$tplIdx , 70 , 124, $leadObj->date_of_birth[4]);
        // /*year*/
        $this->writeToPdf($pdf,$tplIdx , 80 , 124, $leadObj->date_of_birth[6]);
        $this->writeToPdf($pdf,$tplIdx , 90 , 124, $leadObj->date_of_birth[7]);
        $this->writeToPdf($pdf,$tplIdx , 98 , 124, $leadObj->date_of_birth[8]);
        $this->writeToPdf($pdf,$tplIdx , 108 , 124, $leadObj->date_of_birth[9]);

        $this->writeToPdf($pdf,$tplIdx , 123 , 110, $leadObj->partner_detail_lastname );
        $this->writeToPdf($pdf,$tplIdx , 183 , 110, $leadObj->partner_detail_title );
        $this->writeToPdf($pdf,$tplIdx , 123 , 118, $leadObj->partner_detail_firstname);
        /*date*/
        if ($leadObj->partner_detail_date_of_birth) {

            $this->writeToPdf($pdf,$tplIdx , 123 , 124, $leadObj->partner_detail_date_of_birth[0]);
            $this->writeToPdf($pdf,$tplIdx , 123+10 , 124, $leadObj->partner_detail_date_of_birth[1]);
            /*month*/
            $this->writeToPdf($pdf,$tplIdx , 123+19 , 124, $leadObj->partner_detail_date_of_birth[3]);
            $this->writeToPdf($pdf,$tplIdx , 123+29 , 124, $leadObj->partner_detail_date_of_birth[4]);
            /*year*/
            $this->writeToPdf($pdf,$tplIdx , 123+38 , 124, $leadObj->partner_detail_date_of_birth[6]);
            $this->writeToPdf($pdf,$tplIdx , 123+47 , 124, $leadObj->partner_detail_date_of_birth[7]);
            $this->writeToPdf($pdf,$tplIdx , 123+56 , 124, $leadObj->partner_detail_date_of_birth[8]);
            $this->writeToPdf($pdf,$tplIdx , 123+55+9 , 124, $leadObj->partner_detail_date_of_birth[9]);       
        }


        $this->writeToPdf($pdf,$tplIdx , 41 , 145, $leadObj->address1);
        $this->writeToPdf($pdf,$tplIdx , 41 , 149, $leadObj->address2);
        $this->writeToPdf($pdf,$tplIdx , 41 , 153, $leadObj->address3);
        $this->writeToPdf($pdf,$tplIdx , 41 , 157, $leadObj->address4);
        $this->writeToPdf($pdf,$tplIdx , 41 , 161, $leadObj->address5.','.$leadObj->postcode);
        $this->writeToPdf($pdf,$tplIdx , 41 , 168, $leadObj->daytime_phone );
        $this->writeToPdf($pdf,$tplIdx , 123 , 168, $leadObj->mobile );
        $this->writeToPdf($pdf,$tplIdx , 41 , 176, $leadObj->home_phone );
        $this->writeToPdf($pdf,$tplIdx , 123 , 176, $leadObj->email_address );
        $this->writeToPdf($pdf,$tplIdx , 41 , 250, $leadObj->financial_business_name);
        $this->writeToPdf($pdf,$tplIdx , 41 , 269, $leadObj->ppi_policy_number );

        /*page 9*/
        $pdf->addPage();
        $tplIdx = $pdf->importPage(9);
        $pdf->useTemplate($tplIdx, 0, 0, 0, 0, true);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(20, 20);

        if (isset($leadObj->when_did_you_takeout_ppi)) {
            /*day*/
            $this->writeToPdf($pdf,$tplIdx , 25 , 37, $leadObj->when_did_you_takeout_ppi[0]);
            $this->writeToPdf($pdf,$tplIdx , 31 , 37, $leadObj->when_did_you_takeout_ppi[1] );
            /*month*/
            $this->writeToPdf($pdf,$tplIdx , 40 , 37, $leadObj->when_did_you_takeout_ppi[3] );
            $this->writeToPdf($pdf,$tplIdx , 47 , 37, $leadObj->when_did_you_takeout_ppi[4] );
            // /*year*/
            $this->writeToPdf($pdf,$tplIdx , 53.5 , 37, $leadObj->when_did_you_takeout_ppi[6] );
            $this->writeToPdf($pdf,$tplIdx , 61 , 37, $leadObj->when_did_you_takeout_ppi[7] );
            $this->writeToPdf($pdf,$tplIdx , 68 , 37, $leadObj->when_did_you_takeout_ppi[8] );
            $this->writeToPdf($pdf,$tplIdx , 76 , 37, $leadObj->when_did_you_takeout_ppi[9] );
        }

        if ($leadObj->can_remember_date_of_ppi_takeout === 'Yes') {
            $this->writeToPdf($pdf,$tplIdx , 107.5 , 36.8, "x");
        }


        if ($leadObj->is_joint === 1) {
            $this->writeToPdf($pdf,$tplIdx , 26.5 , 69, "x");
        }else if ($leadObj->is_joint === 2) {
            $this->writeToPdf($pdf,$tplIdx , 64 , 69, "x");
        }

        /*how was insurance sold*/
        $how_was_ppi_sold_coor_x =  25;
        $how_was_ppi_sold_coor_y =  0;
        switch ($leadObj->how_was_ppi_sold) {
            case 'during a meeting':
                $how_was_ppi_sold_coor_y =  98;
                break;
            case 'during a phone conversation':
                $how_was_ppi_sold_coor_y =  104.5;
                break;
            case 'you were given a leaflet to fill in':
                $how_was_ppi_sold_coor_y =  108;
                break;
            case 'over the internet':
                $how_was_ppi_sold_coor_y =  117;
                break;
            case 'by post':
                $how_was_ppi_sold_coor_y =  123.5;
                break;
            case 'can’t remember':
                $how_was_ppi_sold_coor_y =  130;
                break;
            default:
                break;
        }
        if ($how_was_ppi_sold_coor_x !== 0 &&  $how_was_ppi_sold_coor_y !== 0) {
            $this->writeToPdf($pdf,$tplIdx , $how_was_ppi_sold_coor_x , $how_was_ppi_sold_coor_y, "x");
        }

        $did_financial_business_give_advice_x = 25.5;
        $did_financial_business_give_advice_y = 0;
        if ($leadObj->did_financial_business_give_advice === 'Yes') {
            $did_financial_business_give_advice_y = 153;
        } else if ($leadObj->did_financial_business_give_advice === 'No') {
            $did_financial_business_give_advice_y = 159;
        }else {
            $did_financial_business_give_advice_y = 165.5;            
        }
        if ($did_financial_business_give_advice_x !== 0 && $did_financial_business_give_advice_y !== 0) {
            $this->writeToPdf($pdf,$tplIdx , $did_financial_business_give_advice_x , $did_financial_business_give_advice_y, "x");
        }

        /*ppi payment method*/
        if ($leadObj->ppi_payment_method === 'with a single payment (“premium”) paid up-front as a one-off') {
            $this->writeToPdf($pdf,$tplIdx , 25.5 , 188, "x");
        } else if ($leadObj->ppi_payment_method === 'with a “premium” paid each month') {
            $this->writeToPdf($pdf,$tplIdx , 25.5 , 194, "x");
        } else if ($leadObj->ppi_payment_method === 'not sure'){
            $this->writeToPdf($pdf,$tplIdx , 25.5 , 200.5, "x");
        }


        /*ppi payment situation*/
        if ($leadObj->ppi_insurance_current_situation === 'the insurance is still running') {
            $this->writeToPdf($pdf,$tplIdx , 25.3 , 226, "x");
        } else if ($leadObj->ppi_insurance_current_situation === 'the insurance ended when the loan was paid off (or when the credit card account was closed)') {
            $this->writeToPdf($pdf,$tplIdx , 25.3 , 232, "x");
        } else if ($leadObj->ppi_insurance_current_situation === 'the insurance was cancelled (if so, when did this happen?)'){
            $this->writeToPdf($pdf,$tplIdx , 25.3 , 241.5, "x");
        }


        if (isset($leadObj->ppi_insurance_cancelled_situation_date)) {
            /*month*/
            $this->writeToPdf($pdf,$tplIdx , 76 , 250, $leadObj->ppi_insurance_cancelled_situation_date[0]);
            $this->writeToPdf($pdf,$tplIdx , 85 , 250, $leadObj->ppi_insurance_cancelled_situation_date[1]);
            /*date*/
            $this->writeToPdf($pdf,$tplIdx , 95 , 250, $leadObj->ppi_insurance_cancelled_situation_date[3]);
            $this->writeToPdf($pdf,$tplIdx , 104 , 250, $leadObj->ppi_insurance_cancelled_situation_date[4]);
            /*year*/
            $this->writeToPdf($pdf,$tplIdx , 114 , 250, $leadObj->ppi_insurance_cancelled_situation_date[6]);
            $this->writeToPdf($pdf,$tplIdx , 123 , 250, $leadObj->ppi_insurance_cancelled_situation_date[7]);
            $this->writeToPdf($pdf,$tplIdx , 133 , 250, $leadObj->ppi_insurance_cancelled_situation_date[8]);
            $this->writeToPdf($pdf,$tplIdx , 142 , 250, $leadObj->ppi_insurance_cancelled_situation_date[9]);
        }


        /*page 10*/
        $pdf->addPage();
        $tplIdx = $pdf->importPage(10);
        $pdf->useTemplate($tplIdx, 0, 0, 0, 0, true);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(20, 20);

        $this->writeToPdf($pdf,$tplIdx , 25.4 , 30, 'x');
        $this->writeToPdf($pdf,$tplIdx , 26+19 , 30, 'x');
        if (isset($leadObj->had_a_claim_ppi_insurance)) {

        }
        /*details*/
        $this->writeToPdf($pdf,$tplIdx , 30 , 60, $leadObj->had_a_claim_ppi_insurance_details);
        

        // /*page 11*/
        $pdf->addPage();
        $tplIdx = $pdf->importPage(11);
        $pdf->useTemplate($tplIdx, 0, 0, 0, 0, true);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(20, 20);

        switch ($leadObj->bought_cover_with_ppi_insurance) {
            case 'a personal loan':
                $this->writeToPdf($pdf,$tplIdx , 22.3 , 43.5, 'x');
                break;
            case 'a business loan':
                $this->writeToPdf($pdf,$tplIdx , 22.3 , 43.5 + (6), 'x');
                break;
            case 'a credit card':
                $this->writeToPdf($pdf,$tplIdx , 22.3 , 43.5 + (6 * 2), 'x');           
                break;
            case 'a mortgage':
                $this->writeToPdf($pdf,$tplIdx , 22.3 , 43.5 + (6 * 3), 'x');
                break;
            case 'an overdraft':
                $this->writeToPdf($pdf,$tplIdx , 22.3 , 43.5 + (6 * 4), 'x');
                break;
            case 'a store card':
                $this->writeToPdf($pdf,$tplIdx , 22.3 , 43.5 + (6 * 5), 'x');            
                break;
            case 'a loan secured on your home in addition to your mortgage':
                $this->writeToPdf($pdf,$tplIdx , 22.3 , 43.5 + (6 * 6), 'x');            
                break;
            case 'catalogue shopping':
                 $this->writeToPdf($pdf,$tplIdx , 22.3 , 43.5 + (6 * 7), 'x');           
                break;
            case 'hire purchase':
                break;
            case 'not sure':
                break;
            default:
                break;
        }
        if ($leadObj->account_number) {
            $this->writeToPdf($pdf,$tplIdx , 80 , 108 , $leadObj->account_number);
        }

        switch ($leadObj->reason_of_borrowing) {
            case 'refinancing or consolidating other debts':
                $this->writeToPdf($pdf,$tplIdx , 23 , 137, 'x');
                break;
            case 'buying a car':
                $this->writeToPdf($pdf,$tplIdx , 23 , 147, 'x');
                break;
            case 'paying for home improvements':
                $this->writeToPdf($pdf,$tplIdx , 23 , 147+ (6 * 1), 'x');
                break;
            case 'paying for a wedding':
                $this->writeToPdf($pdf,$tplIdx , 23 , 147+ (6 * 2), 'x');
                break;
            case 'paying for a holiday':
                $this->writeToPdf($pdf,$tplIdx , 23 , 147+ (6 * 3), 'x');
                break;
            case 'non-essential spending (for example, buying a new TV)':
                $this->writeToPdf($pdf,$tplIdx , 23 , 147+ (6 * 4), 'x');
                break;
            case 'essential everyday spending (for example, rent, household bills or food shopping)':
                $this->writeToPdf($pdf,$tplIdx , 23 , 147+ (6 * 5), 'x');
                break;
            case 'business loan':
                $this->writeToPdf($pdf,$tplIdx , 23 , 147+ (6 * 6), 'x');
                break;
            case 'other (please tell us more below)':
                $this->writeToPdf($pdf,$tplIdx , 23 , 147+ (6 * 7), 'x');            
                break;
            default:
                break;
        }
        
        /*page 12*/
        $pdf->addPage();
        $tplIdx = $pdf->importPage(12);
        $pdf->useTemplate($tplIdx, 0, 0, 0, 0, true);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(20, 20);

        $borrowed_money_to_payoff_debt_details_temp_container = json_decode($leadObj->borrowed_money_to_payoff_debt_details,true);
        $temp_y_container = 47;
        foreach ($borrowed_money_to_payoff_debt_details_temp_container['company_debt_with'] as $key => $value) {
            $companyName = $borrowed_money_to_payoff_debt_details_temp_container['company_debt_with'][$key];
            $type  = $borrowed_money_to_payoff_debt_details_temp_container['is_credit_loan'][$key];
            $amount = $borrowed_money_to_payoff_debt_details_temp_container['how_much_owe'][$key];
            $dtBorrowed = $borrowed_money_to_payoff_debt_details_temp_container['when_borrowed'][$key];
            $dtPaid = $borrowed_money_to_payoff_debt_details_temp_container['when_paid'][$key];
            $this->writeToPdf($pdf,$tplIdx , 30 , $temp_y_container, $companyName);
            $this->writeToPdf($pdf,$tplIdx , 30 + 70, $temp_y_container, $type);
            $this->writeToPdf($pdf,$tplIdx , 30 + 100, $temp_y_container, $amount);
            $this->writeToPdf($pdf,$tplIdx , 30 +120, $temp_y_container, $dtBorrowed);
            $this->writeToPdf($pdf,$tplIdx , 30 +145, $temp_y_container, $dtPaid);
            $temp_y_container += 14.2;
        }

        if ($leadObj->ever_missed_payments === 'Yes') {
            $this->writeToPdf($pdf,$tplIdx ,  25.4 , 105.5, 'x');            
        } else if ($leadObj->ever_missed_payments === 'No') {
            $this->writeToPdf($pdf,$tplIdx ,  43 , 105.5, 'x');
        }
        $this->writeToPdf($pdf,$tplIdx ,  30 , 128, $leadObj->ever_missed_payments_explanation);
        
        /*page 13*/
        $pdf->addPage();
        $tplIdx = $pdf->importPage(13);
        $pdf->useTemplate($tplIdx, 0, 0, 0, 0, true);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(20, 20);

        switch ($leadObj->employment_status_during_ppi_payment_you) {
            case 'employed':
                $this->writeToPdf($pdf,$tplIdx ,  25 , 50, 'x');
                break;
            case 'self employed':
                $this->writeToPdf($pdf,$tplIdx ,  25 , 55.5, 'x');
                break;
            case 'temporary / agency worker':
                $this->writeToPdf($pdf,$tplIdx ,  25 , 50 + (5.8 * 2), 'x');
                break;
            case 'not working':
                $this->writeToPdf($pdf,$tplIdx ,  25 , 50 + (5.8 * 3), 'x');
                break;
            case 'retired':
                $this->writeToPdf($pdf,$tplIdx ,  25 , 50 + (5.9 * 4), 'x');
                break;
            case 'director of own company':
                $this->writeToPdf($pdf,$tplIdx ,  25 , 50 + (5.9 * 5), 'x');
                break;
            case 'student in full-time or part-time education':
                $this->writeToPdf($pdf,$tplIdx ,  25 , 50 + (5.9 * 6), 'x');
                break;
            case 'working fewer than 16 hours':
                $this->writeToPdf($pdf,$tplIdx ,  25 , 50 + (5.9 * 7), 'x');
                break;
            case 'not known':
                $this->writeToPdf($pdf,$tplIdx ,  25 , 50 + (5.9 * 8), 'x');
                break;
            case 'other':
                $this->writeToPdf($pdf,$tplIdx ,  25 , 50 + (5.9 * 9), 'x');
                break;
            default:
                break;
        }
        switch ($leadObj->employment_status_during_ppi_payment_partner) {
            case 'employed':
                $this->writeToPdf($pdf,$tplIdx ,  112 , 50, 'x');
                break;
            case 'self employed':
                $this->writeToPdf($pdf,$tplIdx ,  112 , 55.5, 'x');
                break;
            case 'temporary / agency worker':
                $this->writeToPdf($pdf,$tplIdx ,  112 , 50 + (5.8 * 2), 'x');
                break;
            case 'not working':
                $this->writeToPdf($pdf,$tplIdx ,  112 , 50 + (5.8 * 3), 'x');
                break;
            case 'retired':
                $this->writeToPdf($pdf,$tplIdx ,  112 , 50 + (5.9 * 4), 'x');
                break;
            case 'director of own company':
                $this->writeToPdf($pdf,$tplIdx ,  112 , 50 + (5.9 * 5), 'x');
                break;
            case 'student in full-time or part-time education':
                $this->writeToPdf($pdf,$tplIdx ,  112 , 50 + (5.9 * 6), 'x');
                break;
            case 'working fewer than 16 hours':
                $this->writeToPdf($pdf,$tplIdx ,  112 , 50 + (5.9 * 7), 'x');
                break;
            case 'not known':
               $this->writeToPdf($pdf,$tplIdx ,  112 , 50 + (5.9 * 8), 'x');
                break;
            case 'other':
                $this->writeToPdf($pdf,$tplIdx ,  112 , 50 + (5.9 * 9), 'x');
                break;
            default:
                break;
        }
        $this->writeToPdf($pdf,$tplIdx ,  28 , 155, $leadObj->employment_status_change_details);
        $this->writeToPdf($pdf,$tplIdx ,  55 , 215, $leadObj->type_of_work_ppi_you);
        $this->writeToPdf($pdf,$tplIdx ,  128 , 215, $leadObj->type_of_work_ppi_partner);
        $this->writeToPdf($pdf,$tplIdx ,  55 , 235, $leadObj->name_of_employer_you);
        $this->writeToPdf($pdf,$tplIdx ,  128 , 235, $leadObj->name_of_employer_partner);
        
        /*page 14*/
        $pdf->addPage();
        $tplIdx = $pdf->importPage(14);
        $pdf->useTemplate($tplIdx, 0, 0, 0, 0, true);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(20, 20);
        $this->writeToPdf($pdf,$tplIdx ,  27 , 38, $leadObj->how_long_been_working_years_you);
        $this->writeToPdf($pdf,$tplIdx ,  63 , 38, $leadObj->how_long_been_working_months_you);

        $this->writeToPdf($pdf,$tplIdx ,  115 , 38, $leadObj->how_long_been_working_years_partner);
        $this->writeToPdf($pdf,$tplIdx ,  150 , 38, $leadObj->how_long_been_working_months_partner);

        switch ($leadObj->would_you_still_receive_payment) {
            case 'Yes':
                    $this->writeToPdf($pdf,$tplIdx ,  25 , 72, 'x');
                break;
            case 'No':
                    $this->writeToPdf($pdf,$tplIdx ,  25 , 78, 'x');
                break;                
            case "Can't remember":
                    $this->writeToPdf($pdf,$tplIdx ,  25 , 84, 'x');
                break;
            case 'Not relevant':
                    $this->writeToPdf($pdf,$tplIdx ,  25 , 90, 'x');
                break;                
            default:
                break;
        }
        switch ($leadObj->would_partner_still_receive_payment) {
            case 'Yes':
                   $this->writeToPdf($pdf,$tplIdx ,  112 , 72, 'x');
                break;
            case 'No':
                    $this->writeToPdf($pdf,$tplIdx ,  112 , 78, 'x');
                break;                
            case "Can't remember":
                    $this->writeToPdf($pdf,$tplIdx ,  112 , 84, 'x');
                break;
            case 'Not relevant':
                    $this->writeToPdf($pdf,$tplIdx ,  112 , 90, 'x');
                break;                
            default:
                break;
        }

        switch ($leadObj->would_you_still_receive_payment_details) {
            case 'less than 3 months':
                $this->writeToPdf($pdf,$tplIdx ,  25.3 , 106.8, 'x');            
                break;
            case '3 months or more, but less than 6 months':
                $this->writeToPdf($pdf,$tplIdx ,  25.3 , 113, 'x');            
                break;
            case '6 months or more, but less than 12 months':
                $this->writeToPdf($pdf,$tplIdx ,  25.3 , 119, 'x');
                break;
            case '12 months or more':
                $this->writeToPdf($pdf,$tplIdx ,  25.3 , 125, 'x');
                break;
            case 'no pay (or statutory pay)':
                $this->writeToPdf($pdf,$tplIdx ,  25.3 , 131, 'x');
                break;
            case 'other (please tell us more below)':
            default:
                $this->writeToPdf($pdf,$tplIdx ,  25.3 , 137.5, 'x');
                $this->writeToPdf($pdf,$tplIdx ,  25.3 , 145, $leadObj->would_you_still_receive_payment_details);
                /*write x mark other and write full details*/
                break;
        }
        if ($leadObj->other_way_of_making_money_for_repayments_you === 'Yes') {
            $this->writeToPdf($pdf,$tplIdx ,  25.3 , 200.4, 'x');
        } else if ( $leadObj->other_way_of_making_money_for_repayments_you === 'No' ) {
            $this->writeToPdf($pdf,$tplIdx ,  25.3 + 19.5 , 200.4, 'x');
        }

        if ($leadObj->other_way_of_making_money_for_repayments_partner === 'Yes') {
            $this->writeToPdf($pdf,$tplIdx ,  25.3 + 87 , 200.4, 'x');
        } else if ( $leadObj->other_way_of_making_money_for_repayments_partner === 'No' ) {
           $this->writeToPdf($pdf,$tplIdx ,  25.3 + 106 , 200.4, 'x');
        }
        switch ($leadObj->other_way_of_making_money_for_repayments_you_details) {
            case 'from savings or insurance – worth less than 3 months of your pay':
                $this->writeToPdf($pdf,$tplIdx ,  25.3 , 216.5, 'x');            
                break;
            case 'from savings or insurance – worth 3 months or more, but less than 6 months of your pay':
                $this->writeToPdf($pdf,$tplIdx ,  25.3 , 223, 'x');
                break;
            case 'from savings or insurance – worth 6 months or more, but less than 12 months of your pay':
                $this->writeToPdf($pdf,$tplIdx ,  25.3 , 229, 'x');
                break;
            case 'from savings or insurance – worth 12 months or more of your pay':
                $this->writeToPdf($pdf,$tplIdx ,  25.3 , 235.5, 'x');
                break;
            case 'none':
                $this->writeToPdf($pdf,$tplIdx ,  25.3 , 242, 'x');
                break;
            case 'by some other means (please tell us more below)':
                $this->writeToPdf($pdf,$tplIdx ,  25.3 , 248, 'x');
                break;
            default:
                break;
        }

        /*page 15*/
        $pdf->addPage();
        $tplIdx = $pdf->importPage(15);
        $pdf->useTemplate($tplIdx, 0, 0, 0, 0, true);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(20, 20);
        if ($leadObj->has_health_problems_you === 'Yes') {
            $this->writeToPdf($pdf,$tplIdx ,  25.2 , 44.5, 'x');            
        }else if ($leadObj->has_health_problems_you === 'No') {
            $this->writeToPdf($pdf,$tplIdx ,  45 , 44.5, 'x');
        }
        if ($leadObj->has_health_problems_partner === 'Yes') {
            $this->writeToPdf($pdf,$tplIdx ,  112 , 44.5, 'x');
        } else if ($leadObj->has_health_problems_partner === 'No') {
            $this->writeToPdf($pdf,$tplIdx ,  131 , 44.5, 'x');
        }
        $this->writeToPdf($pdf,$tplIdx ,  26 , 60, $leadObj->has_health_problems_you_details);

        /*page 16*/
        $pdf->addPage();
        $tplIdx = $pdf->importPage(16);
        $pdf->useTemplate($tplIdx, 0, 0, 0, 0, true);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(20, 20);
        $this->writeToPdf($pdf,$tplIdx ,  20 , 87, $leadObj->what_happen_tookout_payment_protection);
        $this->writeToPdf($pdf,$tplIdx ,  20 , 205, $leadObj->reason_of_unhappiness_with_insurance);

        /*page 17*/
        $pdf->addPage();
        $tplIdx = $pdf->importPage(17);
        $pdf->useTemplate($tplIdx, 0, 0, 0, 0, true);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(20, 20);

        $fullName = sprintf("%s %s %s",$leadObj->salutation ,$leadObj->firstname , $leadObj->lastname);
        $this->writeToPdf($pdf,$tplIdx , 20 , 65 ,$fullName);

        $pdf->Image($leadObj->client_signature_image, 60, 55, 100,18);
        // /*day*/
        $this->writeToPdf($pdf,$tplIdx , 135, 68, date("d/m/Y",time())[0]);
        $this->writeToPdf($pdf,$tplIdx , 142.9, 68, date("d/m/Y",time())[1]);
        // /*month*/
        $this->writeToPdf($pdf,$tplIdx , 150.5, 68, date("d/m/Y",time())[3]);
        $this->writeToPdf($pdf,$tplIdx , 157, 68, date("d/m/Y",time())[4]);
        // /*year*/
        $this->writeToPdf($pdf,$tplIdx , 165, 68, date("d/m/Y",time())[6]);
        $this->writeToPdf($pdf,$tplIdx , 172, 68, date("d/m/Y",time())[7]);
        $this->writeToPdf($pdf,$tplIdx , 179, 68, date("d/m/Y",time())[8]);
        $this->writeToPdf($pdf,$tplIdx , 186, 68, date("d/m/Y",time())[9]);

        /*page 18*/
        $pdf->addPage();
        $tplIdx = $pdf->importPage(18);
        $pdf->useTemplate($tplIdx, 0, 0, 0, 0, true);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(20, 20);

        /*page 19*/        
        $pdf->addPage();
        $tplIdx = $pdf->importPage(19);
        $pdf->useTemplate($tplIdx, 0, 0, 0, 0, true);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(20, 20);
        $this->writeToPdf($pdf,$tplIdx , 53, 94, $leadObj->firstname);
        $this->writeToPdf($pdf,$tplIdx , 115, 94, $leadObj->salutation);
        $this->writeToPdf($pdf,$tplIdx , 53, 101, $leadObj->lastname);

        $this->writeToPdf($pdf,$tplIdx , 53, 117, $leadObj->date_of_birth);
        $this->writeToPdf($pdf,$tplIdx , 53, 125, $leadObj->address1);
        $this->writeToPdf($pdf,$tplIdx , 53, 125 + (5 * 1), $leadObj->address2);
        $this->writeToPdf($pdf,$tplIdx , 53, 125 + (5 * 2), $leadObj->address3);
        $this->writeToPdf($pdf,$tplIdx , 53, 125 + (5 * 3), $leadObj->address4);
        $this->writeToPdf($pdf,$tplIdx , 53, 125 + (5 * 4), $leadObj->address5);
        $this->writeToPdf($pdf,$tplIdx , 53, 125 + (5 * 5), $leadObj->postcode);

        $this->writeToPdf($pdf,$tplIdx , 53, 160 , $leadObj->daytime_phone);
        $this->writeToPdf($pdf,$tplIdx , 53, 167 , $leadObj->home_phone);
        $this->writeToPdf($pdf,$tplIdx , 150, 167 , $leadObj->email_address);
        $this->writeToPdf($pdf,$tplIdx , 150, 160 , $leadObj->mobile);

        $this->writeToPdf($pdf,$tplIdx , 53, 94 + 91, $leadObj->complaining_on_behalf_name . 'wee');
        $this->writeToPdf($pdf,$tplIdx , 165, 94+ 91, $leadObj->complaining_on_behalf_relationship);
        $this->writeToPdf($pdf,$tplIdx , 53, 94+ 100, 'Wheatfield House,');
        $this->writeToPdf($pdf,$tplIdx , 53, 94+ 110, 'Wheatfield Way,');
        $this->writeToPdf($pdf,$tplIdx , 53, 94+ 115, 'Hinckley, Leicestershire LE10 1YG');
        $this->writeToPdf($pdf,$tplIdx , 53, 94+ 130, $leadObj->complaining_on_behalf_daytime_phone);
        $this->writeToPdf($pdf,$tplIdx , 53, 94+ 137, $leadObj->complaining_on_behalf_email);
        $this->writeToPdf($pdf,$tplIdx , 140, 94+ 130, $leadObj->complaining_on_behalf_fax);
        $this->writeToPdf($pdf,$tplIdx , 140, 94+ 137, $leadObj->complaining_on_behalf_ref);

        $this->writeToPdf($pdf,$tplIdx , 53, 94+ 158, $leadObj->complaining_on_behalf_of_a_business_official_name.'1');
        $this->writeToPdf($pdf,$tplIdx , 180, 94+ 158, $leadObj->complaining_on_behalf_of_a_business_num_employees.'2');
        $this->writeToPdf($pdf,$tplIdx , 53, 94+ 170, $leadObj->complaining_on_behalf_of_a_business_num_partners.'3');
        $this->writeToPdf($pdf,$tplIdx , 183, 94+ 170.5, $leadObj->complaining_on_behalf_of_a_business_annual_income.'4');

         /*page 20*/
        $pdf->addPage();
        $tplIdx = $pdf->importPage(20);
        $pdf->useTemplate($tplIdx, 0, 0, 0, 0, true);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(20, 20);

        $this->writeToPdf($pdf,$tplIdx , 53, 23, $leadObj->company_details_responsible_on_complaint_name);
        $this->writeToPdf($pdf,$tplIdx , 53, 30, $leadObj->company_details_responsible_on_complaint_address);
        $this->writeToPdf($pdf,$tplIdx , 53, 55, $leadObj->company_details_responsible_on_complaint_phone);


        $this->writeToPdf($pdf,$tplIdx , 53, 23+57, $leadObj->adviser_who_sold_product_name);
        $this->writeToPdf($pdf,$tplIdx , 53, 30 + 57, $leadObj->adviser_who_sold_product_address);
        $this->writeToPdf($pdf,$tplIdx , 53, 55+57, $leadObj->adviser_who_sold_product_phone_number);

        $this->writeToPdf($pdf,$tplIdx , 53+4, 55+57+21, $leadObj->kind_of_service_complained);
        $this->writeToPdf($pdf,$tplIdx , 108, 147, $leadObj->kind_of_service_complained_reference_number);
        $this->writeToPdf($pdf,$tplIdx , 20, 180, $leadObj->full_complain_details.'details');

        if ($leadObj->when_did_transaction_take_place) {
            /*day*/
            $this->writeToPdf($pdf,$tplIdx , 160, 265, $leadObj->when_did_transaction_take_place[0] . $leadObj->when_did_transaction_take_place[1]);
            // /*month*/
            $this->writeToPdf($pdf,$tplIdx , 175, 265, $leadObj->when_did_transaction_take_place[3] . $leadObj->when_did_transaction_take_place[4]);
            // /*year*/
            $this->writeToPdf($pdf,$tplIdx , 190, 265, substr($leadObj->when_did_transaction_take_place, -4));
        }

        if ($leadObj->first_complain_took_place) {
            /*day*/
            $this->writeToPdf($pdf,$tplIdx , 160, 273 , $leadObj->first_complain_took_place[0] . $leadObj->first_complain_took_place[1]);
            // /*month*/
            $this->writeToPdf($pdf,$tplIdx , 175, 273, $leadObj->first_complain_took_place[3] . $leadObj->first_complain_took_place[4]);
            // /*year*/
            $this->writeToPdf($pdf,$tplIdx , 190, 273, substr($leadObj->first_complain_took_place, -4));
        }

        /*page 21*/
        $pdf->addPage();
        $tplIdx = $pdf->importPage(21);
        $pdf->useTemplate($tplIdx, 0, 0, 0, 0, true);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(20, 20);

        if ($leadObj->did_company_sent_message === 'Yes') {
            $this->writeToPdf($pdf,$tplIdx , 178.2, 21.6, "x"); 
        } else if ($leadObj->did_company_sent_message === 'No') {
            $this->writeToPdf($pdf,$tplIdx , 192, 21.6, "x");
        }

        if ($leadObj->any_court_action === "Yes") {
            $this->writeToPdf($pdf,$tplIdx , 178.2, 33, "x");            
        } else if ($leadObj->any_court_action === 'No') {
            $this->writeToPdf($pdf,$tplIdx , 192, 33, "x");
        }
        $this->writeToPdf($pdf,$tplIdx , 15, 55, $leadObj->settlement_details);

        if ($leadObj->has_accessibility_problem === 'Yes') {
            $this->writeToPdf($pdf,$tplIdx , 178.4, 82.5, 'x');
        } else if ($leadObj->has_accessibility_problem === 'No') {
            $this->writeToPdf($pdf,$tplIdx , 193.4, 82.5, 'x');
        }

        $this->writeToPdf($pdf,$tplIdx , 85, 190, date("d/m/Y",time()));
        $pdf->Image($leadObj->client_signature_image, 18, 180, 100,18);

        if (isset($this->destinationFile)) {
            $pdf->Output($this->destinationFile ,"F");
            $this->exportedFile = $this->destinationFile;
        }else {
            $pdf->Output('peek.pdf', 'I');
        }
    }
}