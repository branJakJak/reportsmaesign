<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 1/5/17
 * Time: 10:55 PM
 */

namespace app\components;

use app\models\LeadEsign;
use FPDI;
use Yii;

class PPIAffiliatePdfEsign extends PdfEsign{
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
        $this->writeToPdf($pdf,$tplIdx , 170 , 22 ,$leadObj->security_key);
        $this->writeToPdf($pdf,$tplIdx , 80 , 39  +3,$leadObj->salutation);
        $this->writeToPdf($pdf,$tplIdx , 110 , 39  +3,$leadObj->firstname);
        $this->writeToPdf($pdf,$tplIdx , 153 , 39  +3,$leadObj->lastname);
        $this->writeToPdf($pdf,$tplIdx , 69 , 80  +1.5,$leadObj->address1);
        $this->writeToPdf($pdf,$tplIdx , 69 , 86  +1.5,$leadObj->address2);
        $this->writeToPdf($pdf,$tplIdx , 69 , 93  +1.5,$leadObj->address3);
        $this->writeToPdf($pdf,$tplIdx , 69 , 100  +1.5,$leadObj->address4);
        $this->writeToPdf($pdf,$tplIdx , 69 , 113  +1,$leadObj->postcode);
        $this->writeToPdf($pdf,$tplIdx , 69 , 106  +2,"United Kingdom");
        $this->writeToPdf($pdf,$tplIdx , 69 , 126  +1,$leadObj->mobile);
        $this->writeToPdf($pdf,$tplIdx , 69 , 132  +1.5,$leadObj->email_address);
        $this->writeToPdf($pdf,$tplIdx , 69 , 137  +2,$leadObj->date_of_birth);
        $this->writeToPdf($pdf,$tplIdx , 69 , 143  +2,$leadObj->account_provider);
        $this->writeToPdf($pdf,$tplIdx , 69 , 150  +33 ,$leadObj->monthly_account_charge);
        $this->writeToPdf($pdf,$tplIdx , 72 , 156  +11 ,date("d/m/Y",strtotime($leadObj->account_start_date)));
        $this->writeToPdf($pdf,$tplIdx , 160 , 156   +11,date("d/m/Y",strtotime($leadObj->account_end_date)));

        // $this->writeToPdf($pdf,$tplIdx , 73, 179 +5 , $leadObj->security_key);

        $this->writeToPdf($pdf,$tplIdx , 60, 270, date("d/m/Y",time()));
        $pdf->Image($leadObj->client_signature_image, 23, 253, 100,18);

        /*page 2*/
        $pdf->addPage();
        $tplIdx = $pdf->importPage(2);
        $pdf->useTemplate($tplIdx, 0, 0, 0, 0, true);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(20, 20);
        $this->writeToPdf($pdf,$tplIdx , 130 , 11 ,$leadObj->security_key);


        /*page 3*/
        $pdf->addPage();
        $tplIdx = $pdf->importPage(3);
        $pdf->useTemplate($tplIdx, 0, 0, 0, 0, true);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(20, 20);

        $this->writeToPdf($pdf,$tplIdx , 130 , 11 ,$leadObj->security_key);

        $fullname = sprintf("%s %s %s",$leadObj->salutation,$leadObj->firstname,$leadObj->lastname);
        $this->writeToPdf($pdf,$tplIdx , 35 , 210 +22 ,$fullname);
        $fullAddress = sprintf(
            "%s %s %s %s" ,
            $leadObj->address1 ,
            $leadObj->address2 ,
            $leadObj->address3 ,
            $leadObj->address4
        );
        $this->writeToPdf($pdf,$tplIdx , 35 , 220+22 , $fullAddress);
        $this->writeToPdf($pdf,$tplIdx , 150 , 225+17 , $leadObj->postcode);

        $this->writeToPdf($pdf,$tplIdx , 30, 243 +24, date("d/m/Y",time()));
        $pdf->Image($leadObj->client_signature_image, 25, 230 +16, 100,18);

        /*page 4*/
        $pdf->addPage();
        $tplIdx = $pdf->importPage(4);
        $pdf->useTemplate($tplIdx, 0, 0, 0, 0, true);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(20, 20);

