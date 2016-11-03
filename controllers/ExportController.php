<?php

namespace app\controllers;
use Yii;
use FPDI;
use app\models\LeadEsign;


class ExportController extends \yii\web\Controller
{
    /**
     * @param $pdf FPDI
     * @param $tplIdx
     * @param $x_coor
     * @param $y_coor
     * @param $val_to_write
     */
    private function writeToPdf($pdf,$tplIdx, $x_coor, $y_coor , $val_to_write)
    {
        $pdf->useTemplate($tplIdx, 0, 0, 0, 0, true);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY($x_coor, $y_coor);
        $pdf->Write(0, $val_to_write);

    }	
    public function actionIndex($securityKey)
    {
        /**
         * @var $leadObj LeadEsign
         */
        class_exists('TCPDF', true);        
        $leadObj = LeadEsign::find()->where(['security_key' => $securityKey])->one();
        $pdfTemplte = Yii::getAlias("@app/documentation/clean_pdf_template/PrintPack_65605.pdf");
        $pdf = new FPDI();
        $pdf->addPage();
        $pdf->SetFont("Helvetica",'',8);
        $pdf->setSourceFile($pdfTemplte); 

        /*page 1*/
        $tplIdx = $pdf->importPage(1);
        $this->writeToPdf($pdf,$tplIdx , 80 , 39 ,$leadObj->salutation);
        $this->writeToPdf($pdf,$tplIdx , 110 , 39 ,$leadObj->firstname);
        $this->writeToPdf($pdf,$tplIdx , 153 , 39 ,$leadObj->lastname);
        $this->writeToPdf($pdf,$tplIdx , 69 , 80 ,$leadObj->address1);
        $this->writeToPdf($pdf,$tplIdx , 69 , 86 ,$leadObj->address2);
        $this->writeToPdf($pdf,$tplIdx , 69 , 93 ,$leadObj->address3);
        $this->writeToPdf($pdf,$tplIdx , 69 , 100 ,$leadObj->address4);
        $this->writeToPdf($pdf,$tplIdx , 69 , 113 ,$leadObj->postcode);
        $this->writeToPdf($pdf,$tplIdx , 69 , 126 ,$leadObj->mobile);
        $this->writeToPdf($pdf,$tplIdx , 69 , 132 ,$leadObj->email_address);
        $this->writeToPdf($pdf,$tplIdx , 69 , 137 ,$leadObj->date_of_birth);
        $this->writeToPdf($pdf,$tplIdx , 69 , 143 ,$leadObj->account_provider);
        $this->writeToPdf($pdf,$tplIdx , 69 , 150  ,$leadObj->monthly_account_charge);
        $this->writeToPdf($pdf,$tplIdx , 72 , 156  ,date("d/m/Y",strtotime($leadObj->account_start_date)));
        $this->writeToPdf($pdf,$tplIdx , 160 , 156  ,date("d/m/Y",strtotime($leadObj->account_end_date)));
        $this->writeToPdf($pdf,$tplIdx , 60, 247 , date("d/m/Y",time()));
        $this->writeToPdf($pdf,$tplIdx , 130, 247 , date("d/m/Y",time()));
        // $this->writeToPdf($pdf,$tplIdx , 130, 430 , date("d/m/Y",time()) );
        $pdf->Image($leadObj->client_signature_image, 10, 230, 100,18);
        $pdf->Image($leadObj->client_signature_image, 120, 230, 100,18);

        /*page 2*/
        $pdf->addPage();
        $tplIdx = $pdf->importPage(2);
        $pdf->useTemplate($tplIdx, 0, 0, 0, 0, true); 
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(20, 20);

        /*page 3*/
        $pdf->addPage();
        $tplIdx = $pdf->importPage(3);
        $pdf->useTemplate($tplIdx, 0, 0, 0, 0, true); 
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(20, 20);

        $this->writeToPdf($pdf,$tplIdx , 30 , 191 ,$leadObj->salutation);
        $this->writeToPdf($pdf,$tplIdx , 65 , 191 ,$leadObj->firstname);
        $this->writeToPdf($pdf,$tplIdx , 38 , 197 ,$leadObj->lastname);
        $this->writeToPdf($pdf,$tplIdx , 44 , 204 ,$leadObj->date_of_birth);
        $fullAddress = sprintf(
                "%s %s %s %s" , 
                $leadObj->address1 ,
                $leadObj->address2 , 
                $leadObj->address3 ,
                $leadObj->address4
            );
        $this->writeToPdf($pdf,$tplIdx , 43 , 210 , $fullAddress);
        $this->writeToPdf($pdf,$tplIdx , 43 , 217 , $leadObj->postcode);
        $this->writeToPdf($pdf,$tplIdx , 115, 240 , date("d/m/Y",time()));
        $this->writeToPdf($pdf,$tplIdx , 30, 240 , date("d/m/Y",time()));
        $pdf->Image($leadObj->client_signature_image, 15, 225, 100,18);
        $pdf->Image($leadObj->client_signature_image, 123, 225, 100,18);

        /*page 4*/
        $pdf->addPage();
        $tplIdx = $pdf->importPage(4);
        $pdf->useTemplate($tplIdx, 0, 0, 0, 0, true); 
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(20, 20);
        /*company information*/
        $this->writeToPdf($pdf,$tplIdx , 28 , 48 ,Yii::$app->name);
        $this->writeToPdf($pdf,$tplIdx , 83 , 48 , $leadObj->security_key);
        $this->writeToPdf($pdf,$tplIdx , 143 , 48 , $leadObj->security_key );


        $this->writeToPdf($pdf,$tplIdx , 30 , 204 ,$leadObj->salutation);
        $this->writeToPdf($pdf,$tplIdx , 70 , 204 ,$leadObj->firstname);
        $this->writeToPdf($pdf,$tplIdx , 38 , 210 ,$leadObj->lastname);
        $fullAddress = sprintf(
                "%s %s %s %s" , 
                $leadObj->address1 ,
                $leadObj->address2 , 
                $leadObj->address3 ,
                $leadObj->address4
            );
        $this->writeToPdf($pdf,$tplIdx , 34 , 224 , $fullAddress);
        $this->writeToPdf($pdf,$tplIdx , 38 , 230 , $leadObj->postcode);
        $this->writeToPdf($pdf,$tplIdx , 43 , 217 ,$leadObj->date_of_birth);
        $this->writeToPdf($pdf,$tplIdx , 115, 247 , date("d/m/Y",time()));
        $this->writeToPdf($pdf,$tplIdx , 30, 247 , date("d/m/Y",time()));
        $pdf->Image($leadObj->client_signature_image, 15, 233, 100,18);
        $pdf->Image($leadObj->client_signature_image, 123, 233, 100,18);


        /*page 5*/
        $pdf->addPage();
        $tplIdx = $pdf->importPage(5);
        $pdf->useTemplate($tplIdx, 0, 0, 0, 0, true); 
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(20, 20);
        
        /*company information*/
        $this->writeToPdf($pdf,$tplIdx , 28 , 48 ,Yii::$app->name);
        $this->writeToPdf($pdf,$tplIdx , 83 , 48 , $leadObj->security_key);
        $this->writeToPdf($pdf,$tplIdx , 143 , 48 , $leadObj->security_key );


        $this->writeToPdf($pdf,$tplIdx , 30 , 204 ,$leadObj->salutation);
        $this->writeToPdf($pdf,$tplIdx , 70 , 204 ,$leadObj->firstname);
        $this->writeToPdf($pdf,$tplIdx , 38 , 210 ,$leadObj->lastname);
        $fullAddress = sprintf(
                "%s %s %s %s" , 
                $leadObj->address1 ,
                $leadObj->address2 , 
                $leadObj->address3 ,
                $leadObj->address4
            );
        $this->writeToPdf($pdf,$tplIdx , 34 , 224 , $fullAddress);
        $this->writeToPdf($pdf,$tplIdx , 38 , 230 , $leadObj->postcode);
        $this->writeToPdf($pdf,$tplIdx , 43 , 217 ,$leadObj->date_of_birth);
        $this->writeToPdf($pdf,$tplIdx , 115, 247 , date("d/m/Y",time()));
        $this->writeToPdf($pdf,$tplIdx , 30, 247 , date("d/m/Y",time()));
        $pdf->Image($leadObj->client_signature_image, 15, 233, 100,18);
        $pdf->Image($leadObj->client_signature_image, 123, 233, 100,18);

        /*page 6*/
        $pdf->addPage();
        $tplIdx = $pdf->importPage(6);
        $pdf->useTemplate($tplIdx, 0, 0, 0, 0, true);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(20, 20);

        $checkMarkCoor_x = 0;
        if ( $leadObj->account_type === "Joint" ) {
            /*place the x at the yes checkbox*/
            $checkMarkCoor_x = 17;
        }else {
            $checkMarkCoor_x = 36;
        }
        $this->writeToPdf($pdf,$tplIdx , $checkMarkCoor_x , 179 ,"x");
        $this->writeToPdf($pdf,$tplIdx , 38 , 208 ,$leadObj->lastname);
        $this->writeToPdf($pdf,$tplIdx , 38 , 220 ,$leadObj->firstname);
        $this->writeToPdf($pdf,$tplIdx , 38 , 230 , $leadObj->postcode);
        $dateArr = explode("-", $leadObj->date_of_birth);
        $year= $dateArr[0];
        $month= $dateArr[1];
        $date= $dateArr[2];
        /*date*/

        $this->writeToPdf($pdf,$tplIdx , 39 , 245 , sprintf("%02d", $date)[0]);
        $this->writeToPdf($pdf,$tplIdx , 47 , 245 , sprintf("%02d", $date)[1]);
        /*month*/
        $this->writeToPdf($pdf,$tplIdx , 58 , 245 , sprintf("%02d", $month)[0]);
        $this->writeToPdf($pdf,$tplIdx , 66 , 245 , sprintf("%02d", $month)[1]);
        /*year*/
        $this->writeToPdf($pdf,$tplIdx , 76 , 245 , sprintf("%02d", $year)[0]);
        $this->writeToPdf($pdf,$tplIdx , 85 , 245 , sprintf("%02d", $year)[1]);
        $this->writeToPdf($pdf,$tplIdx , 91 , 245 , sprintf("%02d", $year)[2]);
        $this->writeToPdf($pdf,$tplIdx , 100 , 245 , sprintf("%02d", $year)[3]);

        /*page 7*/
        $pdf->addPage();
        $tplIdx = $pdf->importPage(7);
        $pdf->useTemplate($tplIdx, 0, 0, 0, 0, true);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(20, 20);
        $howWasPackageSold_coor_x = 0;
        $howWasPackageSold_coor_y = 0;
        switch ($leadObj->how_packaged_bank_account_sold) {
            case 'During a meeting':
                $howWasPackageSold_coor_x = 18.5;
                $howWasPackageSold_coor_y = 227;
                break;
            case 'Over the phone':
                $howWasPackageSold_coor_x = 56;
                $howWasPackageSold_coor_y = 227;
                break;
            case 'Over the internet':
                $howWasPackageSold_coor_x = 88;
                $howWasPackageSold_coor_y = 227;
                break;
            case 'By post':
                $howWasPackageSold_coor_x = 122;
                $howWasPackageSold_coor_y = 227;
                break;
            case 'I filled in a leaflet':
                $howWasPackageSold_coor_x = 18.5;
                $howWasPackageSold_coor_y = 240.5;
                break;
            case 'Can\'t remember':
                $howWasPackageSold_coor_x = 88;
                $howWasPackageSold_coor_y = 240.5;
                break;
            case 'Over the counter':
                $howWasPackageSold_coor_x = 56;
                $howWasPackageSold_coor_y = 240.5;
                break;
            default:
                $howWasPackageSold_coor_x = 122;
                $howWasPackageSold_coor_y = 240.5;
                break;
        }
        $this->writeToPdf($pdf,$tplIdx , $howWasPackageSold_coor_x , $howWasPackageSold_coor_y ,"x");



       /*page 8*/
        $pdf->addPage();
        $tplIdx = $pdf->importPage(8);
        $pdf->useTemplate($tplIdx, 0, 0, 0, 0, true);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(20, 20);

        if ($leadObj->how_packaged_bank_account_sold === "Other") {
            $this->writeToPdf($pdf,$tplIdx , 18 , 30 ,$leadObj->how_packaged_bank_account_sold);
        }
        $did_they_give_advice_clarify_coor_x = 0;
        $did_they_give_advice_clarify_coor_y = 0;
        switch ($leadObj->discuss_not_involed_packaged) {
            case 'Yes':
                $did_they_give_advice_clarify_coor_x = 19.2;
                $did_they_give_advice_clarify_coor_y = 69.5;                
                /*write the reason*/
                $this->writeToPdf($pdf,$tplIdx , 18, 88 ,$leadObj->discuss_not_involed_packaged_details);
                break;
            case 'No':
                $did_they_give_advice_clarify_coor_x = 38;
                $did_they_give_advice_clarify_coor_y = 69.5;
                break;
            case "Can't Remember":
                $did_they_give_advice_clarify_coor_x = 54.2;
                $did_they_give_advice_clarify_coor_y = 69.5;
                break;            
            default:
                break;
        }
        $this->writeToPdf(
            $pdf,
            $tplIdx , 
            $did_they_give_advice_clarify_coor_x,
            $did_they_give_advice_clarify_coor_y,
            "x"
        );

        $had_free_bank_coor_x = 0;
        $had_free_bank_coor_y = 0;
        if ($leadObj->had_free_bank === "Yes") {
            $had_free_bank_coor_x = 17;
            $had_free_bank_coor_y = 256;
        } else {
            $had_free_bank_coor_x = 35.5;
            $had_free_bank_coor_y = 256;
        }
        $this->writeToPdf(
            $pdf,
            $tplIdx , 
            $had_free_bank_coor_x,
            $had_free_bank_coor_y,
            "x"
        );

        /*page 9*/
        $pdf->addPage();
        $tplIdx = $pdf->importPage(9);
        $pdf->useTemplate($tplIdx, 0, 0, 0, 0, true);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(20, 20); 
        $when_opened_account_has_other_account_coor_x = 35;
        $when_opened_account_has_other_account_coor_y = 39;
        if ($leadObj->when_opened_account_has_other_account === "Yes") {
            $when_opened_account_has_other_account_coor_x = 17.5;
            $when_opened_account_has_other_account_coor_y = 39;
        }
        $this->writeToPdf(
            $pdf,
            $tplIdx, 
            $when_opened_account_has_other_account_coor_x,
            $when_opened_account_has_other_account_coor_y,
            "x"
        );
        if ($leadObj->when_opened_account_has_other_account === "Yes") {
            $this->writeToPdf($pdf,$tplIdx, 17.5,60,$leadObj->when_opened_account_has_other_account_details);
        }

        /*driving license*/
        $has_uk_driving_license_during_upgrade_coor_x = 35;
        $has_uk_driving_license_during_upgrade_coor_y = 138;
        if ($leadObj->has_uk_driving_license_during_upgrade === "Yes") {
            $has_uk_driving_license_during_upgrade_coor_x = 17.5;
            $has_uk_driving_license_during_upgrade_coor_y = 138;
        }
        $this->writeToPdf(
            $pdf,
            $tplIdx, 
            $has_uk_driving_license_during_upgrade_coor_x,
            $has_uk_driving_license_during_upgrade_coor_y,
            "x"
        );

        $has_mobile_phone_during_upgrade_coor_x = 35;
        $has_mobile_phone_during_upgrade_coor_y = 184;
        if ( $leadObj->has_mobile_phone_during_upgrade  === "Yes" ) {
            $has_mobile_phone_during_upgrade_coor_x = 17.5;
            $has_mobile_phone_during_upgrade_coor_y = 184;
        }
        $this->writeToPdf(
            $pdf,
            $tplIdx, 
            $has_mobile_phone_during_upgrade_coor_x,
            $has_mobile_phone_during_upgrade_coor_y,
            "x"
        );
        $has_mobile_phone_during_upgrade_has_internet_connection_coor_x = 35;
        $has_mobile_phone_during_upgrade_has_internet_connection_coor_y = 206;
        if ( $leadObj->has_mobile_phone_during_upgrade_has_internet_connection  === "Yes" ) {
            $has_mobile_phone_during_upgrade_has_internet_connection_coor_x = 17.5;
            $has_mobile_phone_during_upgrade_has_internet_connection_coor_y = 206;
        }
        $this->writeToPdf(
            $pdf,
            $tplIdx, 
            $has_mobile_phone_during_upgrade_has_internet_connection_coor_x,
            $has_mobile_phone_during_upgrade_has_internet_connection_coor_y,
            "x"
        );        
        /* in Europe*/
        $often_go_holiday_in_europe_coor_x = 0;
        $often_go_holiday_in_europe_coor_y = 0;
        switch ($leadObj->often_go_holiday_in_europe) {
            case 'Never':
                $often_go_holiday_in_europe_coor_x = 81;
                $often_go_holiday_in_europe_coor_y = 244;
                break;
            case '1-3 times a year':
                $often_go_holiday_in_europe_coor_x = 124;
                $often_go_holiday_in_europe_coor_y = 244;
                break;
            case '3+ times a year':
                $often_go_holiday_in_europe_coor_x = 168;
                $often_go_holiday_in_europe_coor_y = 244;
                break;
            default:
                break;
        }
        if ($often_go_holiday_in_europe_coor_x !== 0 && $often_go_holiday_in_europe_coor_x !== 0) {
            $this->writeToPdf(
                $pdf,
                $tplIdx,
                $often_go_holiday_in_europe_coor_x,
                $often_go_holiday_in_europe_coor_y,
                "x"
            );
        }

        /* outside Europe */
        $often_go_holiday_outside_europe_coor_x = 0;
        $often_go_holiday_outside_europe_coor_y = 0;
        switch ($leadObj->often_go_holiday_outside_europe) {
            case 'Never':
                $often_go_holiday_outside_europe_coor_x = 81;
                $often_go_holiday_outside_europe_coor_y = 250;
                break;
            case '1-3 times a year':
                $often_go_holiday_outside_europe_coor_x = 124;
                $often_go_holiday_outside_europe_coor_y = 250;
                break;
            case '3+ times a year':
                $often_go_holiday_outside_europe_coor_x = 168;
                $often_go_holiday_outside_europe_coor_y = 250;
                break;
            default:
                break;
        }
        if ($often_go_holiday_outside_europe_coor_x !== 0 && $often_go_holiday_outside_europe_coor_y !== 0) {
            $this->writeToPdf(
                $pdf,
                $tplIdx,
                $often_go_holiday_outside_europe_coor_x,
                $often_go_holiday_outside_europe_coor_y,
                "x"
            );
        }

        /* did winter sports */
        $often_go_holiday_and_winter_sports_coor_x = 0;
        $often_go_holiday_and_winter_sports_coor_y = 0;
        switch ($leadObj->often_go_holiday_and_winter_sports) {
            case 'Never':
                $often_go_holiday_and_winter_sports_coor_x = 81;
                $often_go_holiday_and_winter_sports_coor_y = 256.5;
                break;
            case '1-3 times a year':
                $often_go_holiday_and_winter_sports_coor_x = 124;
                $often_go_holiday_and_winter_sports_coor_y = 256.5;
                break;
            case '3+ times a year':
                $often_go_holiday_and_winter_sports_coor_x = 168;
                $often_go_holiday_and_winter_sports_coor_y = 256.5;
                break;
            default:
                break;
        }
        if ($often_go_holiday_and_winter_sports_coor_x !== 0 && $often_go_holiday_and_winter_sports_coor_y !== 0) {
            $this->writeToPdf(
                $pdf,
                $tplIdx,
                $often_go_holiday_and_winter_sports_coor_x,
                $often_go_holiday_and_winter_sports_coor_y,
                "x"
            );
        }

        /*page 10*/
        $pdf->addPage();
        $tplIdx = $pdf->importPage(10);
        $pdf->useTemplate($tplIdx, 0, 0, 0, 0, true);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(20, 20); 

        $has_health_problems_during_upgrade_coor_x = 35.8;
        $has_health_problems_during_upgrade_coor_y = 28.8;
        if ($leadObj->has_health_problems_during_upgrade === "Yes") {
            $has_health_problems_during_upgrade_coor_x = 17;
            $has_health_problems_during_upgrade_coor_y = 28.8;
            $this->writeToPdf(
                $pdf,
                $tplIdx,
                17,
                52,
                $leadObj->has_health_problems_during_upgrade_details
            );
        }
        $this->writeToPdf(
            $pdf,
            $tplIdx,
            $has_health_problems_during_upgrade_coor_x,
            $has_health_problems_during_upgrade_coor_y,
            "x"
        );

        $has_registered_doctor_during_upgrade_coor_x = 35.5;
        $has_registered_doctor_during_upgrade_coor_y = 101.5;
        if ($leadObj->has_registered_doctor_during_upgrade === "Yes") {
            $has_registered_doctor_during_upgrade_coor_x = 17;
            $has_registered_doctor_during_upgrade_coor_y = 101;
        }
        $this->writeToPdf(
            $pdf,
            $tplIdx,
            $has_registered_doctor_during_upgrade_coor_x,
            $has_registered_doctor_during_upgrade_coor_y,
            "x"
        );

        $used_benefits_packaged_bank_coor_x = 36;
        $used_benefits_packaged_bank_coor_y = 248;
        if ($leadObj->used_benefits_packaged_bank === "Yes") {
            $used_benefits_packaged_bank_coor_x = 18;
            $used_benefits_packaged_bank_coor_y = 248;
        }
        $this->writeToPdf(
            $pdf,
            $tplIdx,
            $used_benefits_packaged_bank_coor_x,
            $used_benefits_packaged_bank_coor_y,
            "x"
        );

        /*page 11*/
        $pdf->addPage();
        $tplIdx = $pdf->importPage(11);
        $pdf->useTemplate($tplIdx, 0, 0, 0, 0, true);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(20, 20); 

        /*page 12*/
        $pdf->addPage();
        $tplIdx = $pdf->importPage(12);
        $pdf->useTemplate($tplIdx, 0, 0, 0, 0, true);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(20, 20); 

        $after_upgrade_already_has_products_arr = explode(",", $leadObj->after_upgrade_already_has_products);

        foreach ($after_upgrade_already_has_products_arr as $currentVal) {
            switch ($currentVal) {
                case "Car breakdown cover":
                    //car breakdown cover
                    $this->writeToPdf($pdf,$tplIdx,16.8,75,"x");
                    break;
                case "Accidental death cover":
                    //accidental death cover
                    $this->writeToPdf($pdf,$tplIdx,16.8,86,"x");
                    break;
                case "Gadget insurance":
                    //gadget insurance 
                    $this->writeToPdf($pdf,$tplIdx,16.8,97,"x");
                    break;
                case "Mobile phone insurance":
                    //mobile phone insurance
                    $this->writeToPdf($pdf,$tplIdx,62,75,"x");
                    break;
                case "Life Assurance":
                    //life assurance
                    $this->writeToPdf($pdf,$tplIdx,62,86,"x");
                    break;
                case "Travel insurance":
                    //any other insurance that was also included in your packaged bank account
                    $this->writeToPdf($pdf,$tplIdx,62,97,"x");
                    break;
                case "Identity theft insurance":
                    // travel insurance
                    $this->writeToPdf($pdf,$tplIdx,131,75,"x");
                    break;
                case "Any other insurance that was also included in your packaged bank account":
                    // identity theft protection
                    $this->writeToPdf($pdf,$tplIdx,131,86,"x");
                    break;
                default:
                    break;
            }
        }
        $did_kept_insurance_after_sale_coor_x = 36;
        $did_kept_insurance_after_sale_coor_y = 182;
        if ($leadObj->did_kept_insurance_after_sale === "Yes") {
            $did_kept_insurance_after_sale_coor_x = 18;
            $did_kept_insurance_after_sale_coor_y = 182;
            $this->writeToPdf($pdf,$tplIdx,18,205,$leadObj->did_kept_insurance_after_sale_details);
        }
        $this->writeToPdf($pdf,$tplIdx,$did_kept_insurance_after_sale_coor_x,$did_kept_insurance_after_sale_coor_y,"x");

        /*page 13*/
        $pdf->addPage();
        $tplIdx = $pdf->importPage(13);
        $pdf->useTemplate($tplIdx, 0, 0, 0, 0, true);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(20, 20); 

        /*page 14*/
        $pdf->addPage();
        $tplIdx = $pdf->importPage(14);
        $pdf->useTemplate($tplIdx, 0, 0, 0, 0, true);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(20, 20); 


        /*page 15*/
        $pdf->addPage();
        $tplIdx = $pdf->importPage(15);
        $pdf->useTemplate($tplIdx, 0, 0, 0, 0, true);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(20, 20); 
        /*name and signature*/
        $fullname = "$leadObj->salutation . $leadObj->firstname $leadObj->lastname";
        $this->writeToPdf($pdf,$tplIdx , 20 , 88 ,$fullname);
        $pdf->Image($leadObj->client_signature_image, 50, 78, 100,18);
        /*page 16*/
        $pdf->addPage();
        $tplIdx = $pdf->importPage(16);
        $pdf->useTemplate($tplIdx, 0, 0, 0, 0, true);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(20, 20); 
        /*page 17*/
        $pdf->addPage();
        $tplIdx = $pdf->importPage(17);
        $pdf->useTemplate($tplIdx, 0, 0, 0, 0, true);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(20, 20); 



        $pdf->Output('gift_coupon_generated.pdf', 'I');
        Yii::$app->end();
    }

}
