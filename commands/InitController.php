<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 10/12/16
 * Time: 10:15 PM
 */

namespace app\commands;


use app\models\AccountUser;
use yii\console\Controller;

class InitController extends Controller
{
    public function actionIndex()
    {
        /* create admin role*/
        $authManager = \Yii::$app->authManager;
        $adminRole = $authManager->createRole("admin");
        $authManager->add($adminRole);
        $adminUser = new AccountUser();
        $adminUser->username = "admin";
        $adminUser->password = "pf3Zt49nsgoPFbr";
        $adminUser->authKey= uniqid();
        $adminUser->accessToken = uniqid();
        if ($adminUser->save()) {
            $authManager->assign($adminRole, $adminUser->id);
            /*assign the role */
        }
    }

} 