        $this->writeToPdf($pdf,$tplIdx , 28  +10, 48+10 ,Yii::$app->name);
        $this->writeToPdf($pdf,$tplIdx , 143+10 , 48 +10, $leadObj->security_key );       

        $this->writeToPdf($pdf,$tplIdx , 30 , 204  +15,$leadObj->salutation);
        $this->writeToPdf($pdf,$tplIdx , 70 , 204   +15,$leadObj->firstname);
        $this->writeToPdf($pdf,$tplIdx , 38 , 210   +16,$leadObj->lastname);
        $fullAddress = sprintf(
            "%s %s %s %s" ,
            $leadObj->address1 ,
            $leadObj->address2 ,
            $leadObj->address3 ,
            $leadObj->address4
        );
        $this->writeToPdf($pdf,$tplIdx , 38 , 224   +15, $fullAddress);
        $this->writeToPdf($pdf,$tplIdx , 38 , 230   +22, $leadObj->postcode);
        $this->writeToPdf($pdf,$tplIdx , 43 , 217   +15,$leadObj->date_of_birth);
        $this->writeToPdf($pdf,$tplIdx , 30, 247  +24, date("d/m/Y",time()));
        // $this->writeToPdf($pdf,$tplIdx , 30, 247 , date("d/m/Y",time()));
        $pdf->Image($leadObj->client_signature_image, 23, 232 +20, 100,18);


        /*page 5*/
        $pdf->addPage();
        $tplIdx = $pdf->importPage(5);
        $pdf->useTemplate($tplIdx, 0, 0, 0, 0, true);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(20, 20);

 
        $this->writeToPdf($pdf,$tplIdx , 28  +10, 48+16 ,Yii::$app->name);
        $this->writeToPdf($pdf,$tplIdx , 143+10 , 48 +16, $leadObj->security_key );

        $this->writeToPdf($pdf,$tplIdx , 30 , 204 +17 ,$leadObj->salutation);
        $this->writeToPdf($pdf,$tplIdx , 70 , 204 +17 ,$leadObj->firstname);
        $this->writeToPdf($pdf,$tplIdx , 38 , 210  +17,$leadObj->lastname);
        $fullAddress = sprintf(
            "%s %s %s %s" ,
            $leadObj->address1 ,
            $leadObj->address2 ,
            $leadObj->address3 ,
            $leadObj->address4
        );
        $this->writeToPdf($pdf,$tplIdx , 35 , 224  +17, $fullAddress);
        $this->writeToPdf($pdf,$tplIdx , 38 , 230  +22, $leadObj->postcode);
        $this->writeToPdf($pdf,$tplIdx , 43 , 217  +17,$leadObj->date_of_birth);
        $this->writeToPdf($pdf,$tplIdx , 34, 247  +26, date("d/m/Y",time()));
        // $this->writeToPdf($pdf,$tplIdx , 30, 247 , date("d/m/Y",time()));
        $pdf->Image($leadObj->client_signature_image, 20, 232 + 23, 100,18);
        // $pdf->Image($leadObj->client_signature_image, 123, 233, 100,18);

        /*page 6*/
        $pdf->addPage();
        $tplIdx = $pdf->importPage(6);
        $pdf->useTemplate($tplIdx, 0, 0, 0, 0, true);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(20, 20);

        $this->writeToPdf($pdf,$tplIdx , 28  +10, 48+16 ,Yii::$app->name);
        $this->writeToPdf($pdf,$tplIdx , 143+10 , 48 +16, $leadObj->security_key );

        $this->writeToPdf($pdf,$tplIdx , 30 , 204 +17 ,$leadObj->salutation);
        $this->writeToPdf($pdf,$tplIdx , 70 , 204 +17 ,$leadObj->firstname);
        $this->writeToPdf($pdf,$tplIdx , 38 , 210  +18,$leadObj->lastname);
        $fullAddress = sprintf(
            "%s %s %s %s" ,
            $leadObj->address1 ,
            $leadObj->address2 ,
            $leadObj->address3 ,
            $leadObj->address4
        );
        $this->writeToPdf($pdf,$tplIdx , 43 , 217  +17,$leadObj->date_of_birth);
        $this->writeToPdf($pdf,$tplIdx , 35 , 224  +16, $fullAddress);
        $this->writeToPdf($pdf,$tplIdx , 38 , 230  +24, $leadObj->postcode);
        $this->writeToPdf($pdf,$tplIdx , 34, 247  +26, date("d/m/Y",time()));
        // $this->writeToPdf($pdf,$tplIdx , 30, 247 , date("d/m/Y",time()));
        $pdf->Image($leadObj->client_signature_image, 20, 232 + 23, 100,18);
        // $pdf->Image($leadObj->client_signature_image, 123, 233, 100,18);        

