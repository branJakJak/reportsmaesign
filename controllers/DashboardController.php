<?php

namespace app\controllers;

class DashboardController extends \yii\web\Controller
{
	public $layout = "dashboard";
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['view','index','create','update'],
                'rules' => [
                    [
                        'actions' => ['view','index','create','update'],
                        'allow' => true,
                        'roles' => ['admin','agent'],
                    ],
                ],
            ],            
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

}
