<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'My Yii Application';

$this->registerJsFile('js/jSignature/flashcanvas.js',['position'=>\yii\web\View::POS_END,'depends'=>\yii\web\JqueryAsset::className()]);
$this->registerJsFile('js/jSignature/jSignature.min.js',['position'=>\yii\web\View::POS_END,'depends'=>\yii\web\JqueryAsset::className()]);


$signaturePanelJs = <<< SCRIPT
$("#signaturePanel").jSignature();
$("#signaturePanel").bind('change',function(event) {
    jQuery("#client_signature").val($("#signaturePanel").jSignature("getData", "image")[1]);
});
    
SCRIPT;
$this->registerJs($signaturePanelJs, \yii\web\View::POS_READY);


?>
<script type="text/javascript">
    function resetSignature () {
        $("#signaturePanel").jSignature('reset');
    }

</script>
<div class="site-index">
    <div class="body-content">
        <h3 class="text-center">Sample Form</h3>
        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'options' => ['class' => 'form-horizontal'],
                'fieldConfig' => [
                ],
            ]); ?>
            <?= $form->field($model, 'salutation')->dropDownList(['Mr' => 'Mr', 'Mrs' => 'Mrs', "Ms" => "Ms"]) ?>
            <?= $form->field($model, 'firstname')->textInput() ?>
            <?= $form->field($model, 'middlename')->textInput() ?>
            <?= $form->field($model, 'lastname')->textInput() ?>
            <?= $form->field($model, 'account_provider')->dropDownList(['Test1' => 'Test2', 'Test3' => 'Test3']) ?>
            <?= $form->field($model, 'monthly_account_charge')->textInput() ?>
            <?= Html::label("Signature"); ?> 
            <div id="signaturePanel"></div>
            <?= $form->field($model, 'client_signature')->hiddenInput(['id'=>'client_signature'])->label("") ?>
            <div class="text-center">
                <?= Html::button('Reset signature panel', ['class' => 'btn btn-default', 'onclick' => 'resetSignature()']) ?>
            </div>
            <hr>
            <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
        </div>
    </div>
</div>
