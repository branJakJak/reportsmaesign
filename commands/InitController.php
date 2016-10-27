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
    public function actionApiUser()
    {
        echo "Creating api_user role \r\n";
       /* create api user role*/
        $authManager = \Yii::$app->authManager;
        $apiUserRole = $authManager->createRole("api_user");
        $authManager->add($apiUserRole);
        echo "role added \r\n";

        $apiUser = new AccountUser();
        $apiUser->username = "api";
        $apiUser->password = "RlI1FOWCkuGLKEdNBi9j";
        $apiUser->authKey= 'l;!SUCFZx<sGOcgoA$vQ';
        $apiUser->accessToken = 'PjiIpU#duF^z1$oh/9xY';
        echo "API User saved \r\n";
        if ($apiUser->save()) {
            $authManager->assign($apiUserRole, $apiUser->id);
            /*assign the role */
        }
    }
    public function actionAgents()
    {
        echo "Creating agent role \r\n";
       /* create api user role*/
        $authManager = \Yii::$app->authManager;
        $agentRole = $authManager->createRole("agent");
        $authManager->add($agentRole);
        echo "agent role added \r\n";

        $hduk_staff = new AccountUser();
        $hduk_staff->username = "hduk_staff";
        $hduk_staff->password = "DaJAMj2hn5it0m8ZvQNb";
        $hduk_staff->authKey= uniqid();
        $hduk_staff->accessToken = uniqid();
        echo "API User saved \r\n";
        if ($hduk_staff->save()) {
            echo "hduk_staff saved ".PHP_EOL;
            $authManager->assign($agentRole, $hduk_staff->id);
        }
        $ma_staff = new AccountUser();
        $ma_staff->username = "ma_staff";
        $ma_staff->password = "XFhuB6CepDSPAUyni4Vg";
        $ma_staff->authKey= uniqid();
        $ma_staff->accessToken = uniqid();
        echo "API User saved \r\n";
        if ($ma_staff->save()) {
            $authManager->assign($agentRole, $ma_staff->id);
        }

    }

} 