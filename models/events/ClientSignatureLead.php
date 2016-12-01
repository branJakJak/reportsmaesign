<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 12/1/16
 * Time: 10:34 PM
 */

namespace app\models\events;


use app\models\LeadEsign;
use yii\base\Event;
use yii\helpers\Url;
use yii\swiftmailer\Mailer;

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
        $pdfOutput = Url::home(true) . 'export/' . $currentLeadData->security_key;
        //download the pdf file
        $downloadedPdfFile = \Yii::getAlias("@app/data").sprintf("%s_%s_%s.pdf",$currentLeadData->firstname,$currentLeadData->lastname,$currentLeadData->security_key);
        file_put_contents($downloadedPdfFile, file_get_contents($pdfOutput));

        $mailer = \Yii::$app->mailer;
        $mailMessage = $mailer->compose();
        $mailMessage->attach($downloadedPdfFile);
        $customerName = sprintf("%s %s %s", $currentLeadData->salutation, $currentLeadData->firstname, $currentLeadData->lastname);
        $customerName = strtoupper($customerName);
        $logoPath = \Yii::getAlias("@app/web/images/moneyactive.JPG");
        $type = pathinfo($logoPath, PATHINFO_EXTENSION);
        $data = file_get_contents($logoPath);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        $templateMessage =  <<<EOL
Hi $customerName,

As discussed, please find attached esign documents ready for signature.

Please complete this as soon as possible to start your claim

Kind regards
Money Active
<img src='$base64' />
EOL;
        echo $templateMessage;
        die();
        $mailMessage
            ->setFrom('esign@site8.co')
            ->setTo($currentLeadData->email_address)
            ->setSubject('Thank you for completing the form.')
            ->setHtmlBody($templateMessage);
        $mailMessage->send($mailer);
    }
}