<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\LeadEsign */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Lead Esigns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lead-esign-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'salutation',
            'firstname',
            'middlename',
            'lastname',
            'account_provider',
            'monthly_account_charge',
            'client_signature_image',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
