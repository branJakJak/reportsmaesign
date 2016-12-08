<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 10/11/16
 * Time: 11:55 PM
 */

namespace app\components;


use app\models\LeadEsign;
use Dompdf\Exception;
use yii\base\Component;
use Yii;
use FPDI;


class PdfEsign extends Component
{
    public $leadData;
    protected $htmlContents;
    protected $pdfTemplate;
    protected $leadObject;
    protected $exportedFile;
    protected $destinationFile;

    public function init()
    {
        parent::init();
    }
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
        // $this->writeToPdf($pdf,$tplIdx , 130, 247 , date("d/m/Y",time()));
        // $this->writeToPdf($pdf,$tplIdx , 130, 430 , date("d/m/Y",time()) );
        $pdf->Image($leadObj->client_signature_image, 10, 230, 100,18);
        // $pdf->Image($leadObj->client_signature_image, 120, 230, 100,18);

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
        // $this->writeToPdf($pdf,$tplIdx , 30, 240 , date("d/m/Y",time()));
        $pdf->Image($leadObj->client_signature_image, 15, 225, 100,18);
        // $pdf->Image($leadObj->client_signature_image, 123, 225, 100,18);

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
        // $this->writeToPdf($pdf,$tplIdx , 30, 247 , date("d/m/Y",time()));
        $pdf->Image($leadObj->client_signature_image, 15, 233, 100,18);
        // $pdf->Image($leadObj->client_signature_image, 123, 233, 100,18);


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
        // $this->writeToPdf($pdf,$tplIdx , 30, 247 , date("d/m/Y",time()));
        $pdf->Image($leadObj->client_signature_image, 15, 233, 100,18);
        // $pdf->Image($leadObj->client_signature_image, 123, 233, 100,18);

        /*page 6*/
        $pdf->addPage();
        $tplIdx = $pdf->importPage(6);
        $pdf->useTemplate($tplIdx, 0, 0, 0, 0, true);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(20, 20);

        $this->writeToPdf($pdf,$tplIdx , 20 , 111.5 ,$leadObj->complaint_reference);
        $this->writeToPdf($pdf,$tplIdx , 20 , 131 ,$leadObj->financial_business_name);
        $this->writeToPdf($pdf,$tplIdx , 20 , 157 ,$leadObj->last_3_digit_account_num);

