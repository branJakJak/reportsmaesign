<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 10/11/16
 * Time: 11:55 PM
 */

namespace app\components;


use app\models\LeadEsign;
use app\models\PPILead;
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
        $leadObj->date_of_birth = date("d/m/Y",strtotime($leadObj->date_of_birth));
        
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
        $this->writeToPdf($pdf,$tplIdx , 69 , 106 ,"United Kingdom");
        $this->writeToPdf($pdf,$tplIdx , 69 , 126 ,$leadObj->mobile);
        $this->writeToPdf($pdf,$tplIdx , 69 , 132 ,$leadObj->email_address);
        $this->writeToPdf($pdf,$tplIdx , 69 , 137 ,$leadObj->date_of_birth);
        $this->writeToPdf($pdf,$tplIdx , 69 , 143 ,$leadObj->account_provider);
        $this->writeToPdf($pdf,$tplIdx , 69 , 150  ,$leadObj->monthly_account_charge);
        $this->writeToPdf($pdf,$tplIdx , 72 , 156  ,date("d/m/Y",strtotime($leadObj->account_start_date)));
        $this->writeToPdf($pdf,$tplIdx , 160 , 156  ,date("d/m/Y",strtotime($leadObj->account_end_date)));

        $this->writeToPdf($pdf,$tplIdx , 73, 179 , $leadObj->security_key);

        $this->writeToPdf($pdf,$tplIdx , 60, 247 , date("d/m/Y",time()));
        $pdf->Image($leadObj->client_signature_image, 23, 230, 100,18);

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
        // $this->writeToPdf($pdf,$tplIdx , 43, 247 , date("d/m/Y",time()));
        $this->writeToPdf($pdf,$tplIdx , 30, 240 , date("d/m/Y",time()));
        // $pdf->Image($leadObj->client_signature_image, 15, 225, 100,18);
        $pdf->Image($leadObj->client_signature_image, 20, 223, 100,18);        
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
        $this->writeToPdf($pdf,$tplIdx , 34, 247 , date("d/m/Y",time()));
        // $this->writeToPdf($pdf,$tplIdx , 30, 247 , date("d/m/Y",time()));
        $pdf->Image($leadObj->client_signature_image, 20, 232, 100,18);


        // $pdf->Image($leadObj->client_signature_image, 15, 233, 100,18);
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
        $this->writeToPdf($pdf,$tplIdx , 34, 247 , date("d/m/Y",time()));
        // $this->writeToPdf($pdf,$tplIdx , 30, 247 , date("d/m/Y",time()));
        $pdf->Image($leadObj->client_signature_image, 20, 232, 100,18);
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
        $dateArr = explode("/", $leadObj->date_of_birth);
        $year= $dateArr[2];
        $month= $dateArr[1];
        $date= $dateArr[0];
        /*date*/

        $this->writeToPdf($pdf,$tplIdx , 39 , 245 , sprintf("%01d", $date[0]));
        $this->writeToPdf($pdf,$tplIdx , 47 , 245 , sprintf("%01d", $date[1]));
        /*month*/
        $this->writeToPdf($pdf,$tplIdx , 58 , 245 , sprintf("%01d", $month[0]));
        $this->writeToPdf($pdf,$tplIdx , 66 , 245 , sprintf("%01d", $month[1]));
        /*year*/
        $this->writeToPdf($pdf,$tplIdx , 76 , 245 , sprintf("%01d", $year[0]));
        $this->writeToPdf($pdf,$tplIdx , 85 , 245 , sprintf("%01d", $year[1]));
        $this->writeToPdf($pdf,$tplIdx , 91 , 245 , sprintf("%01d", $year[2]));
        $this->writeToPdf($pdf,$tplIdx , 100 , 245 , sprintf("%01d", $year[3]));

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
        
        $when_opened_account_has_other_account_coor_x = 35.5;
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
        /*is_address_outside_UK_at_package_upgrade*/
        $is_address_outside_UK_at_package_upgrade_coor_x = 35.5;
        $is_address_outside_UK_at_package_upgrade_coor_y = 112;
        if ($leadObj->is_address_outside_UK_at_package_upgrade === 'No') {
            $is_address_outside_UK_at_package_upgrade_coor_x = 17.5;
        } 
        $this->writeToPdf($pdf,$tplIdx, $is_address_outside_UK_at_package_upgrade_coor_x,$is_address_outside_UK_at_package_upgrade_coor_y,"x");
        

        /*driving license*/
        $has_uk_driving_license_during_upgrade_coor_x = 35.5;
        $has_uk_driving_license_during_upgrade_coor_y = 138.5;
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
        /*has car*/
        $own_a_car_x = 35.5;
        $own_a_car_y = 160.5;
        if ($leadObj->own_a_car === 'Yes') {
            $own_a_car_x = 17.5;
        }
        $this->writeToPdf(
            $pdf,
            $tplIdx,
            $own_a_car_x,
            $own_a_car_y,
            "x"
        );


        $has_mobile_phone_during_upgrade_coor_x = 35.5;
        $has_mobile_phone_during_upgrade_coor_y = 183.5;
        if ( $leadObj->has_mobile_phone_during_upgrade  === "Yes" ) {
            $has_mobile_phone_during_upgrade_coor_x = 17.5;
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
                $often_go_holiday_in_europe_coor_x = 124.5;
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
                $often_go_holiday_outside_europe_coor_x = 124.5;
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
                $often_go_holiday_and_winter_sports_coor_x = 124.5;
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
        $has_business_complaining_sent_letter_coor_x = 178;
        $has_business_complaining_sent_letter_coor_y = 21.5;
        if ($leadObj->has_business_complaining_sent_letter === 'No') {
            $has_court_action_to_complain_x = 192;
        }
        $this->writeToPdf($pdf,$tplIdx, $has_business_complaining_sent_letter_coor_x ,$has_business_complaining_sent_letter_coor_y ,'x');

        $has_court_action_to_complain_x = 178;
        $has_court_action_to_complain_y = 33;
        if ($leadObj->has_court_action_to_complain === 'No') {
            $has_court_action_to_complain_x = 192;
        }
        $this->writeToPdf($pdf,$tplIdx, $has_court_action_to_complain_x ,$has_court_action_to_complain_y ,'x');
        
        $this->writeToPdf($pdf,$tplIdx, 15 , 55 ,$leadObj->settlement_with_business_details . ' test ');

        $is_ineed_of_practical_help_details_x = 178;
        $is_ineed_of_practical_help_details_y = 82.5;
        if ($leadObj->is_ineed_of_practical_help_details === 'No') {
            $is_ineed_of_practical_help_details_x = 192;
        }
        $this->writeToPdf($pdf,$tplIdx, $is_ineed_of_practical_help_details_x ,$is_ineed_of_practical_help_details_y ,'x');
        // is_ineed_of_practical_help_details

        /*signature*/
        $pdf->Image($leadObj->client_signature_image, 20, 179, 100,18);
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
    protected  function writeToPdf($pdf,$tplIdx, $x_coor, $y_coor , $val_to_write)
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