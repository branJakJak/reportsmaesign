<?php
/* @var $this yii\web\View */


use kartik\widgets\Growl;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->registerJsFile('js/jSignature/flashcanvas.js', ['position' => \yii\web\View::POS_END, 'depends' => \yii\web\JqueryAsset::className()]);
$this->registerJsFile('js/jSignature/jSignature.min.js', ['position' => \yii\web\View::POS_END, 'depends' => \yii\web\JqueryAsset::className()]);

$signaturePanelJs = <<< SCRIPT
$("#signaturePanel").jSignature();
$("#signaturePanel").bind('change',function(event) {
    jQuery("#client_signature").val($("#signaturePanel").jSignature("getData", "image")[1]);
});
    
SCRIPT;
$this->registerJs($signaturePanelJs, \yii\web\View::POS_READY);


?>



<script type="text/javascript">
    function resetSignature() {
        $("#signaturePanel").jSignature('reset');
    }
</script>
<div class="site-index">
    <div class="body-content">
    	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <?php if (Yii::$app->session->hasFlash('success')): ?>
            	<div class="alert alert-success">
            		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            		<strong>Done!</strong> <?= Yii::$app->session->getFlash('success') ?>
            	</div>

            <?php endif; ?>

            <?php
                $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'options' => ['class' => 'form-horizontal'],
                    'fieldConfig' => [
                    ],
                ]);
            ?>

            <div id="signaturePanel"></div>
            <?= $form->field($model, 'client_signature_image')->hiddenInput(['id' => 'client_signature'])->label("") ?>
            <div class="text-center">
                <?= Html::button('Reset signature panel', ['class' => 'btn btn-default', 'onclick' => 'resetSignature()']) ?>
            </div>
            <hr>
            <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
