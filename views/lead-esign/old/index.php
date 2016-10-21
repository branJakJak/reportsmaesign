<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lead Esigns';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lead-esign-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'salutation',
            'firstname',
            'lastname',
            [
                'header'=>'Something',
                'value'=>function($model){
                    return "wee";
                }
            ],
            // 'account_provider',
            // 'monthly_account_charge',
            // 'client_signature_image',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
