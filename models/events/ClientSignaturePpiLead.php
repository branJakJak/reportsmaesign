<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 1/11/17
 * Time: 12:58 AM
 */

namespace app\models\events;


use app\models\PPILead;
use yii\swiftmailer\Mailer;
use Yii;

class ClientSignaturePpiLead {
    /**
     * @var PPIPdfFactory
     */
    public $esignPdfFactory;
    /**
     * @param $event
     */
    public function handle($event)
    {
        /**
         * @var $currentLeadData PPILead
         * @var $mailer Mailer
         */
        $currentLeadData = $event->data;
        $mailer = \Yii::$app->mailer;

        /*factory will decide what PPIPdf will be used*/
        $pdfEsign = $this->esignPdfFactory->create([
            'model'=>$currentLeadData
        ]);
        $exportedFile = $pdfEsign->getExportedFile();

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
Please find attached signed documents for your copy.
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