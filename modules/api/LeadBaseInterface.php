<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 1/10/17
 * Time: 1:37 AM
 */

namespace app\modules\api;


interface LeadBaseInterface {
    public function actionNonAffiliate();
    public function actionAffiliate();
}