        $checkMarkCoor_x = 0;
        if ( $leadObj->account_type === "Joint" ) {
            /*place the x at the yes checkbox*/
            $checkMarkCoor_x = 17;
        }else {
            $checkMarkCoor_x = 35.5;
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

        $is_complain_about_sale_packaged_bank_account_coor_x = 18.7;
        $is_complain_about_sale_packaged_bank_account_coor_x = 37;
        $is_complain_about_sale_packaged_bank_account_coor_y = 40.9;
        // if ($leadObj->is_complain_about_sale_packaged_bank_account === "No") {
        //     $is_complain_about_sale_packaged_bank_account_coor_x = 23;
        // }
        $this->writeToPdf($pdf,$tplIdx , $is_complain_about_sale_packaged_bank_account_coor_x , $is_complain_about_sale_packaged_bank_account_coor_y ,"x");
        // is_complain_about_sale_packaged_bank_account
        
        // is_complain_about_sale_packaged_bank_account_details 
        $this->writeToPdf($pdf,$tplIdx , 20 , 75 , $leadObj->is_complain_about_sale_packaged_bank_account_details);
        if (isset($leadObj->open_or_upgrade_package_bank_account_date) && !empty($leadObj->open_or_upgrade_package_bank_account_date)) {
            $dateStrcontainer = date("d",strtotime($leadObj->open_or_upgrade_package_bank_account_date));
            $dateStrcontainer = intval($dateStrcontainer);
            $dateStrcontainer = sprintf('%02d', $dateStrcontainer);

            $this->writeToPdf($pdf,$tplIdx , 19.5 , 142 , $dateStrcontainer[0]);
            $this->writeToPdf($pdf,$tplIdx , 33 , 142 , $dateStrcontainer[1]);

            $dateStrcontainer = date("m",strtotime($leadObj->open_or_upgrade_package_bank_account_date));
            $monthStrContainer = intval($dateStrcontainer);
            $monthStrContainer = sprintf('%02d', $monthStrContainer);

            $this->writeToPdf($pdf,$tplIdx , 47 , 142 , $monthStrContainer[0]);
            $this->writeToPdf($pdf,$tplIdx , 60 , 142 , $monthStrContainer[1]);

            $yearStrcontainer = date("Y",strtotime($leadObj->open_or_upgrade_package_bank_account_date));
            $yearStrcontainer = intval($yearStrcontainer).'';
            $this->writeToPdf($pdf,$tplIdx , 75 , 142 , $yearStrcontainer[0]);
            $this->writeToPdf($pdf,$tplIdx , 88 , 142 , $yearStrcontainer[1]);
            $this->writeToPdf($pdf,$tplIdx , 101 , 142 , $yearStrcontainer[2]);
            $this->writeToPdf($pdf,$tplIdx , 116 , 142 , $yearStrcontainer[3]);
        }
        // notice_account_fees_on_statements
        $notice_account_fees_on_statements_coor_x = 17.5;
        $notice_account_fees_on_statements_coor_y = 162.5;
        if ($leadObj->notice_account_fees_on_statements === "No") {
            $notice_account_fees_on_statements_coor_x = 36;
        }
        $this->writeToPdf($pdf,$tplIdx , $notice_account_fees_on_statements_coor_x , $notice_account_fees_on_statements_coor_y , 'x');

        // notice_account_fees_on_statements_details
        $this->writeToPdf($pdf,$tplIdx , 18.7 , 183 , $leadObj->notice_account_fees_on_statements_details);

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

        
        $this->writeToPdf($pdf,$tplIdx , 16 , 30 ,$leadObj->how_packaged_bank_account_sold_details);

        $did_they_give_advice_clarify_coor_x = 54.5;//defaults to I cant remember
        $did_they_give_advice_clarify_coor_y = 69.5;//defaults to I cant remember
        if ($leadObj->did_they_give_advice_clarify === 'Yes') {
            $did_they_give_advice_clarify_coor_x = 19;//
        } else if ($leadObj->did_they_give_advice_clarify === 'No') {
            $did_they_give_advice_clarify_coor_x = 37.5;//
        }
        $this->writeToPdf($pdf,$tplIdx , $did_they_give_advice_clarify_coor_x , $did_they_give_advice_clarify_coor_y ,'x');

        $this->writeToPdf($pdf,$tplIdx , 19 , 90  ,$leadObj->did_they_give_advice_clarify_details);

        // current_situation_packaged_bank_account
        $current_situation_packaged_bank_account_coor_x = 17.5;
        $current_situation_packaged_bank_account_coor_y = 133.5;
        if ($leadObj->current_situation_packaged_bank_account === 'I’m still paying for my packaged bank account') {
            $current_situation_packaged_bank_account_coor_x = 17.5;
        }else if ($leadObj->current_situation_packaged_bank_account === 'I’ve closed/downgraded my packaged bank account') {
            $current_situation_packaged_bank_account_coor_x = 97;
        }
        $this->writeToPdf($pdf,$tplIdx , $current_situation_packaged_bank_account_coor_x , $current_situation_packaged_bank_account_coor_y ,'x');

        
        // current_situation_packaged_bank_account_explanation
        $this->writeToPdf($pdf,$tplIdx , 19 , 158 , $leadObj->current_situation_packaged_bank_account_explanation . 'weeee');

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
        if ($did_they_give_advice_clarify_coor_x !== 0 && $did_they_give_advice_clarify_coor_y !== 0) {
            $this->writeToPdf(
                $pdf,
                $tplIdx ,
                $did_they_give_advice_clarify_coor_x,
                $did_they_give_advice_clarify_coor_y,
                "x"
            );
        }
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
            $this->writeToPdf($pdf,$tplIdx, 17.5,65,$leadObj->when_opened_account_has_other_account_details);
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
        $pdf->Image($leadObj->client_signature_image, 50, 101, 100,18);
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

        // /*page 17*/
        $pdf->addPage();
        $tplIdx = $pdf->importPage(17);
        $pdf->useTemplate($tplIdx, 0, 0, 0, 0, true);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(20, 20);

        // /*page 18*/
        $pdf->addPage();
        $tplIdx = $pdf->importPage(18);
        $pdf->useTemplate($tplIdx, 0, 0, 0, 0, true);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(20, 20);

        if (isset($this->destinationFile)) {
            $pdf->Output($this->destinationFile ,"F");
            $this->exportedFile = $this->destinationFile;
        }else {
            $pdf->Output('peek.pdf', 'I');
        }
    }

    public function getExportedFile()
    {
        if (!file_exists($this->exportedFile)) {
            throw new Exception("Exported file doesn't exists");
        }
        return $this->exportedFile;
    }

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

    public function setTemplate($pdfTemplte)
    {
        $this->pdfTemplate = $pdfTemplte;
    }

    public function setLeadObject($leadObj)
    {
        $this->leadObject = $leadObj;
    }

    public function setDestinationFile($destination)
    {
        $this->destinationFile = $destination;
    }
} 