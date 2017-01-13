<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PPILead */

$this->title = 'Create Ppilead';
$this->params['breadcrumbs'][] = ['label' => 'Ppileads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ppilead-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
