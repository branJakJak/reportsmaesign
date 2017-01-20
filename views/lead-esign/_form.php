<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\LeadEsign */
/* @var $form ActiveForm */

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
    #leadesign-pdf_template label {
        text-align: center;
        padding: 20px;        
        border: 5px solid #808080;
        padding: 20px;
        margin: 20px;
        min-width: 250px;
        border-radius: 10px;
        cursor: pointer;

    }
    #leadesign-pdf_template > * {
        font-size: 20px;
    }
SCRIPT;
$this->registerCss($customCss);


// $this->registerCssFile('//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', ['depends' => [\yii\web\JqueryAsset::className()]]);

?>

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
</style>


<div class="container">
    <?php if (Yii::$app->session->hasFlash('success')): ?>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Success!</strong> <?= Yii::$app->session->getFlash('success') ?>
            </div>
        </div>
    </div>
    <?php endif ?>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <?= Html::errorSummary($model); ?>
        </div>
    </div>
    <div class="row">
        <div class="form">
            <?php $form = ActiveForm::begin(); ?>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <h1>
                            Add New Case
                        </h1>
                        <p>
                            Create a new case for sale.
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                        
                    </div>
                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                        <?= $form->field($model, 'hotkey')->dropDownList([''=>''])->label("Select Hotkey"); ?>
                    </div>
                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                        
                    </div>
                </div>
                <p>Hi it's Chris Thyer</p>
                <br>
                <br>
                <p>
                    I will just run through a few simple details to make sure it’s worth your while looking into, because we only look to take on a claim for you if we are confident there is a good chance of success and we can look to obtain a refund for you. I’m sure you’d agree if the account was sold unfairly and we can look to get your money back it’s much better in your pocket than the banks?
                </p>
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
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        Excellent, my name's Chris Thyer; feel free to stop me if you have any questions
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
                        <div id="tried_to_claim_for_package_details" class="hidden">
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
                            ->label("") 

                            ->radioList(['Yes'=>'Yes','No'=>'No'],['onchange'=>'toggleField(this,"wasClaimRejectedMoreInfo","Yes")'])
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
                        <p>
                            (Show understanding, any negative experiences need highlighting- note them up and recap if needed when completing Q.27 - SELL + Ask how customer felt about the poor service/level of cover)
                        </p>
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
                        <p>
                            At this point sell!!! – CLIENT you have been paying £XX for 999 years which is roughly £XXXX and it does not seem like you have made any/much use of the features. Based on this it is definitely worth your while to look into, let me check a few things so I’m not wasting your time...                            
                        </p>
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
                        <small>
                            (Many customers just saw 'account fee' or another unclear name for it and assumed it was standard - It's only recently - with all the banks mis-selling being public - that many consumers know they cant trust things and need to check for hidden charges)
                        </small>                        
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
                <div class="row">
                    Ok, again this is a familiar story and the thing is... a lot of the time the sales person shouldn’t have even been recommending an account to you, not only that if they did recommend it they should have asked you a lot of questions to make sure the account was suitable for you. Did they ask you much about your circumstances? (no) I’ll certainly make a note of this when we present your claim
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
                            ->hint("(prompt if unsure - any details about the advisor such as name or sex, where the conversation took place / the branch location if face to face etc)")
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
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        I’m sorry to hear that but it doesn’t surprise me, the thing is the bank staff were often incentivised to push these accounts and sell as many as possible, because of this customers like you ended up being pressured as the sales person was probably after a bonus or worried about their own job if they were behind target, I’ll certainly highlight this on your claim.
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
                        
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                        <div class="alert alert-info">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            If they didn’t explain any of this verbally they basically left you to read it in the small print, which is hardly fair is it? I’ll make a note on your claim..
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            If they didn’t explain any of this verbally they basically left you to read it in the small print, which is hardly fair is it? I’ll make a note on your claim..
                        </div>
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
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>If Yes</strong> 
                            Re-ask the question explaining what you mean to make sure the customer understood - and the account was mis-sold because this suggests they wanted the account!!
                            (Remember the banks have new rules since march 2013 - they now have to send mailings that are genuinely clear and prompt customers to check the account features are suitable - make sure they are not referring to a recent version.)
                        </div>
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
                        
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                        <div class="alert alert-info">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>If No</strong>         
                            Another thing they didn’t explain to you, this is an area the banks have had to tighten up on because people were being put at risk, imagine if you actually needed the travel insurance in another country and you found out you weren’t covered due to changes... just a few more questions...                        </div>
                        <div class="alert alert-warning">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>If Cant Remember</strong>
                            What I mean is did the agent explain that because the account just runs and runs, basically you will have it for years and there may be age limits on the insurance meaning some people were covered when they took the account but not in the future – did they explain this to you?                        
                        </div>
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
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                        <div class="alert alert-info">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>If No</strong> 
                            Another important thing hidden from you! The bank didn’t do very well explaining this to you by the sounds of it did they? No worries, everything is looking promising just a few more questions.,.
                        </div>                        
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
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        Review clients answers to the above and discredit the PBA's suitability further as applicable
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
                            <div class="alert alert-info">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>If Yes</strong> Ok (client name) this is one of the more serious examples of where customers were put at risk, again this is an area the banks have had to tighten up on because people were being put at risk, imagine if you actually needed the travel insurance in another country and you found out you weren’t covered due to your medical conditions...
                            </div>
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
                            ->hint("(Did you purchase travel insurance when you went abroad? / Gadget and mobile insurance often comes with ones Home Insurance, did that apply?)"); 
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
                        ->hint("(If unsure re-cap answers above and key mis-sell reasons evident - then Re-ask the question)E.G Because you didn’t need any of the products / Because you trusted the advisor and now realise nothing was explained clearly or you were misled / Were not given any other options / Were pressured in a time of need, perhaps when applying for a loan or finance")
                        ->textarea(['class'=>'col-xs-12 col-sm-12 col-md-12 col-lg-12','style'=>'margin-top: 0px; margin-bottom: 0px; height: 143px;']);
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <h1>RE-CAP & COMPLIANCE</h1>
                        <hr>
                        <p>
                            That's all the information I need from you, based on what you have told me today I am more than happy to take on this claim for you as I am confident we can look at getting this money back because it sounds like the account was sold unfairly and you may be due a significant refund.                            
                        </p>
                        <div class="alert alert-warning">
                            I just need to explain a few things for compliance and transparency purposes. Firstly, let me know if you have other ways of pursuing a claim, also you do of course have the right to seek further advice or shop around.
                        </div>

                        <div class="alert alert-warning">
                            We work in partnership with Money Active Ltd, one of the leading Packaged Account claim handlers in the UK. When we send your claim pack out, we introduce you and pass your information to Money Active so they know who you are when you return your pack. Money Active will then fight to get your money back as soon as possible and keep you updated throughout, ok?
                        </div>
                        <div class="alert alert-warning">
                            Now in terms of fees for the service, you will be pleased to hear that unless you cancel after the 14 day cooling off period we will only look to take a fee if we are successful in winning this money back for you.
                        </div>
                        <div class="alert alert-warning">
                            If we win this money back for you then at that stage we will charge 33% plus VAT, so we guarantee you will be left with over 60% of the winnings - we won’t ask you for any money upfront, if the claim is unsuccessful it will cost us and not you, how does that sound?
                        </div>
                        <div class="alert alert-warning">
                            I must point out that if you have the time and want to deal with the letters, forms and chasing the banks you can try claiming yourself without using an expert like us. How do you feel, do you want to do all of that yourself or are you happy to proceed with our service and let us take on PROVIDER for you?                        
                        </div>
                        <div class="alert alert-warning">
                            (Want Shop around reassurance) That’s fine and it’s only right you do some shopping around and go for what you feel comfortable with. I would urge you to check companies small print because sometimes there are hidden costs involved. We are one of the first to deal with this type of claim and have built up a lot of experience that we will look to use to your advantage.
                            At the end of the day only you can decide who to choose, trust and reliability are not easy to find and I hope to have made a good impression. What I’ll do is get the documents out to you and take it from there.                        
                        </div>
                        <div class="alert alert-warning">
                            (Might do it myself) That’s fine and if you feel confident doing it that way I would wish you the best of luck. All I would say is that it is in your interests to do some research so you understand the different ways these accounts were mis-sold. Bear in mind as well, that PROVIDER may say they did nothing wrong and you will then need to appeal to the Ombudsman service. It’s up to you, what I will do is get our documents out to you so we’re there if you want us and you can have a look into it in the mean time and take it from there
                        </div>
                        <div class="alert alert-info">
                            (You do it) Fantastic, we only take on your claim if we feel confident we can look at getting this money back for you and from what you have told me I think you have got a very good claim for the reasons I’ve mentioned so I have no issues in taking this on a no win no fee basis....how does that sound to you?
                        </div>

                        <div class="alert alert-warning">
                            It may take a few weeks or months to get an outcome and if the outcome is not acceptable the claim may be referred to the Financial Ombudsman Service but Money Active will keep on top of matters and keep you updated throughout the process. Just to make you aware, although we tell them not to, the bank may try to contact you directly... but do not get alarmed and simply let them know to contact Money Active as we are dealing with your claim, ok?                        
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        I just want to make sure we have as many contacts for you as possible so the Money Active claims handlers can contact you with any offers, what's your landline/mobile number?
                    </div>
                </div>
                <br>
                <br>
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
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                        <div>
                            (If apprehensive about giving one explain) We may need to speak to you urgently to get your claim processed efficiently so could I take a work number just in case of emergency? Emergency Contact Number? Family member etc, (just in case urgent update such as a problem with an offer and mobile has been lost etc)                                
                        </div>
                        <br>
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
                        ->hint("(Anything to make sure that you and claims handlers contact the client efficiently and in a manner to suit the individual client. e.g. Shift Patterns / Times not to call / Directions for Driver)")
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
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
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
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <p>
                            I have completed the claim documents for you, to save you hassle.
                            <br>
                            <br>
                            <br>
                            (If acc n0 not obtained) The only one bit of information you need to add is the account number and sort code.
                            <br>
                            <br>
                            <br>
                            (Ask for this earlier in the call and add it for client - less for them to do and therefore quicker return of pack).                            
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <h1>
                            Credit Rating
                        </h1>
                        <hr>
                            <p>
                                Now, a lot of people that I speak to are worried about claiming their money back because they think it’s going to affect their relationship with bank, I can assure you that claiming back this money should not affect your credit rating or your relationship with the bank in any way.
                            </p>
                            <br>
                            <p>
                                If all goes to plan, potentially we can claim back more money than what you paid into the account, as what we’re looking to do for you is not only claim back the fees you paid out we will also look to get you an additional 8% compensation per year...                            
                            </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <fieldset>
                                        <legend>Postal Close</legend>
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <p class="form-control-static">
                                                    (Make sure you don’t rush through this, the better the customer understands and agrees with you the better chance of the pack/s coming back quickly with minimal follow up calls)
                                                </p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <p class="form-control-static">
                                                    The process is very simple and easy, I will aim to ensure that all the information you gave me is recorded accurately and put together the best claim possible; so you don’t have to fill out any forms, ok? 
                                                </p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <p class="form-control-static">
                                                    I’ll explain briefly what to expect in the post so you are ready for it and you can get it back promptly; we want to get any refund money back in your pocket as soon as possible, don’t we?
                                                </p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <ol>
                                                    <li>There will be a welcome letter that explains about the service and a copy of the terms for you to keep safe.</li>
                                                    <li>It looks like there is a lot, but when you have a look at it, you’ll recognize it just reflects the call we have gone through - you just need to check it briefly and sign.</li>
                                                    <li>
                                                        The terms and conditions are there, I have already explained the key points to you, remember – about the fees and cooling off period etc?<br>
                                                        (Depending on customer/rapport –consider a humorous comment about how we do things properly – unlike the Banks!)<br>
                                                        ...We are not like the Banks, we don’t bury away things in the small print!!
                                                    </li>
                                                    <li>There are Letters of Authority – they simply give the bank your permission to deal with Money Active to try and get your money back.</li>
                                                    <li>Finally there is a form that gives your permission to appeal to the Ombudsman if the bank don’t pay out, this just means that if the bank reject your complaint unfairly you will still get any money you are entitled to.</li>
                                                    <li>So, that’s 6 signatures in total – they are highlighted yellow for your ease, I hope to have explained everything clearly so it’s really easy for you to just check, sign and return the documents straight away in the pre-paid envelope provided. Are you happy with everything we discussed?</li>
                                                    <li>Excellent, I will arrange a quick call for you in a few days just to make sure you have received the claim pack and answer any questions you may think of.</li>
                                                    <li>When will be a good time to call, so you have had chance to look over the claim pack? (arrange callback and ensure pack chasing is effective)</li>
                                                    <li>Once you return your pack, the claims experts at Money Active will then be in touch, keep you updated and hopefully have some good news for you.</li>
                                                    <li>Leave contact number for client (either office number or Money Active 01455 530 034)</li>
                                                </ol>
                                            </div>
                                        </div>
                                    </fieldset>                        
                    </div>
                </div>                


                <!-- appointment date -->
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <fieldset>
                        <legend>Appointment Close</legend>
                        <p>What I will do now is arrange an appointment for one of our drivers to collect the signed claim form(s) to avoid them getting lost in the post with your personal information on them, it’s all part of the service we offer and they can also answer any questions you may have. Now, looking at our diary we are seeing a lot of people in your area, let's have a look (brief pause) brilliant I can fit you in on Monday (Or DAY as advised by DC) what would be better for you, daytime or evening? Morning or Afternoon? / 6pm or 8pm? (Keep offering two options and find best time) Excellent I'll book that for</p>


                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-right">
                                <label class="form-label-exclusive">Appointment Date</label>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <?= 
                                    $form
                                    ->field($model, 'appointment_date')
                                    ->label("")
                                    ->widget(DatePicker::classname(), [
                                        'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                                        'pluginOptions' => [
                                            'autoclose'=>true,
                                            'format' => 'dd-mm-yyyy'
                                        ]
                                    ]);
                                ?>                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-right">
                                <label class="form-label-exclusive">Appointment Time</label>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <?php 
                                    $appointment_time_options = array();
                                    foreach (range(8, 20) as $currentHour) {
                                        foreach (range(0, 45 , 15) as $currentMinute) {
                                            if ($currentMinute === 0) {
                                                $currentMinute = "00";
                                            }
                                            $appointment_time_options["$currentHour:$currentMinute"] = "$currentHour:$currentMinute";
                                        }
                                    }
                                ?>
                                <?= 
                                    $form
                                    ->field($model, 'appointment_date')
                                    ->label("")
                                    ->dropDownList($appointment_time_options)
                                ?>                                    
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <br>
                            <p>Can you grab a pen and piece of paper so I can give you my contact details? Excellent my name xxx is and my number is 01455 530034. Also just make a note of your appointment which is <span id="appointmentDateSet">DD/MM/YYYY</span> &amp; <span id="appointmentTimeSet">HH:MM</span></p>
                            <p>I will also send you a text message so you have my details saved on your phone, As soon as we have collected the documents we will take care of everything from that point forward.</p>
                            <p>The advisor will bring out the claim forms just encase they don’t arrive in the post. I can also email the forms over to you for you to read in your own time and we will also send you a hard copy in the post. Can I just take your email address?</p>
                            <div class="form-group">
                                <label class="control-label col-md-4 text-right" style="margin-top: 30px">
                                    Client Contact Notes
                                </label>
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <?= 
                                        $form
                                        ->field($model, 'notes')
                                        ->label("")
                                        ->textArea(['style'=>"margin: 0px -20px 0px 0px; height: 174px; width: 561px;"])
                                    ?>
                                </div>
                            </div>
                        </div>
                    </fieldset>                        
                    <fieldset>
                        <legend>Check PPI</legend>
                        <div class="form-group">
                            <div class="col-md-12">
                                <p class="form-control-static">
                                    Since we will be looking into getting your money back on your bank account fees, we as a company also specialise in helping customers get their money back for their PPI so we could maybe help you with that as well at the same time, we go back nearly 20 years and we do not necessarily need paperwork, what loans, credit cards or mortgage have you had that you've not looked into?
                                </p>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>QC Call</legend>
                        <div class="form-group">
                            <div class="col-md-12">
                                <p class="form-control-static">
                                    Once we finish this call I’m going to put the information through to our quality control department, they just double check to make sure nothing has been over looked and give your claim the best chance of success. You will receive a very quick call from them to clarify a couple of details and make sure your time isn’t wasted. As soon as you take that call we’ll get the documents posted out to you, so it’s very important you take that call – will you be available within the next hour for a quick 2 minute call? (If not arrange time - ensure you have extra contact details / maybe fast track the QC call -ask manager)
                                </p>
                            </div>
                        </div>
                    </fieldset>                    


                    <fieldset>
                        <legend>Wrap up the call (Ensure additional claims are completed first)</legend>
                        <div class="form-group">
                            <div class="col-md-12">
                                <p class="form-control-static">
                                    What questions do you have for me?
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <p class="form-control-static">
                                    Do you understand what the banks have done wrong and why you are entitled to put in a claim? – (confirms if the customer has fully understood – if the customer understand exactly why they are entitled to claim they are more likely to sign and return the form)
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="alert alert-warning" role="alert">
                                    One last thing, please have a quick look for any documents you have that show the PBA charges, don’t worry but if you can find any it will only help.
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>End the call with a positive</legend>
                        <div class="form-group">
                            <div class="col-md-12">
                                <p class="form-control-static">
                                    Well <span class="client-name">CLIENT</span> from what you have told me I can’t see any reason we can’t look at getting this money back for you; the claims experts at Money Active will aim to get the maximum refund for you, as quickly as possible.
                                </p>
                            </div>
                        </div>
                    </fieldset>
                    <br>
                    <br>

                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">PDF Template</h3>
                        </div>
                        <div class="panel-body">
                            <fieldset>
                                <legend>Choose Template : </legend>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <p class="form-control-static">
                                            <?= 
                                                $form->field($model, 'pdf_template')
                                                    ->radioList([
                                                    'Original'=>"<br>Non Affiliate<br> <i class='fa fa-file-pdf-o' style='font-size: 50px;'></i> ",
                                                    'PBA Form'=>"<br>PBA Affiliate<br> <i class='fa fa-file-pdf-o' style='font-size: 50px;'></i>"
                                                    ], 
                                                    ['encode'=>false])
                                                    ->label(""); 
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            </fieldset>                            
                        </div>
                    </div>

                    </div>
                </div>



                <hr>
                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary btn-lg btn-block','style'=>'font-size: 30px']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div><!-- _form -->
    </div>
</div>
