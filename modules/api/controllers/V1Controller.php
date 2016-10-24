<?php

namespace app\modules\api\controllers;

use app\models\AccountUser;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;


/**
 * Default controller for the `api` module
 */
class V1Controller extends ActiveController
{
    public $modelClass = 'app\models\LeadEsign';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $customBehaviors = [
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

    protected function verbs()
    {
        return [
            'index' => ['GET', 'POST','HEAD'],
            'view' => ['GET', 'HEAD'],
            'create' => ['POST'],
            'update' => ['PUT', 'PATCH'],
            'delete' => ['DELETE'],
        ];
    }

}