        /*page 7*/
        $pdf->addPage();
        $tplIdx = $pdf->importPage(7);
        $pdf->useTemplate($tplIdx, 0, 0, 0, 0, true);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(20, 20);

        $this->writeToPdf($pdf,$tplIdx , 28  +10, 48+16 ,Yii::$app->name);
        $this->writeToPdf($pdf,$tplIdx , 143+10 , 48 +16, $leadObj->security_key );

        $this->writeToPdf($pdf,$tplIdx , 30 , 204 +17 ,$leadObj->salutation);
        $this->writeToPdf($pdf,$tplIdx , 70 , 204 +17 ,$leadObj->firstname);
        $this->writeToPdf($pdf,$tplIdx , 38 , 210  +18,$leadObj->lastname);
        $fullAddress = sprintf(
            "%s %s %s %s" ,
            $leadObj->address1 ,
            $leadObj->address2 ,
            $leadObj->address3 ,
            $leadObj->address4
        );
        $this->writeToPdf($pdf,$tplIdx , 43 , 217  +17,$leadObj->date_of_birth);
        $this->writeToPdf($pdf,$tplIdx , 35 , 224  +16, $fullAddress);
        $this->writeToPdf($pdf,$tplIdx , 38 , 230  +24, $leadObj->postcode);
        $this->writeToPdf($pdf,$tplIdx , 34, 247  +26, date("d/m/Y",time()));
        // $this->writeToPdf($pdf,$tplIdx , 30, 247 , date("d/m/Y",time()));
        $pdf->Image($leadObj->client_signature_image, 20, 232 + 23, 100,18);

        /*page 8*/
        $pdf->addPage();
        $tplIdx = $pdf->importPage(8);
        $pdf->useTemplate($tplIdx, 0, 0, 0, 0, true);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(20, 20);

        $this->writeToPdf($pdf,$tplIdx , 105 , 110  ,$leadObj->salutation);
        $this->writeToPdf($pdf,$tplIdx , 40 , 110 ,$leadObj->lastname);
        $this->writeToPdf($pdf,$tplIdx , 40 , 117 ,$leadObj->firstname);

        $this->writeToPdf($pdf,$tplIdx , 40 , 124  ,$leadObj->date_of_birth[0]);
        $this->writeToPdf($pdf,$tplIdx , 50 , 124  ,$leadObj->date_of_birth[1]);
        $this->writeToPdf($pdf,$tplIdx , 60 , 124  ,$leadObj->date_of_birth[3]);
        $this->writeToPdf($pdf,$tplIdx , 70 , 124  ,$leadObj->date_of_birth[4]);

        $this->writeToPdf($pdf,$tplIdx , 80 , 124  ,$leadObj->date_of_birth[6]);
        $this->writeToPdf($pdf,$tplIdx , 90 , 124  ,$leadObj->date_of_birth[7]);
        $this->writeToPdf($pdf,$tplIdx , 98 , 124  ,$leadObj->date_of_birth[8]);
        $this->writeToPdf($pdf,$tplIdx , 107 , 124  ,$leadObj->date_of_birth[9]);
        $completeAddress = sprintf("%s %s %s %s %s",$leadObj->postcode , $leadObj->address1,$leadObj->address2,$leadObj->address3,$leadObj->address4);
        $this->writeToPdf($pdf,$tplIdx , 40 , 148  ,$completeAddress);

        $this->writeToPdf($pdf,$tplIdx , 40 , 169  ,$leadObj->mobile);
        $this->writeToPdf($pdf,$tplIdx , 124 , 169  ,$leadObj->mobile);
        $this->writeToPdf($pdf,$tplIdx , 40 , 175  ,$leadObj->mobile);
        $this->writeToPdf($pdf,$tplIdx , 124 , 175  ,$leadObj->email_address);

