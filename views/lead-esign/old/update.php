<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LeadEsign */

$this->title = 'Update Lead Esign: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Lead Esigns', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lead-esign-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
