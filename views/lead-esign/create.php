<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LeadEsign */

$this->title = 'Create Lead Esign';
$this->params['breadcrumbs'][] = ['label' => 'Lead Esigns', 'url' => ['/lead-esign/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="lead-esign-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