        $this->writeToPdf($pdf,$tplIdx , 40 , 250  ,$leadObj->business_responsible_details_name . 'wee');


        /*page 9*/
        $pdf->addPage();
        $tplIdx = $pdf->importPage(9);
        $pdf->useTemplate($tplIdx, 0, 0, 0, 0, true);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(20, 20);

        $howWasPackageSold_coor_x = 25;
        $howWasPackageSold_coor_y = 98;
        /*how was package solved*/
        // switch ($leadObj->how_packaged_bank_account_sold) {
        //     case 'During a meeting':
        //         $howWasPackageSold_coor_x = 18.5;
        //         $howWasPackageSold_coor_y = 227;
        //         break;
        //     case 'Over the phone':
        //         $howWasPackageSold_coor_x = 56;
        //         $howWasPackageSold_coor_y = 227;
        //         break;
        //     case 'Over the internet':
        //         $howWasPackageSold_coor_x = 88;
        //         $howWasPackageSold_coor_y = 227;
        //         break;
        //     case 'By post':
        //         $howWasPackageSold_coor_x = 122;
        //         $howWasPackageSold_coor_y = 227;
        //         break;
        //     case 'I filled in a leaflet':
        //         $howWasPackageSold_coor_x = 18.5;
        //         $howWasPackageSold_coor_y = 240.5;
        //         break;
        //     case 'Can\'t remember':
        //         $howWasPackageSold_coor_x = 88;
        //         $howWasPackageSold_coor_y = 240.5;
        //         break;
        //     case 'Over the counter':
        //         $howWasPackageSold_coor_x = 56;
        //         $howWasPackageSold_coor_y = 240.5;
        //         break;
        //     default:
        //         $howWasPackageSold_coor_x = 122;
        //         $howWasPackageSold_coor_y = 240.5;
        //         break;
        // }
        $this->writeToPdf($pdf,$tplIdx , $howWasPackageSold_coor_x , $howWasPackageSold_coor_y ,"x");

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

        /*actually_take_out_other_prodcuts*/
        $actually_take_out_other_prodcuts_coor_x = 17;
        $actually_take_out_other_prodcuts_coor_y = 127;
        if ($leadObj->actually_take_out_other_prodcuts === 'No') {
            $actually_take_out_other_prodcuts_coor_x = 35.5;
        }

        $this->writeToPdf(
            $pdf,
            $tplIdx,
            $actually_take_out_other_prodcuts_coor_x,
            $actually_take_out_other_prodcuts_coor_y,
            "x"
        );
        /*actually_take_out_other_prodcuts_details*/

        $this->writeToPdf($pdf,$tplIdx,17,150 ,$leadObj->actually_take_out_other_prodcuts_details);

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

        // registered_benefits_by_packaged_account_details
        $this->writeToPdf($pdf,$tplIdx, 18 , 38,$leadObj->registered_benefits_by_packaged_account_details);

        // tried_to_claim_for_package
        $tried_to_claim_for_package_coor_x = 18;
        $tried_to_claim_for_package_coor_y = 87.4;
        if ($leadObj->tried_to_claim_for_package === "No") {
            $tried_to_claim_for_package_coor_x = 36.5;
        }
        $this->writeToPdf($pdf,$tplIdx, $tried_to_claim_for_package_coor_x , $tried_to_claim_for_package_coor_y,'x');

        $this->writeToPdf($pdf,$tplIdx, 18  , 115  , $leadObj->tried_to_claim_for_package_details);

        // used_benefits_packaged_bank
        $used_benefits_packaged_bank_coor_x = 17;
        $used_benefits_packaged_bank_coor_y = 169;
        if ($leadObj->used_benefits_packaged_bank === 'No') {
            $used_benefits_packaged_bank_coor_x = 35.8;
        } else if ($leadObj->used_benefits_packaged_bank === "I don't know") {
            $used_benefits_packaged_bank_coor_x = 52.5;
        }
        $this->writeToPdf(
            $pdf,
            $tplIdx,
            $used_benefits_packaged_bank_coor_x,
            $used_benefits_packaged_bank_coor_y,
            'x'
        );

