<?php

namespace app\controllers;

use Yii;
use app\models\LeadEsign;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LeadEsignController implements the CRUD actions for LeadEsign model.
 */
class LeadEsignController extends Controller
{
    public $layout = "dashboard";
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['view','index','create','update','resend'],
                'rules' => [
                    [
                        'actions' => ['view','index','create','update','resend'],
                        'allow' => true,
                        'roles' => ['admin','agent'],
                    ],
                ],
            ],            
        ];
    }


    /**
     * Lists all LeadEsign models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => LeadEsign::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LeadEsign model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new LeadEsign model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new LeadEsign();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing LeadEsign model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing LeadEsign model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionResend($id)
    {
        $model = LeadEsign::find()
            ->where(['id'=>$id])
            ->one();
        if (!$model) {
            throw new NotFoundHttpException("Sorry that lead doesnt exists");
        }else {
            $model->on(LeadEsign::LEAD_ESIGN_NEW_LEAD, ['app\models\events\NewLeadEventHandler', 'handle'],$model);
            $model->trigger(LeadEsign::LEAD_ESIGN_NEW_LEAD);
            Yii::$app->session->setFlash('success', 'Confirmation link sent');
        }
        
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Finds the LeadEsign model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LeadEsign the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LeadEsign::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
