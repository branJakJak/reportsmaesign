<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 12/1/16
 * Time: 10:34 PM
 */

namespace app\models\events;


use app\components\PdfEsign;
use app\models\LeadEsign;
use yii\base\Event;
use yii\helpers\Url;
use yii\swiftmailer\Mailer;
use Yii;

class ClientSignatureLead extends Event
{

    /**
     * @param $event
     */
    public static function handle($event)
    {
        /**
         * @var $currentLeadData LeadEsign
         * @var $mailer Mailer
         */
        $currentLeadData = $event->data;
        $downloadedPdfFile = \Yii::getAlias("@app/data").'/'.sprintf("%s_%s_%s.pdf",$currentLeadData->firstname,$currentLeadData->lastname,$currentLeadData->security_key);
        $pdfTemplte = Yii::getAlias("@app/documentation/clean_pdf_template/PrintPack_65605.pdf");
        $pdfEsign = new PdfEsign();
        $pdfEsign->setTemplate($pdfTemplte);
        $pdfEsign->setLeadObject($currentLeadData);
        $pdfEsign->setDestinationFile($downloadedPdfFile);
        $pdfEsign->export();
        $exportedFile = $pdfEsign->getExportedFile();


        $mailer = \Yii::$app->mailer;
        $mailMessage = $mailer->compose();
        $mailMessage->attach($exportedFile);
        $customerName = sprintf("%s %s %s", $currentLeadData->salutation, $currentLeadData->firstname, $currentLeadData->lastname);
        $customerName = strtoupper($customerName);
        $logoPath = \Yii::getAlias("@app/web/images/moneyactive.JPG");
        $type = pathinfo($logoPath, PATHINFO_EXTENSION);
        $data = file_get_contents($logoPath);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        $templateMessage =  <<<EOL
Hi $customerName,
<br>
<br>
As discussed, please find attached esign documents ready for signature.
<br>
<br>
Please complete this as soon as possible to start your claim
<br>
<br>
Kind regards<br>
Money Active<br>
<img src='$base64' />
EOL;
        $mailMessage
            ->setFrom('esign@site8.co')
            ->setTo($currentLeadData->email_address)
            ->setSubject('Thank you for completing the form.')
            ->setHtmlBody($templateMessage);
        $mailMessage->send($mailer);
    }
}