        $this->writeToPdf(
            $pdf,
            $tplIdx,
            18,
            195,
            $leadObj->used_benefits_packaged_bank_details
        );

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
                    $this->writeToPdf($pdf,$tplIdx,16.8,86.3,"x");
                    break;
                case "Gadget insurance":
                    //gadget insurance
                    $this->writeToPdf($pdf,$tplIdx,16.8,97,"x");
                    break;
                case "Mobile phone insurance":
                    //mobile phone insurance
                    $this->writeToPdf($pdf,$tplIdx,62,75.4,"x");
                    break;
                case "Life Assurance":
                    //life assurance
                    $this->writeToPdf($pdf,$tplIdx,61.4,86.3,"x");
                    break;
                case "Travel insurance":
                    //any other insurance that was also included in your packaged bank account
                    $this->writeToPdf($pdf,$tplIdx,131,75.4,"x");
                    break;
                case "Identity theft insurance":
                    // travel insurance
                    $this->writeToPdf($pdf,$tplIdx,131,86.3,"x");
                    break;
                case "Any other insurance that was also included in your packaged bank account":
                    // identity theft protection
                    $this->writeToPdf($pdf,$tplIdx,61.4,97,"x");
                    break;
                default:
                    break;
            }
        }
        $this->writeToPdf($pdf,$tplIdx,16.8,125,$leadObj->after_upgrade_already_has_products_details);


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
        /*possible word wrap this to break on specific length to prevent overflow*/
        $this->writeToPdf($pdf,$tplIdx, 20 ,50 ,$leadObj->complaint_whole_details);


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
        $pdf->Image($leadObj->client_signature_image, 70, 78, 100,18);
        $dateStr = sprintf("%02d", date("d"));
        $monthStr = sprintf("%02d", date("m"));
        $yearStr = sprintf("%02d", date("Y"));
        $this->writeToPdf($pdf,$tplIdx, 134 ,90 ,$dateStr[0]);
        $this->writeToPdf($pdf,$tplIdx, 140 ,90 ,$dateStr[1]);
        $this->writeToPdf($pdf,$tplIdx, 148 , 90 ,$monthStr[0]);
        $this->writeToPdf($pdf,$tplIdx, 155 , 90 ,$monthStr[1]);
        $this->writeToPdf($pdf,$tplIdx, 162 , 90 ,$yearStr[0]);
        $this->writeToPdf($pdf,$tplIdx, 170 , 90 ,$yearStr[1]);
        $this->writeToPdf($pdf,$tplIdx, 178 , 90 ,$yearStr[2]);
        $this->writeToPdf($pdf,$tplIdx, 185 , 90 ,$yearStr[3]);

        $this->writeToPdf($pdf,$tplIdx , 20 , 111 ,$fullname);
        $pdf->Image($leadObj->client_signature_image, 70, 101, 100,18);
        $dateStr = sprintf("%02d", date("d"));
        $monthStr = sprintf("%02d", date("m"));
        $yearStr = sprintf("%02d", date("Y"));
        $this->writeToPdf($pdf,$tplIdx, 134 ,109 ,$dateStr[0]);
        $this->writeToPdf($pdf,$tplIdx, 140 ,109 ,$dateStr[1]);
        $this->writeToPdf($pdf,$tplIdx, 148 , 109 ,$monthStr[0]);
        $this->writeToPdf($pdf,$tplIdx, 155 , 109 ,$monthStr[1]);
        $this->writeToPdf($pdf,$tplIdx, 162 , 109 ,$yearStr[0]);
        $this->writeToPdf($pdf,$tplIdx, 170 , 109 ,$yearStr[1]);
        $this->writeToPdf($pdf,$tplIdx, 178 , 109 ,$yearStr[2]);
        $this->writeToPdf($pdf,$tplIdx, 185 , 109 ,$yearStr[3]);


        $declaration_confirmed_tickArr = explode(",", $leadObj->declaration_confirmed_tick);

        $temp_coor_x = 17;
        $temp_coor_y = 0;
        foreach ($declaration_confirmed_tickArr as $key => $value) {
            switch ($value) {
                case 'Included everything you want to tell us about your complaint':
                    $temp_coor_y = 180;
                    break;
                case 'Signed the declaration':
                    $temp_coor_y = 185.4;
                    break;
                case 'Enclosed copies of all relevant documents':
                    $temp_coor_y = 192;
                    break;
                case 'Not enclosed any documents with this form':
                    $temp_coor_y = 204;
                    break;
                default:
                    break;
            }
        }
        if ($temp_coor_y !== 0) {
            $this->writeToPdf($pdf,$tplIdx, $temp_coor_x , $temp_coor_y ,'x');
        }

        /*page 16*/
        $pdf->addPage();
        $tplIdx = $pdf->importPage(16);
        $pdf->useTemplate($tplIdx, 0, 0, 0, 0, true);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(20, 20);
        $this->writeToPdf($pdf,$tplIdx, 115 ,94 ,$leadObj->salutation);
        $this->writeToPdf($pdf,$tplIdx, 52 ,94 ,$leadObj->firstname);
        $this->writeToPdf($pdf,$tplIdx, 52 ,100 ,$leadObj->lastname);

        $this->writeToPdf($pdf,$tplIdx, 52 ,117 ,$leadObj->date_of_birth);
        $this->writeToPdf($pdf,$tplIdx, 52 ,127 ,$leadObj->address1);
        $this->writeToPdf($pdf,$tplIdx, 52 ,131 ,$leadObj->address2);
        $this->writeToPdf($pdf,$tplIdx, 52 ,135 ,$leadObj->address3);
        $this->writeToPdf($pdf,$tplIdx, 52 ,139 ,$leadObj->address4);
        $this->writeToPdf($pdf,$tplIdx, 52 ,144 ,$leadObj->postcode);


        $this->writeToPdf($pdf,$tplIdx, 150 ,160 ,$leadObj->mobile);
        $this->writeToPdf($pdf,$tplIdx, 150 ,167 ,$leadObj->email_address);
        $this->writeToPdf($pdf,$tplIdx, 52 ,167 ,$leadObj->landline);

        $this->writeToPdf($pdf,$tplIdx, 52 ,250 ,$leadObj->behalf_of_charity_official_name);
        $this->writeToPdf($pdf,$tplIdx, 187 ,250 ,$leadObj->behalf_of_charity_num_of_employees);
        $this->writeToPdf($pdf,$tplIdx, 52 ,265 ,$leadObj->behalf_of_charity_num_of_partners);
        $this->writeToPdf($pdf,$tplIdx, 187 ,265 ,$leadObj->behalf_of_charity_annual_income);

        // /*page 17*/
        $pdf->addPage();
        $tplIdx = $pdf->importPage(17);
        $pdf->useTemplate($tplIdx, 0, 0, 0, 0, true);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(20, 20);
        $this->writeToPdf($pdf,$tplIdx, 55 ,23 ,$leadObj->business_responsible_details_name);
        $leadObj->business_responsible_details_address = explode("\n", $leadObj->business_responsible_details_address);
        $leadObj->business_responsible_details_address = implode(",", $leadObj->business_responsible_details_address);
        $this->writeToPdf($pdf,$tplIdx, 55 ,30 ,$leadObj->business_responsible_details_address);
        $this->writeToPdf($pdf,$tplIdx, 55 ,55 ,$leadObj->business_responsible_details_phone);

        $this->writeToPdf($pdf,$tplIdx, 55 ,80 ,$leadObj->adviser_detail_name);
        $leadObj->adviser_detail_address = explode("\n", $leadObj->adviser_detail_address);
        $leadObj->adviser_detail_address = implode(",", $leadObj->adviser_detail_address);
        $this->writeToPdf($pdf,$tplIdx, 55 , 87 ,$leadObj->adviser_detail_address);
        $this->writeToPdf($pdf,$tplIdx, 55 , 110 ,$leadObj->adviser_detail_phone);

        $this->writeToPdf($pdf,$tplIdx, 55 , 133 ,$leadObj->kind_of_service_complain);
        $this->writeToPdf($pdf,$tplIdx, 105 , 145 ,$leadObj->kind_of_service_complain_reference . 'reference');

        $this->writeToPdf($pdf,$tplIdx, 23 ,180 ,$leadObj->complaint_whole_details);

        $when_trasaction_happen_day = date("d",strtotime($leadObj->when_trasaction_happen));
        $when_trasaction_happen_day = sprintf("%02d", $when_trasaction_happen_day);
        $this->writeToPdf($pdf,$tplIdx, 160 ,265 ,$when_trasaction_happen_day);

        $when_trasaction_happen_month = date("m",strtotime($leadObj->when_trasaction_happen));
        $when_trasaction_happen_month = sprintf("%02d", $when_trasaction_happen_month);
        $this->writeToPdf($pdf,$tplIdx, 175 ,265 ,$when_trasaction_happen_month);

        $when_trasaction_happen_year = date("Y",strtotime($leadObj->when_trasaction_happen));
        $this->writeToPdf($pdf,$tplIdx, 188 ,265 ,$when_trasaction_happen_year);

        // /*first complain*/
        $when_first_complain_business_day = date("d",strtotime($leadObj->when_first_complain_business));
        $when_first_complain_business_day = sprintf("%02d", $when_first_complain_business_day);
        $this->writeToPdf($pdf,$tplIdx, 160 ,273 ,$when_first_complain_business_day);

        $when_first_complain_business_month = date("m",strtotime($leadObj->when_first_complain_business));
        $when_first_complain_business_month = sprintf("%02d", $when_first_complain_business_month);
        $this->writeToPdf($pdf,$tplIdx, 175 ,273 ,$when_first_complain_business_month);

        $when_first_complain_business_year = date("Y",strtotime($leadObj->when_first_complain_business));
        $this->writeToPdf($pdf,$tplIdx, 188 ,273 ,$when_first_complain_business_year);

        // /*page 18*/
        $pdf->addPage();
        $tplIdx = $pdf->importPage(18);
        $pdf->useTemplate($tplIdx, 0, 0, 0, 0, true);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(20, 20);
        // has_business_complaining_sent_letter
        // $has_business_complaining_sent_letter_coor_x = 178;
        // $has_business_complaining_sent_letter_coor_y = 21.5;
        // if ($leadObj->has_business_complaining_sent_letter === 'No') {
        //     $has_court_action_to_complain_x = 192;
        // }
        // $this->writeToPdf($pdf,$tplIdx, $has_business_complaining_sent_letter_coor_x ,$has_business_complaining_sent_letter_coor_y ,'x');

        // $has_court_action_to_complain_x = 178;
        // $has_court_action_to_complain_y = 33;
        // if ($leadObj->has_court_action_to_complain === 'No') {
        //     $has_court_action_to_complain_x = 192;
        // }
        // $this->writeToPdf($pdf,$tplIdx, $has_court_action_to_complain_x ,$has_court_action_to_complain_y ,'x');

        $this->writeToPdf($pdf,$tplIdx, 15 , 55 ,$leadObj->settlement_with_business_details . ' test ');

        // $is_ineed_of_practical_help_details_x = 178;
        // $is_ineed_of_practical_help_details_y = 82.5;
        // if ($leadObj->is_ineed_of_practical_help_details === 'No') {
        //     $is_ineed_of_practical_help_details_x = 192;
        // }
        // $this->writeToPdf($pdf,$tplIdx, $is_ineed_of_practical_help_details_x ,$is_ineed_of_practical_help_details_y ,'x');
        // is_ineed_of_practical_help_details

        /*signature*/
        $pdf->Image($leadObj->client_signature_image, 20, 180, 100,18);
        /*date*/
        $this->writeToPdf($pdf,$tplIdx, 85 ,190 ,date("d-m-Y"));


        $final_tick_checklist_arr = explode(",", $leadObj->final_tick_checklist);

        foreach ($final_tick_checklist_arr as $key => $value) {
            switch ($value) {
                case "enclosed a copy of the business’s last letter to you.":
                    $this->writeToPdf($pdf,$tplIdx, 86.8 ,231.5 ,'x');
                    break;
                case "enclosed copies of other relevant information.":
                    $this->writeToPdf($pdf,$tplIdx, 86.8 ,237 ,'x');
                    break;
                case "included everything you want to tell us about your complaint.":
                    $this->writeToPdf($pdf,$tplIdx, 86.8 ,243 ,'x');
                    break;
                default:
                    break;
            }
        }


        if (isset($this->destinationFile)) {
            $pdf->Output($this->destinationFile ,"F");
            $this->exportedFile = $this->destinationFile;
        }else {
            $pdf->Output('peek.pdf', 'I');
        }
    }

} 