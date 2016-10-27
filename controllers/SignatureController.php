<?php

namespace app\controllers;

use app\models\LeadEsign;

class SignatureController extends \yii\web\Controller
{
    public function actionIndex($securityKey)
    {
        /**
         * @var $requestedLead LeadEsign
         */
        $requestedLead = LeadEsign::find()->where(['security_key' => $securityKey])->one();
        if($requestedLead && $requestedLead->load(\Yii::$app->request->post()) ){
            $requestedLead->saveClientSignature();
            $requestedLead->save();
            \Yii::$app->session->setFlash('success',"Signature saved! . Thank you for signing , we will contact you shortly");
            return $this->redirect(\Yii::$app->request->referrer);
        }
        return $this->render('index',['model'=>$requestedLead]);
    }

}
