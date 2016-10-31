<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AccountUser */

$this->title = 'Create Account User';
$this->params['breadcrumbs'][] = ['label' => 'Account Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
