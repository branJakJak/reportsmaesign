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
        $this->writeToPdf($pdf,$tplIdx , 72 , 156  +4 ,$leadObj->amount_ppi . 'amount');
        $this->writeToPdf($pdf,$tplIdx , 72 , 160  +7 ,$leadObj->finance_start . 'amount');
        $this->writeToPdf($pdf,$tplIdx , 155 , 160  +7 ,$leadObj->finance_end . 'amount');
        $this->writeToPdf($pdf,$tplIdx , 72 , 181 +2,$leadObj->amount_ppi . 'amount');


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


        $this->writeToPdf($pdf,$tplIdx , 123 , 110, $leadObj->partner_detail_lastname .'1' );
        $this->writeToPdf($pdf,$tplIdx , 183 , 110, $leadObj->partner_detail_title .'2');
        $this->writeToPdf($pdf,$tplIdx , 123 , 118, $leadObj->partner_detail_firstname .'3');
        // /*date*/

        $this->writeToPdf($pdf,$tplIdx , 123 , 124, $leadObj->partner_detail_date_of_birth[0]);
        $this->writeToPdf($pdf,$tplIdx , 123+10 , 124, $leadObj->partner_detail_date_of_birth[1]);
        // // /*month*/
        $this->writeToPdf($pdf,$tplIdx , 123+19 , 124, $leadObj->partner_detail_date_of_birth[3]);
        $this->writeToPdf($pdf,$tplIdx , 123+29 , 124, $leadObj->partner_detail_date_of_birth[4]);
        // // /*year*/
        $this->writeToPdf($pdf,$tplIdx , 123+38 , 124, $leadObj->partner_detail_date_of_birth[6]);
        $this->writeToPdf($pdf,$tplIdx , 123+47 , 124, $leadObj->partner_detail_date_of_birth[7]);
        $this->writeToPdf($pdf,$tplIdx , 123+56 , 124, $leadObj->partner_detail_date_of_birth[8]);
        $this->writeToPdf($pdf,$tplIdx , 123+55+9 , 124, $leadObj->partner_detail_date_of_birth[9]);       

        $this->writeToPdf($pdf,$tplIdx , 41 , 145, $leadObj->address1);
        $this->writeToPdf($pdf,$tplIdx , 41 , 149, $leadObj->address2);
        $this->writeToPdf($pdf,$tplIdx , 41 , 153, $leadObj->address3);
        $this->writeToPdf($pdf,$tplIdx , 41 , 157, $leadObj->address4);
        $this->writeToPdf($pdf,$tplIdx , 41 , 161, $leadObj->address5.','.$leadObj->postcode);
        $this->writeToPdf($pdf,$tplIdx , 41 , 168, $leadObj->daytime_phone .'daytime');
        $this->writeToPdf($pdf,$tplIdx , 123 , 168, $leadObj->mobile .'mobile');
        $this->writeToPdf($pdf,$tplIdx , 41 , 176, $leadObj->home_phone .'home');
        $this->writeToPdf($pdf,$tplIdx , 123 , 176, $leadObj->email_address .'email');
        $this->writeToPdf($pdf,$tplIdx , 41 , 250, $leadObj->financial_business_name.'wee' );
        $this->writeToPdf($pdf,$tplIdx , 41 , 269, $leadObj->ppi_policy_number .'ewq');

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

        $ppi_claim_type_coor_x = 64;
        $ppi_claim_type_coor_y = 69;
        if ($leadObj->ppi_cover_type === "single") {
            $ppi_claim_type_coor_x = 26.5;
        }
        $this->writeToPdf($pdf,$tplIdx , $ppi_claim_type_coor_x , $ppi_claim_type_coor_y, "x");
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
        

        /*page 11*/
        $pdf->addPage();
        $tplIdx = $pdf->importPage(11);
        $pdf->useTemplate($tplIdx, 0, 0, 0, 0, true);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(20, 20);

 


        $this->writeToPdf($pdf,$tplIdx , 22.3 , 43.5 + (6 * 8), 'x');
        $this->writeToPdf($pdf,$tplIdx , 22.3 , 43.5 + (6 * 9) - .5, 'x');
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

        if (isset($this->destinationFile)) {
            $pdf->Output($this->destinationFile ,"F");
            $this->exportedFile = $this->destinationFile;
        }else {
            $pdf->Output('peek.pdf', 'I');
        }
    }
}