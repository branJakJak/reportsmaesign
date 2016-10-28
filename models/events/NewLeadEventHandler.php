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
use yii\helpers\Html;

class NewLeadEventHandler extends Event{
    /**
     * @param $event
     */
    public static function handle($event)
    {
        /**
         * @var $currentLeadData LeadEsign
         */
        $currentLeadData = $event->data;
        $signaturelinkUrl = Html::a("final step",'/signature/'.$currentLeadData->security_key);
         
        /*send the email*/           
        Yii::$app->mailer->compose()
            ->setFrom('esign@site8.co')
            // ->setTo($currentLeadData->email_address)
            ->setTo("hellsing357@gmail.com")
            ->setSubject('Final Step : Signature')
            ->setHtmlBody("Please finalize your claim $signaturelinkUrl.")
            ->send();      
    }
} 