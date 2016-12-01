<?php
/* @var $this yii\web\View */


use kartik\widgets\Growl;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use kartik\date\DatePicker;

$this->registerJsFile('js/jSignature/flashcanvas.js', ['position' => \yii\web\View::POS_END, 'depends' => \yii\web\JqueryAsset::className()]);
$this->registerJsFile('js/jSignature/jSignature.min.js', ['position' => \yii\web\View::POS_END, 'depends' => \yii\web\JqueryAsset::className()]);

$signaturePanelJs = <<< SCRIPT
$("#signaturePanel").jSignature();
$("#signaturePanel").bind('change',function(event) {
    jQuery("#client_signature").val($("#signaturePanel").jSignature("getData", "image")[1]);
});
    
SCRIPT;
$this->registerJs($signaturePanelJs, \yii\web\View::POS_READY);

$customCss = <<< SCRIPT
    .form-label-exclusive{
        padding-top: 30px;
    }
    .personal-info-labels {
        padding-top: 10px;
    }
    #has_registered_doctor_during_upgrade_container label , #has_account_upgraded_downgraded_container label,#howWasPackageContainer label , #leadesign-reason_to_takeout_packaged_account_reason_of_speaking label {
        display: block;
    }
SCRIPT;
$this->registerCss($customCss);




?>



<script type="text/javascript">
    function resetSignature() {
        $("#signaturePanel").jSignature('reset');
    }
</script>


<script type="text/javascript">
    function toggleByMultipleCondition(currentDomSelected,fieldToReveal,conditionArr) {
        var selectedRadioBtn = jQuery(currentDomSelected).find("input[type='radio']:checked").val();
        if (  $.inArray(selectedRadioBtn, conditionArr) !== -1) {
            jQuery("#"+fieldToReveal).removeClass('hidden');
        } else {
            jQuery("#"+fieldToReveal).addClass('hidden');
        }
    }
    function toggleField(currentDomSelected,fieldToReveal,condition) {
        var selectedRadioBtn = jQuery(currentDomSelected).find("input[type='radio']:checked").val();
        if (selectedRadioBtn == condition || condition == "*") {
            jQuery("#"+fieldToReveal).removeClass('hidden');
        }
        else {
            jQuery("#"+fieldToReveal).addClass('hidden');
        }
    }
    function disableAccountEnd() {
        jQuery("#leadesign-account_end_date").prop('disabled', function(i, v) { return !v; });
    }
</script>
<style type="text/css">
    #leadesign-bank_account_status label,#leadesign-address_while_bank_opened label {
        display: block;
    }
    input[type='radio'] {
        margin-left: 20px;
    }
