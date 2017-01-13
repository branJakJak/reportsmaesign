<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 1/10/17
 * Time: 4:49 AM
 */

namespace app\modules\api;


use app\models\events\NewPPILeadEventHandler;
use app\models\PPILead;

class NewPpiLeadFactory {
    public static function create(){
        $newLead = new PPILead();
        $newLead->on(PPILead::EVENT_NEW_LEAD, ['app\models\events\NewPPILeadEventHandler', 'handle']);
        return $newLead;
    }
} 