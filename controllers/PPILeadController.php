<?php

namespace app\controllers;

use Yii;
use app\models\PPILead;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\ViewContextInterface;
use app\modules\api\NewPpiLeadFactory;
use app\models\LeadEsign;
use app\models\events\ClientSignaturePpiLead;
use app\models\events\PPIPdfFactory;

/**
 * PPILeadController implements the CRUD actions for PPILead model.
 */
class PPILeadController extends Controller implements ViewContextInterface
{
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
        ];
    }
    public function getViewPath()
    {
        return \Yii::getAlias("@app/views/ppilead");
    }
    public function actionForm()
    {
        $model = NewPpiLeadFactory::create();
        if ($model->load(Yii::$app->request->post())) {
            $clientSignaturePpiLeadEventListener = new ClientSignaturePpiLead();
            $clientSignaturePpiLeadEventListener->esignPdfFactory = new PPIPdfFactory();
            if ($model->would_you_still_receive_payment_details === 'other (please tell us more below)') {
                $model->would_you_still_receive_payment_details = \Yii::$app->request->post('would_you_still_receive_payment_details_other');
            }

            if (isset($model->date_of_birth)) {
                $model->date_of_birth = date("Y-m-d", strtotime($model->date_of_birth));
            }

            if (isset($model->reason_of_borrowing) && !empty($model->reason_of_borrowing)) {
                $model->reason_of_borrowing = implode(",", $model->reason_of_borrowing);
            }
            if (isset($model->bought_cover_with_ppi_insurance) && !empty($model->bought_cover_with_ppi_insurance)) {
                $model->bought_cover_with_ppi_insurance = implode(",", $model->bought_cover_with_ppi_insurance);
            }
            $borrowed_money_to_payoff_debt_details_temp_container = json_encode(\Yii::$app->request->post('borrowed_money_to_payoff_debt_details'));
            $model->borrowed_money_to_payoff_debt_details = $borrowed_money_to_payoff_debt_details_temp_container;

            if ($model->save()) {
                \Yii::$app->session->setFlash('success', "Success!");
                $model->trigger(PPILead::EVENT_NEW_LEAD);
                return $this->redirect("/success");
            }
        }

        if (isset($model->bought_cover_with_ppi_insurance)) {
            $model->bought_cover_with_ppi_insurance = explode(",", $model->bought_cover_with_ppi_insurance);
        }
        if (isset($model->reason_of_borrowing)) {
            $model->reason_of_borrowing = explode(",", $model->reason_of_borrowing);
        }
        if (isset($model->final_tick_checklist) && is_array($model->final_tick_checklist)) {
            $model->final_tick_checklist = implode(",", $model->final_tick_checklist);
        }
        if ($model->account_start_date) {
            $model->account_start_date = date("d-m-Y", strtotime($model->account_start_date));
        }
        if ($model->account_end_date) {
            $model->account_end_date = date("d-m-Y", strtotime($model->account_end_date));
        }
        if ($model->date_of_birth) {
            $model->date_of_birth = date("d-m-Y", strtotime($model->date_of_birth));
        }
        if ($model->when_did_transaction_take_place) {
            $model->when_did_transaction_take_place = date("d-m-Y", strtotime($model->when_trasaction_happen));
        }
        if ($model->first_complain_took_place) {
            $model->first_complain_took_place = date("d-m-Y", strtotime($model->when_first_complain_business));
        }


        return $this->render('form', [
            'model' => $model,
        ]);
    }

    /**
     * Lists all PPILead models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => PPILead::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PPILead model.
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
     * Creates a new PPILead model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PPILead();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PPILead model.
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
     * Deletes an existing PPILead model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PPILead model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PPILead the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PPILead::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
