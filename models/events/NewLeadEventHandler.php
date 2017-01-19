<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 10/29/16
 * Time: 12:11 AM
 */

namespace app\models\events;

use app\models\LeadEsign;
use yii\base\Event;
use yii\helpers\Url;

class NewLeadEventHandler extends Event
{
    /**
     * @param $event
     */
    public static function handle($event)
    {
        /**
         * @var $currentLeadData LeadEsign
         */
        $currentLeadData = $event->data;
        $signaturelinkUrl = "<a href='" . Url::home(true) . 'signature/pba/' . $currentLeadData->security_key . "'> Final step </a>";
        $logoPath = \Yii::getAlias("@app/web/images/moneyactive.JPG");
        $type = pathinfo($logoPath, PATHINFO_EXTENSION);
        $imgLogo = file_get_contents($logoPath);
        $customerName = sprintf("%s %s %s", $currentLeadData->salutation, $currentLeadData->firstname, $currentLeadData->lastname);
        $base64Img = 'data:image/' . $type . ';base64,' . base64_encode($imgLogo);
        $templateMessage = <<<EOL
Hi $customerName,
<br>
<br>
As discussed, please find attached esign documents ready for signature.
<br>
<br>
Please complete this as soon as possible to start your claim. $signaturelinkUrl
<br>
<br>
Kind regards<br>
Money Active<br>
<img src='$base64Img' />
EOL;
        /*send the email*/           
        \Yii::$app->mailer->compose()
            ->setFrom('esign@site8.co')
            ->setTo($currentLeadData->email_address)
            ->setSubject('Final Step : Signature')
            ->setHtmlBody($templateMessage)
            ->send();      
    }
} 