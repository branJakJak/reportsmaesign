<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">

    <div class="row">

        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
            
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Login</h3>
                </div>
                <div class="panel-body">
                    <h1><?= Html::encode($this->title) ?></h1>

                    <p>Please fill out the following fields to login:</p>

                    <?php $form = ActiveForm::begin(); ?>

                        <?= $form->field($model, 'username') ?>

                        <?= $form->field($model, 'password')->passwordInput() ?>

                        <?= $form->field($model, 'rememberMe')->checkbox() ?>

                        <div class="form-group">
                            <div class="">
                                <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
                            </div>
                        </div>
                    <?php ActiveForm::end(); ?>            
                </div>
            </div>
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
            
        </div>
    </div>


</div>
