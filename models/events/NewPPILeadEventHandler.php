<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 1/10/17
 * Time: 4:50 AM
 */

namespace app\models\events;


use app\models\PPILead;
use yii\helpers\Json;
use yii\helpers\Url;

class NewPPILeadEventHandler{
    public static function handle($event){
        /**
         * @var $model PPILead
         */
        $model = $event->sender;
        if( $model ){
            /*send email to the owner*/
            $signaturelinkUrl = "<a href='" . Url::home(true) . 'signature/ppi/' . $model->security_key . "'> Final step </a>";
            $logoPath = \Yii::getAlias("@app/web/images/moneyactive.JPG");
            $type = pathinfo($logoPath, PATHINFO_EXTENSION);
            $imgLogo = file_get_contents($logoPath);
            $customerName = sprintf("%s %s %s", $model->salutation, $model->firstname, $model->lastname);
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
                ->setTo($model->email_address)
                // ->setTo("hellsing357@gmail.com")
                ->setSubject('Final Step : Signature')
                ->setHtmlBody($templateMessage)
                ->send();
        }else {
            throw new \Exception("Please pass PPILead model. Null PPI Lead object.");
        }

    }

} 