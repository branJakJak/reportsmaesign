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
        $this->writeToPdf($pdf,$tplIdx , 64 , 204 ,$leadObj->date_of_birth);
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



        $pdf->Output('gift_coupon_generated.pdf', 'I');
        Yii::$app->end();
    }

}