</style>
    <div class="row">
        <div class="form">
            <?php $form = ActiveForm::begin(); ?>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <h1>
                            Final Step
                        </h1>
                        <p>
                            Review your information before afixing your signature.
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                        
                    </div>
                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">

                    </div>
                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-right ">
                        <label class='control-label form-label-exclusive'>Can I take your name please?</label>
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <?= $form->field($model, 'salutation')->dropDownList(['Mr'=>'Mr','Mrs'=>'Mrs','Ms'=>'Ms'])->label("") ?>
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <?= $form->field($model, 'firstname')->label("") ?>
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <?= $form->field($model, 'lastname')->label("") ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-right">
                        <label class="control-label form-label-exclusive">Is the account just in your name or joint names?</label>
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                        <?= $form->field($model, 'account_type')->dropDownList(['Single'=>'Single','Joint'=>'Joint'])->label("") ?>

                    </div>
                </div>
 
                <br>
                <br>
                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-right">
                        <label class="control-label form-label-exclusive text-right">Account Provider</label>
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                        <?= $form->field($model, 'account_provider')->dropDownList([
                            "Barclays"=>"Barclays",
                            "Clydesdale"=>"Clydesdale",
                            "Co-op"=>"Co-op",
                            "Halifax"=>"Halifax",
                            "HSBC Bank Plc"=>"HSBC Bank Plc",
                            "Lloyds TSB"=>"Lloyds TSB",
                            "NatWest"=>"NatWest",
                            "Royal Bank of Scotland"=>"Royal Bank of Scotland",
                            "Santander"=>"Santander",
                            "First Direct"=>"First Direct",
                            "Bank of Scotland"=>"Bank of Scotland",
                            "Yorkshire Bank PLC"=>"Yorkshire Bank PLC",
                            "Ulster Bank"=>"Ulster Bank",
                            "Nationwide"=>"Nationwide",
                            "Lloyds - SAR"=>"Lloyds - SAR",
                            "Citibank International Limited"=>"Citibank International Limited",
                            "Danske Bank"=>"Danske Bank",                    
                        ])->label("") ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <label class="control-label form-label-exclusive text-right">
                            Monthly Account Charge (approximate)
                        </label>
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><br>
                        <?= $form->field($model, 'monthly_account_charge' ,['template'=>'
                           <div class="input-group col-sm-4 ">
                              <span class="input-group-addon">
                                 <span class="fa fa-gbp"></span>
                              </span>
                              {input}
                           </div>
                           {error}{hint}
                        '])->label("") ?>
                    </div>
                </div>


                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <label class="control-label form-label-exclusive text-right">
                            Account Start Date (approx)
                        </label>
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><br>
                        <?= $form
                            ->field($model, 'account_start_date') 
                            ->widget(DatePicker::classname(), [
                                'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                                'pluginOptions' => [
                                    'autoclose'=>true,
                                    'format' => 'dd-mm-yyyy'
                                ]
                            ])
                            ->label("")
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <label class="control-label form-label-exclusive text-right">
                            Account End Date (approx)
                        </label>
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><br>
                        <?= $form
                            ->field($model, 'account_end_date') 
                            ->widget(DatePicker::classname(), [
                                'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                                'pluginOptions' => [
                                    'autoclose'=>true,
                                    'format' => 'dd-mm-yyyy'
                                ]
                            ])
                            ->label("")
                        ?>
                        <?= $form->field($model, 'is_ongoing')->checkbox([
                            'onclick'=>'disableAccountEnd()'
                        ]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <label class="control-label form-label-exclusive text-right">
                            Have you ever tried to claim back your money for this packaged account yourself or through another company?
                        </label>
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><br>
                        <?= 
                        $form
                            ->field($model, 'tried_to_claim_for_package')
                            ->label("")
                            ->radioList(['Yes'=>'Yes','No'=>'No'],['onchange'=>'toggleField(this,"tried_to_claim_for_package_details","Yes")'])
                        ?>
                        <br>
                        <br>
                        <div id="tried_to_claim_for_package_details" class="hidden">asd

                            <?= 
                            $form
                                ->field($model, 'tried_to_claim_for_package_details')
                                ->label("") 
                                ->textarea(['class'=>'col-xs-12 col-sm-12 col-md-12 col-lg-12','style'=>'margin-top: 0px; margin-bottom: 0px; height: 143px;'])
                            ?>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <label class="control-label form-label-exclusive">
                            1. Have you ever made a claim on any of the insurance products or breakdown cover provided by the packaged bank account?
                        </label>
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><br>
                        <?= 
                        $form
                            ->field($model, 'tried_to_claim_for_insurance_products')
                            ->radioList(['Yes'=>'Yes','No'=>'No'],['onchange'=>'toggleField(this,"wasClaimRejectedMoreInfo","Yes")'])
                            ->label("")
                        ?>
                    </div>
                </div>
                <!-- show if yes -->
                <div id='wasClaimRejectedMoreInfo' class="hidden">
                    <div class="row" >
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                            <label class="control-label form-label-exclusive">
                                1B. Was your claim rejected?
                            </label>
                        </div>
                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><br>
                            <?= $form->field($model, 'tried_to_claim_for_insurance_products_is_rejected')->radioList(['Yes'=>'Yes','No'=>'No'])->label("") ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                            <label class="control-label form-label-exclusive">
                                1C. Please give details
                            </label>
                        </div>
                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><br>
                            <?= $form->field($model, 'tried_to_claim_for_insurance_products_rejection_reason')->textarea()->label("") ?>
                        </div>
                    </div>
                </div>
                <!-- end -->
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <br>
                        <br>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <label class="control-label form-label-exclusive">
                            2. Have you used any of the other benefits of the packaged bank account – for example, a preferential overdraft rate, a preferential savings rate, a preferential loan rate, a monthly film subscription or any other discounts?                        
                        </label>
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><br>
                        <?= 
                            $form
                            ->field($model, 'used_benefits_packaged_bank')
                            ->label("")
                            ->radioList(['Yes'=>'Yes','No'=>'No'],['onchange'=>'toggleField(this,"usedBenefitsMoreDetailsContainer","Yes")'])
                        ?>
                    </div>
                </div>
                <!-- show this if yes -->
                <div class="hidden" id="usedBenefitsMoreDetailsContainer">
                    <div class="row" >
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                            <label class="control-label form-label-exclusive">
                                2B. Please give details
                            </label>
                        </div>
                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><br>
                        <?= 
                        $form
                            ->field($model, 'used_benefits_packaged_bank_details')
                            ->label("") 
                            ->textarea(['class'=>'col-xs-12 col-sm-12 col-md-12 col-lg-12','style'=>'margin-top: 0px; margin-bottom: 0px; height: 143px;']);
                        ?>
                        </div>
                    </div>
                     <div class="row">
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                            <label class="control-label form-label-exclusive">
                                2C. Do you know specifically how much of a benefit this gave you, if any? (e.g. if it was a preferential rate how much did it save them? - was this made clear at the point of sale? Does client know if it actually saved them them more than the fees for the PBA?)
                            </label>
                        </div>
                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><br>
                        <?= 
                        $form
                            ->field($model, 'know_benefit')
                            ->label("")
                            ->radioList(['Yes'=>'Yes','No'=>'No'])
                        ?>

                        </div>
                    </div>

                </div>
                <!-- end -->
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <br>
                        <br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <label class="control-label form-label-exclusive">
                            3. Have you registered for any of the benefits provided by your packaged account (e.g. registered mobile phone/s)
                        </label>
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><br>
                        <?= $form
                            ->field($model, 'registered_benefits_by_packaged_account')
                            ->label("")
                            ->radioList(['Yes'=>'Yes','No'=>'No'],['onchange'=>'toggleField(this,"registeredBenefirstDetails","Yes")']); 
                        ?>
                        <br>
                        <div id="registeredBenefirstDetails" class="hidden">
                            <?= $form
                            ->field($model, 'registered_benefits_by_packaged_account_details')
                            ->label("")
                            ->textarea(['class'=>'col-xs-12 col-sm-12 col-md-12 col-lg-12','style'=>'margin-top: 0px; margin-bottom: 0px; height: 143px;']); ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <label class="control-label form-label-exclusive">
                            3B. What do you understand the features and benefits of the account to be? (Show understanding and bear in mind when asking other questions / selling & explaining etc)
                        </label>
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                    <br>
                        <?= 
                        $form
                            ->field($model, 'understanding_of_features_and_benefits')
                            ->label("")
                            ->textarea(['class'=>'col-xs-12 col-sm-12 col-md-12 col-lg-12','style'=>'margin-top: 0px; margin-bottom: 0px; height: 143px;'])
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <label class="control-label form-label-exclusive">
                            4. At the time you opened or upgraded the packaged bank account, or shortly afterwards, was your main address outside of the United Kingdom?
                        </label>
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><br>
                        <?= 
                            $form
                            ->field($model, 'address_while_bank_opened') 
                            ->label("") 
                            ->radioList(['Non UK Address'=>'Non UK Address','UK Address'=>'UK Address'])
                        ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <label class="control-label form-label-exclusive">
                            5. Is the Account in Arrears, Debt Management, IVA or have you been bankrupt since taking the account?
                        </label>
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><br>
                        <?= 
                            $form
                            ->field($model, 'bank_account_status') 
                            ->label("") 
                            ->radioList([
                                'Account In Arrears'=>'Account In Arrears',
                                'Account In Debt Management'=>'Account In Debt Management',
                                'Account In IVA'=>'Account In IVA',
                                'Bankrupt'=>'Bankrupt',
                                'None of the above'=>'None of the above',
                            ],['onchange'=>'toggleByMultipleCondition(this,"bankAccountStatusCommentDetails",["Account In Arrears", "Account In Debt Management", "Account In IVA", "Bankrupt"]  )'])
                        ?>
                        <div id="bankAccountStatusCommentDetails" class="hidden">
                            <?= 
                                $form
                                    ->field($model, 'bank_account_status_comment')
                                    ->label("")
                                    ->textarea(['class'=>'col-xs-12 col-sm-12 col-md-12 col-lg-12','style'=>'margin-top: 0px; margin-bottom: 0px; height: 143px;'])
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row" id="has_account_upgraded_downgraded_container">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <label class="control-label form-label-exclusive">
                            6A. Has your account been upgraded or downgraded to any other packaged account types during the period you have been paying the monthly fees?                        
                        </label>
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><br>
                        <?= 
                            $form
                                ->field($model, 'has_account_upgraded_downgraded') 
                                ->label("")
                                ->radioList(['Yes'=>'Yes','No'=>'No'],['onchange'=>'toggleField(this,"upgradeComment","Yes")'])
                        ?>
                    
                    </div>
                </div>
                <div class="row hidden" id="upgradeComment">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <label class="control-label form-label-exclusive">
                            6B. Was there one upgrade in particular that you were most unhappy with?
                        </label>
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><br>
                        <?=
                            $form
                                ->field($model, 'upgrade_comment')
                                ->label("")
                                ->textarea(['class'=>'col-xs-12 col-sm-12 col-md-12 col-lg-12','style'=>'margin-top: 0px; margin-bottom: 0px; height: 143px;']);
                        ?>
                    </div>
                </div>                

                <div class="row" id="howWasPackageContainer">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <label class="control-label form-label-exclusive">
                            6C. How was the packaged bank account sold to you?
                        </label>
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><br>
                        <?= 
                            $form
                            ->field($model, 'how_packaged_bank_account_sold') 
                            ->label("") 
                            ->radioList([
                                'During a meeting'=>'During a meeting',
                                'Over the phone'=>'Over the phone',
                                'Over the internet'=>'Over the internet',
                                'By post'=>'By post',
                                'I filled in a leaflet'=>'I filled in a leaflet',
                                'Over the counter'=>'Over the counter',
                                'Can\'t remember'=>'Can\'t remember',
                                'Other'=>'Other',
                            ],['onchange'=>'toggleField(this,"how_packaged_bank_account_sold_details_container","Other")'])
                        ?>
                        <br>
                        <div id="how_packaged_bank_account_sold_details_container" class="hidden">
                            <?= 
                                $form
                                ->field($model, 'how_packaged_bank_account_sold_details')
                                ->label("")
                                ->textarea(['class'=>'col-xs-12 col-sm-12 col-md-12 col-lg-12','style'=>'margin-top: 0px; margin-bottom: 0px; height: 143px;']);
                            ?>
                        </div>
                    </div>
                </div>

                <div class="row" id="whatPromptedToTakeContainer">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <label class="control-label form-label-exclusive">
                            7. Tell me, what prompted you to take out the packaged account?
                        </label>
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><br>
                        <?= 
                            $form
                            ->field($model, 'reason_to_takeout_packaged_account_reason_of_speaking')
                            ->label("")
                            ->radioList([
                                    'Actively enquired about a packaged account'=>'Actively enquired about a packaged account',
                                    'The Account was suggested by the bank/building society representative'=>'The Account was suggested by the bank/building society representative',
                                    'Account was suggested to me but I only discovered the actual charges & type of account at a later stage'=>'Account was suggested to me but I only discovered the actual charges & type of account at a later stage',
                                    'Enquired about another product and told taking the packaged account was a condition of acceptance'=>'Enquired about another product and told taking the packaged account was a condition of acceptance',
                                    'Enquired about another product (e.g. overdraft / loan) and told that taking this account was the best option for me by the bank representative'=>'Enquired about another product (e.g. overdraft / loan) and told that taking this account was the best option for me by the bank representative',
                                    'I was not aware my account had been ‘upgraded’ until discovering the charges at a later stage'=>'I was not aware my account had been ‘upgraded’ until discovering the charges at a later stage',
                                    'I received a letter stating my account was automatically being upgraded but it did not tell me that I would be charged a fee'=>'I received a letter stating my account was automatically being upgraded but it did not tell me that I would be charged a fee',
                                    'I received a letter stating my account was automatically being upgraded to a packaged account, I was not given any choice, it was presented as a non-optional automatic change to my account'=>'I received a letter stating my account was automatically being upgraded to a packaged account, I was not given any choice, it was presented as a non-optional automatic change to my account',
                                ],
                            ['onchange'=>'toggleField(this,"thinkBackSummaryContainer","Account was suggested to me but I only discovered the actual charges & type of account at a later stage")'])
                        ?>
                    </div>
                </div>
                <div class="row" id="thinkBackSummaryContainer">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <label class="control-label form-label-exclusive">
                            7B. Try and think back, what was the actual reason you were speaking with the bank that day?
                        </label>
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><br>
                        <?= 
                            $form
                            ->field($model, 'reason_to_takeout_packaged_account_reason_of_speaking')
                            ->label("")
                            ->textarea(['class'=>'col-xs-12 col-sm-12 col-md-12 col-lg-12','style'=>'margin-top: 0px; margin-bottom: 0px; height: 143px;']);
                        ?>  
                    </div>
                </div>         
                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <label class="control-label form-label-exclusive">
                            8. Did you notice the account fees on your statement?
                        </label>
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><br>
                        <?= 
                            $form
                            ->field($model, 'noticed_account_fees')
                            ->label("")
                            ->radioList(['Yes'=>'Yes','No'=>'No'],['onchange'=>'toggleField(this,"noticed_account_fees_details_container","Yes")']);
                        ?>
                    </div>
                </div>
                <div class="row" id="noticed_account_fees_details_container">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <label class="control-label form-label-exclusive">
                            8B. Because part of your complaint will be that you didn't know you were paying a fee for a packaged account - please tell me when you first noticed the fees and what you thought they were for?
                        </label>
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><br>
                         <?= 
                             $form
                                ->field($model, 'noticed_account_fees_details') 
                                ->label("") 
                                ->textarea(['class'=>'col-xs-12 col-sm-12 col-md-12 col-lg-12','style'=>'margin-top: 0px; margin-bottom: 0px; height: 143px;']);
                         ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <label class="control-label form-label-exclusive">
                            9. At the time you opened or upgraded to the packaged bank account, did you actually take out any other products with the bank (for example a credit card, loan, overdraft, mortgage or savings account)?
                        </label>
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><br>
                        <?= 
                            $form
                            ->field($model, 'actually_take_out_other_prodcuts') 
                            ->label("") 
                            ->radioList(['Yes'=>'Yes','No'=>'No'],['onchange'=>'toggleField(this,"actually_take_out_other_prodcuts_details_container","Yes")'])
                        ?>
                    </div>
                </div>
                <div id="actually_take_out_other_prodcuts_details_container" class="hidden">
                    <div class="row" id="actually_take_out_other_prodcuts_details_container">
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                            <label class="control-label form-label-exclusive">
                            </label>
                        </div>
                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><br>
                            <?= 
                                $form
                                ->field($model, 'actually_take_out_other_prodcuts_details') 
                                ->label("") 
                                ->textarea(['class'=>'col-xs-12 col-sm-12 col-md-12 col-lg-12','style'=>'margin-top: 0px; margin-bottom: 0px; height: 143px;'])
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                            <label class="control-label form-label-exclusive">
                                9B. Did the bank discuss other options with you that DIDN'T involve a packaged bank account, or did they only talk to you about upgrading to a packaged bank account as the way of getting the overdraft / loan / mortgage etc?
                            </label>
                        </div>
                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><br>
                          <?= 
                            $form
                            ->field($model, 'discuss_not_involed_packaged') 
                            ->label("")
                            ->radioList(['Yes'=>'Yes','No'=>'No'],['onchange'=>'toggleField(this,"discuss_not_involed_packaged_details_container","Yes")']);
                          ?>
      
                        </div>
                    </div>
                    <div class="row hidden" id='discuss_not_involed_packaged_details_container'>
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                            <label class="control-label form-label-exclusive">
                                9C. What other options and why did you end up with the packaged bank account?
                            </label>
                        </div>
                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><br>
                            <?= 
                            $form
                            ->field($model, 'discuss_not_involed_packaged_details') 
                            ->label("") 
                            ->textarea(['class'=>'col-xs-12 col-sm-12 col-md-12 col-lg-12','style'=>'margin-top: 0px; margin-bottom: 0px; height: 143px;'])
                            ?>
                        </div>
                    </div>
                </div>   

                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <label class="control-label form-label-exclusive">
                            10. When they sold you the account did they give you advice or recommend that it was a good idea for you to take out the packaged account?
                        </label>
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><br>
                        <?= 
                            $form
                            ->field($model, 'did_they_give_advice_clarify')
                            ->label("")
                            ->radioList(['Yes'=>'Yes','No'=>'No',"Can't Remember"=>"Can't Remember",],['onchange'=>'toggleField(this,"did_they_give_advice_clarify_details","Yes")'])
                        ?>
                    </div>
                </div>                
                <div class="row" id="did_they_give_advice_clarify_details">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <label class="control-label form-label-exclusive">
                            10B. Please clarify further - most of these accounts the Banks say were not recommended but we find that the bank staff often recommended them to people because they were on commission - I appreciate it was a while ago but try and think back... tell me more about how the sales person made you feel it was a good idea to take the account; the more detail you can recollect the better?
                        </label>
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><br>
                        <?= 
                            $form
                            ->field($model, 'did_they_give_advice_clarify_details')
                            ->label("")
                            ->textarea(['class'=>'col-xs-12 col-sm-12 col-md-12 col-lg-12','style'=>'margin-top: 0px; margin-bottom: 0px; height: 143px;']);
                        ?>                    
                    </div>
                </div>



                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <label class="control-label form-label-exclusive">
                            11. Did you feel you were put under pressure to take out the account?
                        </label>
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><br>
                        <?= 
                        $form
                            ->field($model, 'felt_under_pressure')
                            ->label("")
                            ->radioList([
                                'Yes'=>'Yes','No'=>'No'],['onchange'=>'toggleField(this,"felt_under_pressure_details_container","Yes")']);
                        ?>
                    </div>
                </div>
                <div class="row" id="felt_under_pressure_details_container">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <label class="control-label form-label-exclusive">
                            11B. Why did you feel pressured?
                        </label>
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><br>
                        <?= 
                        $form
                            ->field($model, 'felt_under_pressure_details')
                            ->label("")
                            ->textarea(['class'=>'col-xs-12 col-sm-12 col-md-12 col-lg-12','style'=>'margin-top: 0px; margin-bottom: 0px; height: 143px;'])
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <label class="control-label form-label-exclusive">
                            12. Before you opened or upgraded to the packaged bank account, had you ever had a free bank account in the UK?
                        </label>
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><br>
                        <?= 
                                $form
                                ->field($model, 'had_free_bank')
                                ->label("")
                                ->radioList(['Yes'=>'Yes','No'=>'No']); 
                        ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <label class="control-label form-label-exclusive">
                            13. Did the representative explain any of the main exclusions and limitations of the insurances?
                        </label>
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><br>
                        <?= 
                                $form
                                ->field($model, 'did_representative_explain_main_exclusions')
                                ->label("")
                                ->radioList(['Yes'=>'Yes','No'=>'No',"Can't Remember"]); 
                        ?>
                    </div>
                </div>


                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <label class="control-label form-label-exclusive">
                            14. Did the representative explain that you would receive written information and it was very important to read the exclusions, terms and limitations of each product?
                        </label>
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><br>
                        <?= 
                                $form
                                ->field($model, 'did_representative_explain_receive_written_info')
                                ->label("")
                                ->radioList(['Yes'=>'Yes','No'=>'No',"Can't Remember"=>"Can't Remember"]); 
                        ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <label class="control-label">
                            15. Did you ever receive any mailings in the post that made it clear and easy to understand the account and that you need to regularly review if it suited you?
                        </label>
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><br>
                        <?= 
                                $form
                                ->field($model, 'receive_any_mailing_post')
                                ->label("")
                                ->radioList(['Yes'=>'Yes','No'=>'No']); 
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <label class="control-label form-label-exclusive">
                            16. Did the representative explain that if your circumstances change in the future, that it may affect whether you are eligible for the insurances?
                        </label>
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><br>
                        <?= 
                                $form
                                ->field($model, 'explain_changes_effect_elligibility')
                                ->label("")
                                ->radioList(['Yes'=>'Yes','No'=>'No',"Can't Remember"=>"Can't Remember"]); 
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <label class="control-label form-label-exclusive">
                            17. Did the representative explain whether or not you would have to pay an excess to claim on any of the insurances?
                        </label>
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><br>
                        <?= 
                                $form
                                ->field($model, 'explain_pay_excess_claim_on_insurance')
                                ->label("")
                                ->radioList(['Yes'=>'Yes','No'=>'No',"Can't Remember"=>"Can't Remember"]); 
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <label class="control-label form-label-exclusive">
                            18. At the time you opened or upgraded the packaged bank account, did you hold a valid UK driving license?
                        </label>
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><br>
                        <?= 
                                $form
                                ->field($model, 'has_uk_driving_license_during_upgrade')
                                ->label("")
                                ->radioList(['Yes'=>'Yes','No'=>'No'],['onchange'=>'toggleField(this,"didOwnACarContainer","Yes")']);
                        ?>
                    </div>
                </div>

                <div class="row hidden" id="didOwnACarContainer">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <label class="control-label form-label-exclusive">
                            18B. Did you own/drive a car?
                        </label>
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><br>
                        <?= 
                            $form
                            ->field($model, 'own_a_car')
                            ->label("")
                            ->radioList(['Yes'=>'Yes','No'=>'No']); 
                        ?>
                    </div>
                </div>


                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <label class="control-label form-label-exclusive">
                            19. At the time you opened or upgraded to the packaged bank account, did you own a mobile phone?
                        </label>
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><br>
                        <?= 
                                $form
                                ->field($model, 'has_mobile_phone_during_upgrade')
                                ->label("")
                                ->radioList(['Yes'=>'Yes','No'=>'No'],['onchange'=>'toggleField(this,"smartphone_has_internet_access","Yes")'])
                        ?>
                    </div>
                </div>

                <div class="row" id="smartphone_has_internet_access">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <label class="control-label form-label-exclusive">
                            19B. Was it a smart phone (i.e. with internet access)?                       
                        </label>
                    </div>
                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        <?=
                            $form
                            ->field($model, 'has_mobile_phone_during_upgrade_has_internet_connection')
                            ->label("")
                            ->radioList(['Yes'=>'Yes','No'=>'No']); 
                        ?>
                    </div>
                </div>


                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <label class="control-label form-label-exclusive">
                            20. At the time you opened or upgraded to the packaged bank account, how often did you go on holiday?
                        </label>
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><br>
                        <table class="table table-col-striped">
                            <thead>
                                <tr>
                                    <th>I went on holiday...</th>
                                    <th>Never</th>
                                    <th>Occasionally but not every year</th>
                                    <th>1-3 times a year</th>
                                    <th>3+ times a year</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>in Europe (including the UK)</td>
                                    <!-- @TODo -possibly radio list here -->
                                    <td>   <?= $form->field($model, 'often_go_holiday_in_europe')->radio(['label'=>'','uncheck'=>null,'value' => 'Never']); ?>   </td>
                                    <td>   <?= $form->field($model, 'often_go_holiday_in_europe')->radio(['label'=>'','uncheck'=>null,'value' => 'Occasionally but not every year']); ?>   </td>
                                    <td>   <?= $form->field($model, 'often_go_holiday_in_europe')->radio(['label'=>'','uncheck'=>null,'value' => '1-3 times a year']); ?>   </td>
                                    <td>   <?= $form->field($model, 'often_go_holiday_in_europe')->radio(['label'=>'','uncheck'=>null,'value' => '3+ times a year']); ?>   </td>
                                </tr>
                                <tr>
                                    <td>outside of Europe</td>
                                    <td>   <?= $form->field($model, 'often_go_holiday_outside_europe')->radio(['label'=>'','uncheck'=>null,'value' => 'Never']); ?>   </td>
                                    <td>   <?= $form->field($model, 'often_go_holiday_outside_europe')->radio(['label'=>'','uncheck'=>null,'value' => 'Occasionally but not every year']); ?>   </td>
                                    <td>   <?= $form->field($model, 'often_go_holiday_outside_europe')->radio(['label'=>'','uncheck'=>null,'value' => '1-3 times a year']); ?>   </td>
                                    <td>   <?= $form->field($model, 'often_go_holiday_outside_europe')->radio(['label'=>'','uncheck'=>null,'value' => '3+ times a year']); ?>   </td>
                                </tr>
                                <tr>
                                    <td>and did winter sports</td>
                                    <td>   <?= $form->field($model, 'often_go_holiday_and_winter_sports')->radio(['label'=>'','uncheck'=>null,'value' => 'Never']); ?>   </td>
                                    <td>   <?= $form->field($model, 'often_go_holiday_and_winter_sports')->radio(['label'=>'','uncheck'=>null,'value' => 'Occasionally but not every year']); ?>   </td>
                                    <td>   <?= $form->field($model, 'often_go_holiday_and_winter_sports')->radio(['label'=>'','uncheck'=>null,'value' => '1-3 times a year']); ?>   </td>
                                    <td>   <?= $form->field($model, 'often_go_holiday_and_winter_sports')->radio(['label'=>'','uncheck'=>null,'value' => '3+ times a year']); ?>   </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>


                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <label class="control-label form-label-exclusive">
                            21. At the time you opened or upgraded to the packaged bank account, did you have any health problems?
                        </label>
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><br>
                        <?= 
                        $form
                            ->field($model, 'has_health_problems_during_upgrade')
                            ->label("")
                            ->radioList(['Yes'=>'Yes','No'=>'No'],['onchange'=>'toggleField(this,"has_health_problems_during_upgrade_details_container","Yes")']);
                        ?>
                    </div>
                </div>
                <div id="has_health_problems_during_upgrade_details_container">
                    <div class="row">
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                            <label class="control-label form-label-exclusive">
                                
                            </label>
                        </div>
                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><br>
                            <?= 
                            $form
                                ->field($model, 'has_health_problems_during_upgrade_details')
                                ->label("")
                                ->textarea(['class'=>'col-xs-12 col-sm-12 col-md-12 col-lg-12','style'=>'margin-top: 0px; margin-bottom: 0px; height: 143px;']);
                            ?>
                        </div>
                    </div>
                   <div class="row">
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                            <label class="control-label form-label-exclusive">
                                21B. Did the representative explain this may affect eligibility for the insurances
                            </label>
                        </div>
                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><br>
                            <?= 
                            $form
                                ->field($model, 'did_rep_explain_eligibility')
                                ->label("")
                                ->radioList(['Yes'=>'Yes','No'=>'No']);
                            ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <label class="control-label form-label-exclusive">
                            22. At the time you opened or upgraded to the packaged bank account, were you registered with a UK doctor?
                        </label>
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><br>
                        <?= 
                        $form
                        ->field($model, 'has_registered_doctor_during_upgrade')
                        ->label()
                        ->radioList(['Yes'=>'Yes','No'=>'No']); ?>
                    </div>
                </div>
                
                <div class="row" id="has_registered_doctor_during_upgrade_container">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <label class="control-label form-label-exclusive">
                            23. At the time or shortly after you opened or upgraded to the packaged bank account, did you already have any of the following products?
                        </label>
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><br>
                        <?= 
                            $form
                            ->field($model, 'after_upgrade_already_has_products')
                            ->label("")
                            ->checkboxList([
                                    "Car breakdown cover"=>"Car breakdown cover",
                                    "Accidental death cover"=>"Accidental death cover",
                                    "Gadget insurance"=>"Gadget insurance",
                                    "Mobile phone insurance"=>"Mobile phone insurance",
                                    "Life Assurance"=>"Life Assurance",
                                    "Travel insurance"=>"Travel insurance",
                                    "Identity theft insurance"=>"Identity theft insurance",
                                    "Any other insurance that was also included in your packaged bank account"=>"Any other insurance that was also included in your packaged bank account",
                            ],['onchange'=>'toggleField(this,"further_details_help_evidence_container","*")'])
                        ?>
                    </div>
                </div>

                <div class="row hidden" id="further_details_help_evidence_container">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <label class="control-label form-label-exclusive">
                            23B. Further Details (Any specifics will help evidence this and strengthen your claim)
                        </label>
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><br>
                        <?= 
                        $form
                            ->field($model, 'further_details_help_evidence')
                            ->label("")                            
                            ->textarea(['class'=>'col-xs-12 col-sm-12 col-md-12 col-lg-12','style'=>'margin-top: 0px; margin-bottom: 0px; height: 143px;']);
                        ?>
                    </div>
                </div>

                

                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <label class="control-label form-label-exclusive">
                            24. Did you keep the insurance after the sale of/upgrade to the packaged bank account?
                        </label>
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><br>
                        <?=
                        $form
                            ->field($model, 'did_kept_insurance_after_sale')
                            ->label("")
                            ->radioList(['Yes'=>'Yes','No'=>'No'],['onchange'=>'toggleField(this,"did_kept_insurance_after_sale_details_container","Yes")']);
                        ?>
                    </div>
                </div>
                <div id="did_kept_insurance_after_sale_details_container" class="hidden">
                    <div class="row">
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                            <label class="control-label form-label-exclusive">
                                24B. Please give details
                            </label>
                        </div>
                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><br>
                            <?=
                            $form
                                ->field($model, 'did_kept_insurance_after_sale_details')
                                ->label("")
                                ->textarea(['class'=>'col-xs-12 col-sm-12 col-md-12 col-lg-12','style'=>'margin-top: 0px; margin-bottom: 0px; height: 143px;']);
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                            <label class="control-label form-label-exclusive">
                                24C. Why did you keep the existing cover?
                            </label>
                        </div>
                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><br>
                            <?=
                            $form
                                ->field($model, 'reason_kept_existing_cover')
                                ->label("")
                                ->textarea(['class'=>'col-xs-12 col-sm-12 col-md-12 col-lg-12','style'=>'margin-top: 0px; margin-bottom: 0px; height: 143px;']);
                            ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <label class="control-label form-label-exclusive">
                            25. At the time you opened or upgraded to the packaged bank account, did you have any other packaged bank accounts?
                        </label>
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><br>
                        <?= 
                        $form
                            ->field($model, 'when_opened_account_has_other_account')
                            ->label("")
                            ->radioList(['Yes'=>'Yes','No'=>'No'],['onchange'=>'toggleField(this,"when_opened_account_has_other_account_details_container","Yes")']);
                        ?>
                        <br>
                        <br>
                        <div id="when_opened_account_has_other_account_details_container">
                            <?= 
                            $form
                                ->field($model, 'when_opened_account_has_other_account_details')
                                ->label("")
                                ->textarea(['class'=>'col-xs-12 col-sm-12 col-md-12 col-lg-12','style'=>'margin-top: 0px; margin-bottom: 0px; height: 143px;']);
                            ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <label class="control-label form-label-exclusive">
                            27. What do you feel most unhappy about with this account and how it was sold?
                        </label>
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><br>
                        <?= 
                        $form
                        ->field($model, 'reason_why_unhappy')
                        ->label("")
                        ->textarea(['class'=>'col-xs-12 col-sm-12 col-md-12 col-lg-12','style'=>'margin-top: 0px; margin-bottom: 0px; height: 143px;']);
                        ?>
                    </div>
                </div>
                <!-- personal information of customer -->
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-right">
                            <label class="personal-info-labels">
                                Landline
                            </label>

                        </div>
                        <div class="">
                            <?= $form->field($model, 'landline' ,['template'=>'
                               <div class="input-group col-sm-4 ">
                                  <span class="input-group-addon">
                                     <span class="fa fa-phone"></span>
                                  </span>
                                  {input}
                               </div>
                               {error}{hint}
                            '])->label("") ?>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-right">
                            <label class="personal-info-labels">
                                Mobile
                            </label>
                        </div>
                        <div class="">
                            <?= $form->field($model, 'mobile' ,['template'=>'
                               <div class="input-group col-sm-4 ">
                                  <span class="input-group-addon">
                                     <span class="fa fa-mobile"></span>
                                  </span>
                                  {input}
                               </div>
                               {error}{hint}
                            '])->label("") ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-right">
                            <label class="personal-info-labels">
                                What is your work number?
                            </label>
                        </div>
                        <div>
                            <?= $form->field($model, 'work_number' ,['template'=>'
                               <div class="input-group col-sm-4 ">
                                  <span class="input-group-addon">
                                     <span class="fa fa-phone"></span>
                                  </span>
                                  {input}
                               </div>
                               {error}{hint}
                            '])
                            ->label("");
                            ?>
                        
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-right">
                            <label class="personal-info-labels">
                                What is your email address?
                            </label>
                        </div>
                        <div class="">
                            <?= 
                            $form->field($model, 'email_address' ,['template'=>'
                               <div class="input-group col-sm-4 ">
                                  <span class="input-group-addon">
                                     <span class="fa fa-envelope"></span>
                                  </span>
                                  {input}
                               </div>
                               {error}{hint}    
                                '])
                            ->label("");
                            ?>
                        </div>
                    </div>
                </div>

                <div class="row">                
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-right">
                            <label class="personal-info-labels">
                                What is your preferred method of contact?
                            </label>
                        </div>
                        <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                            <?= 
                            $form
                            ->field($model, 'preferred_method_of_contact')
                            ->dropDownList(['Mobile'=>'Mobile','Work Number'=>'Work Number','Landline'=>'Landline','SMS'=>'SMS','Email'=>'Email','Any'=>'Any'])
                            ->label("");
                            ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-right">
                            <label class="personal-info-labels">
                                If we need to speak to you what is the best time to call?
                            </label>
                        </div>
                        <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                            <?= 
                            $form
                            ->field($model, 'best_time_to_call')
                            ->dropDownList([
                                    'Morning'=>'Morning',
                                    'Afternoon'=>'Afternoon',
                                    '5-6 PM'=>'5-6 PM',
                                    '6-7 PM'=>'6-7 PM',
                                    '7-8 PM'=>'7-8 PM',
                                    'Anytime'=>'Anytime'
                                ])
                            ->label("");
                            ?>
                        </div>
                    </div>
                </div>

                <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-right">
                        <label class="form-label-exclusive">
                            Client Contact Notes ?
                        </label>
                    </div>

                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                        <?= 
                        $form
                        ->field($model, 'client_contact_notes')
                        ->textArea(['style'=>'100%'])
                        ->label("");
                        ?>
                    </div>
                </div>
                </div>


                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-right">
                        <label class="form-label-exclusive">
                            Address 1
                        </label>
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-4 col-lg-4">
                        <?= 
                        $form
                        ->field($model, 'address1')
                        ->label("");
                        ?>
                    </div>
                </div>



                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-right">
                        <label class="form-label-exclusive">
                            Address 2
                        </label>
                    </div>

                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <?= 
                        $form
                        ->field($model, 'address2')
                        ->label("");
                        ?>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-right">

                        <label class="form-label-exclusive">
                            Address 3
                        </label>
                    </div>

                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <?= 
                        $form
                        ->field($model, 'address3')
                        ->label("");
                        ?>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-right">
                        <label class="form-label-exclusive">
                            Address 4
                        </label>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <?= 
                        $form
                        ->field($model, 'address4')
                        ->label("");
                        ?>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-right">
                        <label class="form-label-exclusive">
                            Postcode
                        </label>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <?= 
                        $form
                        ->field($model, 'postcode')
                        ->label("");
                        ?>
                    </div>
                </div>


                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-right">
                        <label class="form-label-exclusive">
                            Date of birth
                        </label>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <?= 
                        $form
                        ->field($model, 'date_of_birth')
                            ->widget(DatePicker::classname(), [
                                'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                                'pluginOptions' => [
                                    'autoclose'=>true,
                                    'format' => 'dd-mm-yyyy'
                                ]
                            ])
                        ->label("");
                        ?>
                    </div>
                </div>

                <div class="row">                
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-right">
                            <label class="form-label-exclusive">
                                Previous Name
                            </label>
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                            <?= 
                            $form
                            ->field($model, 'previous_name')
                            ->label("");
                            ?>
                        </div>
                    </div>
                </div>

                <div class="row">                
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-right">
                        <label class="form-label-exclusive">
                            Previous Address Line 1
                        </label>
                        </div>

                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                            <?= 
                            $form
                            ->field($model, 'previous_address1')
                            ->label("");
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-right">
                            <label class="form-label-exclusive">
                                Previous Address Line 2
                            </label>
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                            <?= 
                            $form
                            ->field($model, 'previous_address2')
                            ->label("");
                            ?>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-right">
                            <label class="form-label-exclusive">
                                Previous Address Line 3
                            </label>
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                            <?= 
                                $form
                                ->field($model, 'previous_address3')
                                ->label("");
                            ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-right">
                            <label class="form-label-exclusive">
                                Previous Address Line 4
                            </label>
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                            <?= 
                                $form
                                ->field($model, 'previous_address4')
                                ->label("");
                            ?>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-right">
                            <label class="form-label-exclusive">
                                Previous Postcode
                            </label>
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                            <?= 
                                $form
                                ->field($model, 'previous_postcode')
                                ->label("");
                            ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-right">
                            <label class="personal-info-labels">
                                Any other previous address that could have applied at the time of the account?
                            </label>
                        </div>
                        <div class="">
                            <?= 
                                $form
                                ->field($model, 'other_previous_address')
                                ->radioList(['Yes'=>'Yes','No'=>'No'],['onchange'=>'toggleField(this,"other_previous_address_details","Yes")'])
                                ->label("");
                            ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-right">
                            <label class="personal-info-labels">
                                Any other previous address that could have applied at the time of the account?
                            </label>                        
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                            <?= 
                            $form
                            ->field($model, 'other_previous_address_details')
                            ->textArea()
                            ->label("");
                            ?>
                        </div>
                    </div>
                </div>

                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" >
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-right">
                        <label class="form-label-exclusive">
                            Account Number
                        </label>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <?= 
                        $form
                        ->field($model, 'account_number')
                        ->label("");
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-right">
                            <label class="form-label-exclusive">
                                Sort Code
                            </label>
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                            <?= 
                                $form
                                ->field($model, 'sort_code')
                                ->label("");
                            ?>
                        </div>
                    </div>
                </div>
            <?php ActiveForm::end(); ?>
        </div><!-- _form -->
    </div>

<div class="site-index " style="margin-top: 100px;">
    <div class="body-content">
    	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <?php
                $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'options' => ['class' => 'form-horizontal'],
                    'fieldConfig' => [
                    ],
                ]);
            ?>

            <div id="signaturePanel" style='border: 1px solid black'></div>
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
