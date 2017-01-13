<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 1/10/17
 * Time: 1:33 AM
 */

namespace app\modules\api\controllers;


use app\modules\api\LeadBaseInterface;
use phpDocumentor\Reflection\Exception;
use yii\web\Controller;
use app\models\AccountUser;
use yii\filters\Cors;
use yii\helpers\ArrayHelper;

class LeadBaseController extends Controller
{
    public $enableCsrfValidation = false;
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $customBehaviors = [
            'cors' => [
                'class' => Cors::className(),
            ],
            'basicAuth' => [
                'class' => \yii\filters\auth\HttpBasicAuth::className(),
                'auth' => function ($username, $password) {
                        /**
                         * @var $user AccountUser
                         */
                        $user = AccountUser::find()->where(['username' => $username])->one();
                        if ($user && \Yii::$app->security->validatePassword($password, $user->password)) {
                            return $user;
                        }
                        return null;
                    },
            ]
        ];
        return ArrayHelper::merge($customBehaviors, parent::behaviors());
    }

} 