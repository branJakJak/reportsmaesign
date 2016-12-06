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
    .under-heading {
        text-decoration: underline;
    }
    .section-header , .sub-section-header {
        color : #31708F;
    }
    .sub-section-header {
        color : #947F8F;
    }
    #leadesign-after_upgrade_already_has_products > label {
        padding: 10px
    }
    .section-g-tick {
        color: #317099;
        background: #D9EDF7;
        margin-top: 23px;
        padding: 20px;
    }
    .section-g-tick label {
        display: block;
    }

SCRIPT;
$this->registerCss($customCss);




/*font awesome*/
$this->registerCssFile('//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
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
                <div class="alert">
                    <h3>
                        <strong>Final Step</strong>
                        <p>
                            Review your information before afixing your signature.
                        </p>
                    </h1>
                </div>                
                <div class="row">
                </div>
                <div class="alert">
                    <h3>
                        <strong>Money Active System Reference</strong>
                        <p>
                            <?= Html::encode($model->security_key); ?>
                        </p>
                    </h1>
                </div>
                </div>

                <br>
                <div class="row">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">Personal Information</h3>
                        </div>
                        <div class="panel-body">
                            <div class="col-lg-12">                                
                                <div class="col-lg-6">
                                    <legend>Name</legend>
                                    <?= $form->field($model, 'salutation')->dropDownList(['Mr'=>'Mr','Mrs'=>'Mrs','Ms'=>'Ms']) ?>
                                    <?= $form->field($model, 'firstname') ?>
                                    <?= $form->field($model, 'lastname') ?>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <legend>Previous Name</legend>
                                    <?= $form->field($model, 'previous_name')?>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
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
                                        ->label("Date of birth");
                                    ?>
                                    <br>
                                    <legend>Contact Information</legend>
                                    <label class="personal-info-labels">Landline</label>
                                   <?= $form->field($model, 'landline' ,['template'=>'
                                       <div class="input-group col-lg-12 ">
                                          <span class="input-group-addon">
                                             <span class="fa fa-phone"></span>
                                          </span>
                                          {input}
                                       </div>
                                       {error}{hint}
                                    ']) ?>
                                    <label class="personal-info-labels">
                                        Mobile
                                    </label>                                    
                                    <?= 
                                    $form->field($model, 'mobile' ,['template'=>'
                                       <div class="input-group col-lg-12 ">
                                          <span class="input-group-addon">
                                             <span class="fa fa-mobile"></span>
                                          </span>
                                          {input}
                                       </div>
                                       {error}{hint}
                                    '])
                                    ?>
                                    <label class="personal-info-labels">
                                        Work number
                                    </label>                                    
                                    <?= $form->field($model, 'work_number' ,['template'=>'
                                       <div class="input-group col-lg-12">
                                          <span class="input-group-addon">
                                             <span class="fa fa-phone"></span>
                                          </span>
                                          {input}
                                       </div>
                                       {error}{hint}
                                    '])
                                    ?>
                                    <label class="personal-info-labels">
                                        Email address
                                    </label>
                                    <?= 
                                        $form->field($model, 'email_address' ,['template'=>'
                                           <div class="input-group col-lg-12">
                                              <span class="input-group-addon">
                                                 <span class="fa fa-envelope"></span>
                                              </span>
                                              {input}
                                           </div>
                                           {error}{hint}    
                                        '])
                                    ?>
                                                                    
                                </div>                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">Address Information</h3>
                        </div>
                        <div class="panel-body">
                            <div class="col-lg-6">
                                <legend>Current Address</legend>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <?= 
                                        $form->field($model, 'postcode')
                                    ?>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <?= 
                                        $form
                                            ->field($model, 'address1')
                                        ?>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <?= 
                                        $form->field($model, 'address2')
                                    ?>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <?= 
                                        $form
                                        ->field($model, 'address3')
                                    ?>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <?= 
                                        $form->field($model, 'address4')
                                    ?>
                                </div>
 
                            </div>
                            <div class="col-lg-6">
                                <legend>Previous Address</legend>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <?= 
                                            $form->field($model, 'previous_address1')
                                        ?>
                                    </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <?= 
                                                $form->field($model, 'previous_address2')
                                            ?>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <?= 
                                            $form
                                            ->field($model, 'previous_address3')
                                        ?>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <?= 
                                            $form->field($model, 'previous_address4')
                                        ?>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <?= 
                                            $form
                                            ->field($model, 'previous_postcode')
                                        ?>
                                    </div>
                                    <div class="col-lg-12">
                                        <?= 
                                            $form
                                            ->field($model, 'other_previous_address')
                                            ->radioList(['Yes'=>'Yes','No'=>'No'],['onchange'=>'toggleField(this,"other_previous_address_details","Yes")'])
                                            ->label("Do you have other previous address?");
                                        ?>
                                        <?= 
                                            $form
                                                ->field($model, 'other_previous_address_details')
                                                ->textArea()
                                                ->label("Full information of previous address");
                                        ?>
                                    </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">Bank Details</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-4 text-right">
                                    <label class="form-label-exclusive">
                                        Account Number
                                    </label>
                                </div>
                                <div class="col-lg-8">
                                    <?= 
                                    $form
                                    ->field($model, 'account_number')
                                    ->label("");
                                    ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 text-right">
                                    <label class="form-label-exclusive">
                                        Sort Code
                                    </label>
                                </div>
                                <div class="col-lg-8">
                                    <?= 
                                        $form
                                        ->field($model, 'sort_code')
                                        ->label("");
                                    ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 text-right">
                                    <label class="control-label form-label-exclusive">Is the account just in your name or joint names?</label>
                                </div>
                                <div class="col-lg-8">
                                    <?= $form->field($model, 'account_type')->dropDownList(['Single'=>'Single','Joint'=>'Joint'])->label("") ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 text-right">
                                    <label class="control-label form-label-exclusive text-right">Account Provider</label>
                                </div>
                                <div class="col-lg-8 ">
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
                                <div class="col-lg-4 text-right" >
                                    <label class="control-label form-label-exclusive text-right">
                                        Monthly Account Charge (approximate)
                                    </label>
                                </div>
                                <div class="col-lg-8">
                                    <br>
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
                                <div class="col-lg-4 text-right">
                                    <label class="control-label form-label-exclusive">
                                        Account Start Date (approx)
                                    </label>
                                </div>
                                <div class="col-lg-8"><br>
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
                                <div class="col-lg-4 text-right">
                                    <label class="control-label form-label-exclusive">
                                        Account End Date (approx)
                                    </label>
                                </div>
                                <div class="col-lg-8"><br>
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
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">Disclaimer</h3>
                        </div>
                        <div class="panel-body">
                            <h3 class="text-center">
                                You should only sign these documents if you have read and agree to the content.
                            </h3>
                            <p>
                                You Have:
                                <ul>
                                    <li>
                                        1. The right to cancel this agreement without any charge within 14 days of signing this agreement.        
                                    </li>
                                    <li>
                                        2. The right to shop around or seek further advice.        
                                    </li>
                                    <li>
                                        3. The right to complain to the lender/broker yourself and if not satisfied with their final response to refer to the Financial Ombudsman Ser
                                        vice scheme without the expert help and guidance of Money Active.        
                                    </li>
                                    <li>
                                        4. Considered whether you have alternative mechanisms for pursuing a claim e.g. legal expenses insurance.
                                    </li>
                                    <li>
                                        5. Read and understood our service charges for a successful claim, as a percentage and also an example in pounds.
                                    </li>
                                    <li>
                                        6. Regarding No Win No Fee: Understood that unless you cancel the contract after the 14 day cooling off period you shall not pay any fee if
                                        an offer of compensation is not achieved.                                
                                    </li>
                                </ul>
                                <div class="text-center">
                                    <strong>Any Queries? – Just ask... Call 01455 530 034 or Email info@money-active.co.uk or 07860021935</strong>
                                </div>
                                <h4 style="color:red" class="text-center">Mis-sold Packaged Bank Account &amp; Payment Protection Insurance Terms of Engagement -
                                Please Read, Date and Sign below.</h3>

                                <p>‘I/We’ and ‘the Client’ means the client(s) whose signature appears afoot of these terms and conditions ‘Company’ means Money
                                Active Ltd.</p> 

                                <p>I/We herewith appoint Money Active Ltd to act exclusively on my/our behalf as my/our representative in respect of my/our claim/s
                                for any mis-sold Packaged Bank Account. I/We shall provide all information required by Money Active Ltd, as requested, by return.</p>

                                <p><b>I/We shall not enter into any agreement with the Bank/Account Provider without first consulting Money Active Ltd.</b></p> 


                                <strong>Cancellation Conditions:</strong>
                                <p>Money Active Ltd can cancel this agreement at any time and no fee will be payable by you if we think there are no grounds for a
                                complaint or that your claim is unlikely to succeed.
                                Money Active Ltd has the right to terminate the contract by giving written notice to you (the client), also at any time to immediately
                                terminate the contract if the client materially breaches any term of the contract or if the client is adjudicated bankrupt. In the case
                                of redeemable breaches the client will be afforded 28 days to remedy the breach.
                                In the event that you wish to terminate the contract after the statutory 14 day ‘cooling off’ period you may do so but Money Active
                                Ltd reserve the right to issue a cancellation charge that reflects the work already undertaken in pursuance of your claim, calculated
                                by hourly rate of £45 plus VAT.
                                If Money Active Ltd has already achieved an offer of compensation that is made in accordance with FOS guidelines the full fee is
                                payable.
                                A cancellation fee would only be charged if you cancel the contract after 14 days of signing.
                                Cancellation of the agreement must be done by clear statement. For more information, please see our Notice of Right to cancel
                                within the claim pack.</p>

                                <strong>Law &amp; Jurisdiction:</strong>
                                <p>In all matters affecting this contract the law applicable to this contract shall be English law and the parties consent to the jurisdiction
                                of the English courts. The Company makes no representation or warranty to the Client that compensation will be obtained or is in
                                any way guaranteed. The Company reserves the right at any time, at its discretion, to not pursue a claim for compensation and in
                                such instances will notify the Client in writing promptly.</p>

                                <strong>Compensation:</strong>
                                <p>Compensation refers to the total monies offered by the Third Party (i.e. Bank/Account Provider or any other organisation associated
                                with your claim/s) whether as compensation, as a gesture of goodwill, refund, discount or otherwise arising from any claim made by
                                the Company on behalf of the Client for an allegedly mis-sold Packaged Bank Account and/or any offer to reduce any outstanding
                                overdraft and/or any interest or capital recovered. Where such an offer is revised on appeal and subject to the client having not
                                cancelled our agreement, then the higher amount shall be used in order to calculate the amount of the Compensation.</p> 
                                <div class="text-center" style="text-decoration : underline">
                                    <strong>Responsibilities:</strong>
                                </div>
                                <strong  style="text-decoration : underline">Money Active Ltd shall:</strong>
                                <ul>
                                    <li>a) Conduct ourselves in the best interest of the client in the pursuance of any potential claim against any financial institution.</li> 
                                    <li>b) Afford the client with impartial advice on any risks and benefits of pursing a claim against any financial institution.</li>
                                    <li>c) Endeavour to achieve a satisfactory outcome via complaint to the lender/broker, through the Financial Ombudsman or FinancialServices Compensation Scheme, as necessary. Our work is limited to reaching a settlement without court action.</li>
                                    <li>d) Advise the client on the suitability of any offer of settlement on behalf of any financial institution.</li>
                                </ul>

                                <strong  style="text-decoration : underline">You (The Client) shall:</strong>
                                <ul>
                                    <li>a) Provide Money Active Ltd with full and accurate information and not mislead it or obstruct it in any way.</li>
                                    <li>b) Provide Money Active Ltd with all documents, including in electronic form, in his/her possession relating to / giving evidence tothe claim/s.</li>
                                    <li>c) Respond without delay to any request from Money Active Ltd for instructions or further information without delay.</li>
                                    <li>d) Advise Money Active Ltd of any change of address details or contact telephone numbers immediately.</li>
                                    <li>e) Advise Money Active Ltd immediately if the Third Party contacts the client directly regarding the claim.</li>
                                </ul>

                                <strong  style="text-decoration : underline">Introducer Information</strong>
                                <p>
                                    Money Active Ltd pay a commission to the third party that introduced you to us, equating to 50% of the total fee paid by the client.
                                    For example if you pay Money Active Ltd £200 upon completion of a successful claim, Money Active Ltd will pay the introducer £100.
                                    We will provide updates on the progress of your claim to any third party which introduced you to us. We will not give them specific
                                    information relating to your claim, and will only give them general information about the progress of your claim, and confirmation of
                                    any compensation amount you receive. By entering into this agreement you give consent to us to process your Personal
                                    Information in this way in so far as is necessary for us to perform our obligations to the third party.
                                </p>
                                <strong  style="text-decoration : underline">Payment &amp; Our Fees:</strong>
                                <p>Money Active Ltd will strive to recover all monies owed and undertake to forward any payment from our bank to you, the client,
                                within 7 days from the date received, subject to the agreed fee of 33% plus VAT.
                                If you are paid the compensation directly we require that you pay our fee no later than 10 days after payment is received by you.
                                If based on all available evidence your offer of compensation is correct and was calculated correctly and in accordance with any
                                Financial Conduct Authority / Financial Ombudsman Service rules or guidance and we recommend that you accept it and you choose
                                not to accept it our fee must be paid within 20 days of our recommendation.
                                If you fail to pay our fee and Money Active Ltd takes steps to recover any service charges due, the Client shall pay to Money Active
                                Ltd a recovery fee that reflects the cost of work undertaken to recover the fee, in addition to our normal fee.
                                You may be paid directly in cash, or a reduction to your balance may be made. If your claim relates to an account that is actively
                                overdrawn and the lender uses redress monies to reduce your outstanding overdraft, in such cases our fee will be payable on any
                                amount credited to the account and any cash in hand sum.
                                Examples of the Company’s fee –</p>



                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th colspan="2">Example A: All compensation is "cash in hand"</th>
                                            <th colspan="2">Example B: Compensation includes "cash in hand" award with loan and future instalment reduction</th>
                                            <th colspan="2">Example C: Compensations is used to offset arrears consumer has on credit card or loan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Total compensation Received by Customer:</td>
                                            <td> &pound;3,000</td>
                                            <td>Total compensation Received by Customer:</td>
                                            <td> &pound;3,000</td>
                                            <td>Total compensation Received by Customer:</td>
                                            <td> &pound;3,000</td>
                                        </tr>
                                        <tr>
                                            <td>Loan Reduction by Lender </td>
                                            <td> &pound;0</td>
                                            <td>Loan Reduction by Lender </td>
                                            <td> &pound;2,000</td>
                                            <td>Arrears Reduction by Lender </td>
                                            <td> &pound;3,000</td>
                                        </tr>
                                        <tr>
                                            <td>Of which cash received by Customer after Loan reduction</td>
                                            <td> &pound;3,000</td>
                                            <td>Of which cash received by Customer after Loan reduction</td>
                                            <td> &pound;1,000</td>
                                            <td>Of which cash received by Customer after Arrears reduction</td>
                                            <td> &pound;0   </td>
                                        </tr>
                                        <tr>
                                            <td>Money Active Fee charged @ 33% + VAT </td>
                                            <td> &pound;1,188</td>
                                            <td>Money Active Fee charged @ 33% + VAT </td>
                                            <td> &pound;1,188</td>
                                            <td>Money Active Fee charged @ 33% + VAT </td>
                                            <td> &pound;1,186</td>
                                        </tr>
                                        <tr>
                                            <td>Consumer Pays Money Active </td>
                                            <td> &pound;1,188</td>
                                            <td>Consumer Pays Money Active </td>
                                            <td> &pound;1,188</td>
                                            <td>Consumer pays Money Active </td>
                                            <td> &pound;1,186</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <strong>No Win No Fee:</strong> Unless you cancel the contract after the 14 day cooling off period you, the Client, shall not pay any fee if an offer
                                of compensation is not achieved via complaint to the lender/broker, through the Financial Ombudsman or Financial Services
                                Compensation Scheme and/or the Company has deemed it appropriate not to pursue a claim for compensation.

                                <b>Complaints:</b> Money Active has an internal complaints procedure, included in a separate sheet in your pack or at <a href="www.money-
                                active.co.uk">www.money-
                                active.co.uk</a>

                                <br>
                                <b>
                                    <strong  style="text-decoration : underline">Declaration:</strong>
                                    You should only sign this document if you have read it and agree to be bound by the terms and conditions.
                                    By signing this agreement you are entering into a legally binding contract.</p> 
                                </b>
                                <br>


                                <hr>

                                <h1 class="text-center">Letter of Authority</h1>
                                <div class="text-center">
                                    <strong style="margin:0px 10px">Company : <?= Yii::$app->name ?></strong>
                                    <strong style="margin:0px 10px">Account Number : <?= Html::encode($model->security_key); ?></strong>
                                    <strong style="margin:0px 10px">Sortcode : <?= Html::encode($model->sort_code); ?></strong>
                                </div>

                                <br>
                                <br>
                                <p><strong>Authorisation to Money Active –</strong> I/We hereby give authorisation to Money Active Ltd to act on my/our behalf in pursuing
                                my/our claim/s in respect of advice received from and/or sales made by the company relating to the above and any other
                                account I/we hold or have held with the company.</p>
                                <br>

                                <b>
                                    <p>I/We give Money Active Ltd full authority to refer the complaint to the Financial Ombudsman Service and/or Financial
                                    Services compensation Scheme if this is believed to be in my/our best interest.</p>
                                </b>
                                <br>
                                <p>
                                    I/We acknowledge that I/we could pursue this complaint against the company myself/ourselves without the involvement of
                                Money Active Ltd, but that I/we have instead opted to engage Money Active whose fees will be recoverable from me/us.
                                </p>
                                <br>

                                <p><b>I/We further consent that a copy of this agreement holds the same validity as the original and that this
                                authority will endure until further notice.</b></p> 

                                <p>I/We acknowledge that I/we could pursue this complaint against the company myself/ourselves without the involvement of
                                Money Active Ltd, but that I/we have instead opted to engage Money Active whose fees will be recoverable from me/us.</p>

                                <p>I/We understand that in the result of a successful claim the features of the packaged bank account will end and that I/We
                                will be responsible for arranging any alternative cover if required.</p>    

                                <strong class="under-heading text-center">Instructions to the company</strong>
                                <p><b>Please take this letter as my/our instructions to you, the company, to deal directly with Money Active Ltd in
                                respect of the complaint and to provide them with any information they request either verbally or in any other
                                media format that they require to pursue my/our complaint.</b></p>  
                                <br>


                                <p><b>As of the date I/we have signed this letter of authority, I/we do not wish to receive any correspondence from
                                the company in relation to the complaint.</b></p>
                                <br>

                                <p><b>Any requests for further information or clarification must be addressed via Money Active Ltd who will
                                communicate on my/our behalf.</b></p>
                                <br>
                                <strong class="under-heading">Declaration of Truth – </strong>I/We have read and accepted the Money Active Ltd Terms of Engagement and give them full
                                authority to make a claim on my/our behalf. I/We confirm that the information provided is in the best of my/our knowledge
                                accurate and a truthful reflection of my/our recollections of events at the point of sale.
                                <br>
                                <br>
                                <strong class="under-heading">Terms of Engagement – </strong> I/We have read and accept the Money Active Ltd Terms of Engagement and give them full
                                authority to make a claim on my/our behalf.

                                <hr>
                                <br>
                                <div class="alert alert-info">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <strong><h1>Packaged bank account: consumer questionnaire</h1></strong> 
                                    <strong>About this questionnaire</strong>
                                    <p>    
                                        We need some more information from you about your packaged bank account. Your answers will help us look into
                                        your complaint more quickly – so please fill out as much of the questionnaire in as much detail as you can.
                                    </p>
                                    <br>
                                    <p>
                                        It may take you some time to go through the questionnaire and get all your facts together. But having all the
                                        information in one place should mean your case can then be assessed more quickly.
                                    </p>
                                    <br>
                                    <p>
                                        If you have any questions about complaining about a packaged bank account, please call us on 020 3069 6720.
                                        Or if you’ve got a more general question about the ombudsman service, please call 0800 023 4567.
                                    </p>
                                </div>
                                <br>
                           </p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">Section A</h3>
                        </div>
                        <div class="panel-body">
                            <h2 class="section-header">Section A: about your packaged bank account</h2>
                            <hr>
                            <strong class="sub-section-header">A1. what is your complaint reference with us? (you can find this on any correspondence we’ve sent you)</strong>
                            <?= $form->field($model, 'complaint_reference')->label("") ?>

                            <strong class="sub-section-header">A2. what is the name of the financial business you are complaining about?</strong>
                            <?= $form->field($model, 'financial_business_name')->label("") ?>

                            <strong class="sub-section-header">A3. what are the last three digits of the account number of the packaged bank account you’re complaining about?</strong>
                            <?= $form->field($model, 'last_3_digit_account_num')->label("") ?>

                            <strong class="sub-section-header">A4. Is this (or has this ever been) a joint packaged bank account?</strong>
                            <?= $form->field($model, 'account_type')->dropDownList(['Single'=>'Single','Joint'=>'Joint'])->label("") ?>

                            <br>
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <strong class="sub-section-header">A5. details of the packaged bank account holder(s)</strong>
                                    <?= $form->field($model, 'salutation')->dropDownList(['Mr'=>'Mr','Mrs'=>'Mrs','Ms'=>'Ms']) ?>
                                    <?= $form->field($model, 'firstname') ?>
                                    <?= $form->field($model, 'lastname') ?>
                                </div>
                            </div>
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
                                ->label("Date of birth");
                            ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">Section B</h3>
                        </div>
                        <div class="panel-body">
                            <h2 class="section-header">
                                Section B: about the sale of your packaged bank account
                            </h2>
                            <hr>
                            <strong class="sub-section-header">B1. are you complaining about the sale of your packaged bank account?</strong>
                            <?= $form->field($model, 'is_complain_about_sale_packaged_bank_account')->radioList(['Yes'=>'Yes','No'=>'No'])->label(""); ?>
                            <div class="sub-section-header">
                            <strong>If you answered “no” – please tell us in the box below what your complaint is about. Then go to section F. </strong>
                            <br>
                            <br>
                            <strong>If you answered “yes” – please explain why you think your packaged bank account was mis-sold and what
                            prompted you to complain to your bank/ building society about it.</strong>
                            </div>
                            <br>
                            <br>
                            <?= $form->field($model, 'is_complain_about_sale_packaged_bank_account_details')->textarea(['style'=>'margin-top: 0px; margin-bottom: 0px; height: 200px;']); ?>
                            <strong class="sub-section-header">
                                B2. when do you think you opened or upgraded to the packaged bank account?
                            </strong>
                            <?= 
                                $form
                                ->field($model, 'open_or_upgrade_package_bank_account_date')
                                    ->widget(DatePicker::classname(), [
                                        'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                                        'pluginOptions' => [
                                            'autoclose'=>true,
                                            'format' => 'dd-mm-yyyy'
                                        ]
                                    ])
                                ->label("");
                            ?>
                            <strong class="sub-section-header">
                                B3. did you notice the account fees on your statements?
                            </strong>
                            <?= $form->field($model, 'notice_account_fees_on_statements')->radioList(['Yes'=>'Yes','No'=>'No'])->label(""); ?>
                            <strong class="sub-section-header">
                                If you answered “yes” to B3 – and you’re complaining that you didn’t know you had the packaged bank
                                account – please tell us when you first noticed the fees and what you thought they were for.
                            </strong>
                            <?= $form->field($model, 'notice_account_fees_on_statements_details')->textarea(['style'=>'margin-top: 0px; margin-bottom: 0px; height: 200px;'])->label(""); ?>
                            <strong class="sub-section-header">
                                B4. how was the packaged bank account sold to you?
                            </strong>
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
                                ])
                            ?>

                            <strong class="sub-section-header">
                                if you answered “other” to B4, please explain how your packaged bank account was sold
                            </strong>
                            <?= 
                                $form
                                ->field($model, 'how_packaged_bank_account_sold_details')
                                ->label("")
                                ->textarea(['style'=>'margin-top: 0px; margin-bottom: 0px; height: 200px;']);
                            ?>

                            <strong class="sub-section-header">
                                B5. did the financial business give you advice or recommend the packaged bank account to you?
                            </strong>
                            <?= 
                                $form
                                ->field($model, 'did_they_give_advice_clarify')
                                ->label("")
                                ->radioList(['Yes'=>'Yes','No'=>'No',"Can't Remember"=>"Can't Remember",],['onchange'=>'toggleField(this,"did_they_give_advice_clarify_details","Yes")'])
                            ?>
                            <strong class="sub-section-header">
                                if you answered “yes” to B5, please give details.
                            </strong>
                            <?= 
                                $form
                                ->field($model, 'did_they_give_advice_clarify_details')
                                ->label("")
                                ->textarea(['style'=>'margin-top: 0px; margin-bottom: 0px; height: 200px;']);
                            ?>
                            <strong class="sub-section-header">
                                B6. what is the current situation with your packaged bank account?
                            </strong>
                            <?= $form->field($model, 'current_situation_packaged_bank_account')->radioList(['I’m still paying for my packaged bank account'=>'I’m still paying for my packaged bank account','I’ve closed/downgraded my packaged bank account'=>'I’ve closed/downgraded my packaged bank account'])->label(""); ?>
                            <strong class="sub-section-header">
                                if you’re still paying for your packaged bank account, please explain why.
                            </strong>
                            <?= 
                                $form
                                ->field($model, 'current_situation_packaged_bank_account_explanation')
                                ->label("")
                                ->textarea(['style'=>'margin-top: 0px; margin-bottom: 0px; height: 200px;']);
                            ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">Section C</h3>
                        </div>
                        <div class="panel-body">
                            <h2 class="section-header">
                                Section C: about your circumstances at the time of sale/upgrade
                            </h2>
                            <hr>
                            <strong style="border: 3px solid red; color: red; background: #D9EDF7;padding: 20px;font-size: 20px;margin-bottom: 10px">
                                if you have/had a joint account, please answer “yes” in section C if
                                the answer is “yes” for any of the account holders.
                            </strong>
                            <div class="clearfix"></div>
                            <br>
                            <br>
                            <br>
                            <strong class="sub-section-header">C1. before you opened or upgraded to the packaged bank account, had you ever had a free bank account in the UK?</strong>
                            <?= 
                                $form
                                ->field($model, 'had_free_bank')
                                ->label("")
                                ->radioList(['Yes'=>'Yes','No'=>'No']); 
                            ?>
                            <strong class="sub-section-header">C2. at the time you opened or upgraded to the packaged bank account, did you have any other packaged bank accounts?</strong>
                            <?= 
                            $form
                                ->field($model, 'when_opened_account_has_other_account')
                                ->label("")
                                ->radioList(['Yes'=>'Yes','No'=>'No']);
                            ?>
                            <strong class="sub-section-header">if you answered “yes” to C2, please give details.</strong>
                            <?= 
                                $form
                                    ->field($model, 'when_opened_account_has_other_account_details')
                                    ->label("")
                                    ->textarea(['style'=>'margin-top: 0px; margin-bottom: 0px; height: 200px;']);
                            ?>
                            <strong class="sub-section-header">C3. at the time you opened or upgraded the packaged bank account, or shortly afterwards, was your main address outside of the United Kingdom?</strong>
                            <?= 
                                $form
                                ->field($model, 'is_address_outside_UK_at_package_upgrade')
                                ->label("")
                                ->radioList(['Yes'=>'Yes','No'=>'No']); 
                            ?>
                            <strong class="sub-section-header">C4. at the time you opened or upgraded to the packaged bank account, did you hold a valid UK driving licence?</strong>
                            <?= 
                                $form
                                ->field($model, 'has_uk_driving_license_during_upgrade')
                                ->label("")
                                ->radioList(['Yes'=>'Yes','No'=>'No']);
                            ?>
                            <strong class="sub-section-header">if you answered “yes” to C4, did you own/drive a car?</strong>
                            <?= 
                                $form
                                ->field($model, 'own_a_car')
                                ->label("")
                                ->radioList(['Yes'=>'Yes','No'=>'No']); 
                            ?>
                            <strong class="sub-section-header">C5. at the time you opened or upgraded to the packaged bank account, did you own a mobile phone?</strong>                        
                            <?=
                                $form
                                ->field($model, 'has_mobile_phone_during_upgrade')
                                ->label("")
                                ->radioList(['Yes'=>'Yes','No'=>'No'])
                            ?>
                            <strong class="sub-section-header">if you answered “yes” to C5, was it a smart phone (ie with internet access)?</strong>
                           <?=
                                $form
                                ->field($model, 'has_mobile_phone_during_upgrade_has_internet_connection')
                                ->label("")
                                ->radioList(['Yes'=>'Yes','No'=>'No']); 
                            ?>
                            <strong class="sub-section-header">
                                C6. at the time you opened or upgraded to the packaged bank account, how often did you go on holiday?
                                <br>
                                Please tick all the options that apply.
                            </strong>
                            <!-- TODO -->
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
                            <strong class="sub-section-header">
                                C7. at the time you opened or upgraded to the packaged bank account, did you have any health problems?
                            </strong>
                            <?= 
                            $form
                                ->field($model, 'has_health_problems_during_upgrade')
                                ->label("")
                                ->radioList(['Yes'=>'Yes','No'=>'No']);
                            ?>
                            <strong class="sub-section-header">
                                if you answered “yes” to C7, please give details.
                            </strong>
                            <?= 
                            $form
                                ->field($model, 'has_health_problems_during_upgrade_details')
                                ->label("")
                                ->textarea(['class'=>'col-xs-12 col-sm-12 col-md-12 col-lg-12','style'=>'margin-top: 0px; margin-bottom: 0px; height: 143px;']);
                            ?>
                            <strong class="sub-section-header">
                                C8. at the time you opened or upgraded to the packaged bank account, were you registered with a UK doctor?
                            </strong>
 
                            <strong class="sub-section-header">
                                C9. at the time you opened or upgraded to the packaged bank account, did you take out any other products
                                with the bank (for example a credit card, loan, overdraft, mortgage or savings account)?                            
                            </strong>
                            <?= 
                            $form
                                ->field($model, 'when_opened_account_has_other_account')
                                ->label("")
                                ->radioList(['Yes'=>'Yes','No'=>'No']);
                            ?>
                            <strong class="sub-section-header">
                                If you answered “yes” to C9, please give details.
                            </strong>
                            <?= 
                                $form
                                    ->field($model, 'when_opened_account_has_other_account_details')
                                    ->label("")
                                    ->textarea(['style'=>'margin-top: 0px; margin-bottom: 0px; height: 200px;']);
                            ?>                            

                        </div>
                    </div>
                </div>  
                <div class="row">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">Section D</h3>
                        </div>
                        <div class="panel-body">
                            <h2 class="section-header">
                                section D: about the benefits of the packaged bank account
                            </h2>
                            <br>
                            <br>
                            <strong style="border: 3px solid red; color: red; background: #D9EDF7;padding: 20px;font-size: 20px;margin-bottom: 10px">
                                if you have/had a joint account, please answer “yes” in section D if
                                the answer is “yes” for any of the account holders.
                            </strong>
                            <br>
                            <br>
                            <br>
                            <strong class="sub-section-header">
                                D1. have you registered for any of the benefits provided by your packaged bank account                            
                            </strong>
                            <?= 
                                $form
                                ->field($model, 'has_registered_doctor_during_upgrade')
                                ->label("")
                                ->radioList(['Yes'=>'Yes','No'=>'No']); 
                            ?>
                            <strong class="sub-section-header">
                                If you answered “yes” to D1, please give details.
                            </strong>
                             <?= 
                                $form
                                ->field($model, 'has_registered_doctor_during_upgrade_details')
                                ->label("")
                                ->textarea(['style'=>'margin-top: 0px; margin-bottom: 0px; height: 200px;']);
                            ?>
                            <strong class="sub-section-header">
                                D2. have you ever made a claim on any of the insurance products provided by the packaged bank account?8e
                            </strong>
                           <?= 
                            $form
                                ->field($model, 'tried_to_claim_for_package')
                                ->label("")
                                ->radioList(['Yes'=>'Yes','No'=>'No'])
                            ?>
                            <strong class="sub-section-header">
                                if you answered “yes” to D2, please give details.
                            </strong>
                            <?=
                            $form
                                ->field($model, 'tried_to_claim_for_package_details')
                                ->label("") 
                                ->textarea(['style'=>'margin-top: 0px; margin-bottom: 0px; height: 200px;']);
                            ?>
                            <strong class="sub-section-header">
                                D3. have you used any other benefits of the packaged bank account – for example, a preferential overdraft
                                rate, a preferential savings rate, a preferential loan rate, a monthly film subscription or any other
                                discounts?
                            </strong>
                            <?= 
                                $form
                                ->field($model, 'used_benefits_packaged_bank')
                                ->label("")
                                ->radioList(['Yes'=>'Yes','No'=>'No'])
                            ?>
                            <strong class="sub-section-header">
                                If you answered “yes” to D3, please give details.
                            </strong>                            
                            <?= 
                            $form
                                ->field($model, 'used_benefits_packaged_bank_details')
                                ->label("") 
                                ->textarea(['style'=>'margin-top: 0px; margin-bottom: 0px; height: 200px;']);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">Section E</h3>
                        </div>
                        <div class="panel-body">
                            <h2 class="section-header">
                                Section E: about other insurance policies
                            </h2>
                            <br>
                            <br>
                            <strong style="border: 3px solid red; color: red; background: #D9EDF7;padding: 20px;font-size: 20px;margin-bottom: 10px">
                                If you have/had a joint account, please answer “yes” in section E if
                                the answer is “yes” for any of the account holders.                            
                            </strong>
                            <br>
                            <br>
                            <br>
                            <strong class="sub-section-header">
                                C9. at the time you opened or upgraded to the packaged bank account, did you take out any other products
                                with the bank (for example a credit card, loan, overdraft, mortgage or savings account)?                            
                            </strong>
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
                                ])
                            ?>                           
                            <strong class="sub-section-header">
                                If you ticked any of the options in E1, please give details.
                            </strong>
                            <?= 
                                $form
                                    ->field($model, 'after_upgrade_already_has_products_details')
                                    ->label("") 
                                    ->textarea(['style'=>'margin-top: 0px; margin-bottom: 0px; height: 200px;']);
                            ?>
                           <strong class="sub-section-header">
                                if you ticked any of the options in E1, did you keep the insurance after the sale of/upgrade to the packaged bank account?
                            </strong>
                            <?=
                            $form
                                ->field($model, 'did_kept_insurance_after_sale')
                                ->label("")
                                ->radioList(['Yes'=>'Yes','No'=>'No']);
                            ?>
                            <strong class="sub-section-header">
                                If you answered “yes” to the E1, please give details.
                            </strong>                            
                            <?=
                                $form
                                    ->field($model, 'did_kept_insurance_after_sale_details')
                                    ->label("")
                                    ->textarea(['style'=>'margin-top: 0px; margin-bottom: 0px; height: 200px;']);                            
                            ?>
                        </div>
                    </div>
                </div>  
                <div class="row">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">Section F</h3>
                        </div>
                        <div class="panel-body">
                            <h2 class="section-header">
                                Section F: any additional information
                            </h2>
                            <strong class="sub-section-header">
                                F1. please use this section to tell us anything else about your complaint.
                            </strong>
                            <?=
                                $form
                                    ->field($model, 'complaint_whole_details')
                                    ->label("")
                                    ->textarea(['style'=>'margin-top: 0px; margin-bottom: 0px; height: 600px;']);
                            ?>
                        </div>
                    </div>
                </div>  
                <div class="row">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">Section G</h3>
                        </div>
                        <div class="panel-body">
                            <h2 class="section-header">
                                Section G: your declaration
                            </h2>
                            <blockquote class="text-center">
                                <i class="fa fa-quote-left" aria-hidden="true"></i>
                                I confirm that all the information I’ve given in this questionnaire is true and accurate
                                to the best of my knowledge.
                                <br>
                                I confirm I want to make a formal complaint about the packaged bank account in line
                                with the information I’ve given.
                                <i class="fa fa-quote-right" aria-hidden="true"></i>
                            </blockquote>

                            <div style="margin: 0px auto;background: #D9EDF7;color: #31708F;width: 640px;padding: 20px;border-radius: 20px;">
                                You (and any joint account holder) need to sign here – even if someone else is bringing the
                                complaint to us on your behalf. 
                                <br>
                                <br>
                                If someone is complaining for you (eg a relative or claims manager), signing here means you
                                authorise the person named on page 1 of your complaint form to represent you in this
                                complaint. 
                                <br>
                            </div>
                            <hr>
                            <div class="section-g-tick">
                            Please tick to confirm you have <br><br>
                            <?= 
                                $form
                                    ->field($model, 'declaration_confirmed_tick')
                                    ->checkboxList([
                                        'Included everything you want to tell us about your complaint'=>' included everything you want to tell us about your complaint',
                                        'Signed the declaration'=>'signed the declaration',
                                        'Enclosed copies of all relevant documents'=>' enclosed copies of all relevant documents',
                                        'Not enclosed any documents with this form'=>'not enclosed any documents with this form'
                                    ]);
                            ?>

                            </div>
                            <br>
                            <br>

                            <strong class="sub-section-header">
                                Please use this form to tell us about your complaint – so we can see if we’re able to help you.
                                If you’re not sure about anything – or have difficulties filling in this form – just phone us on <i>0300 123 9 123.</i>
                            </strong>
                            <br>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="alert alert-info">
                                        Please let us know if you have any practical
                                        needs where we could help – for example with
                                        information in another format (eg large print,
                                        Braille etc) or in a different language.                                    
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="alert alert-info">
                                        You can download this form off our website
                                        (<a href="www.financial-ombudsman.org.uk">www.financial-ombudsman.org.uk</a>) to complete
                                        by hand. Or you can fill it in on screen – then print
                                        it off and post it back to us.                                    
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <h3>
                                <div class="pull-left">
                                    first, please check the details  below
                                </div>
                                <div class="pull-right">
                                    … and the details of anyone complaining with you
                                </div>
                            </h3>
                            <div class="clearfix"></div>
                            <div class="col-lg-12">                                
                                <div class="col-lg-6">
                                    <legend> Your Information</legend>
                                    <?= $form->field($model, 'salutation')->dropDownList(['Mr'=>'Mr','Mrs'=>'Mrs','Ms'=>'Ms']) ?>
                                    <?= $form->field($model, 'firstname') ?>
                                    <?= $form->field($model, 'lastname') ?>
                                    <?= $form->field($model, 'occupation') ?>
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
                                        ->label("Date of birth");
                                    ?>
                                    <?= 
                                        $form->field($model, 'postcode')
                                    ?>                                    
                                    <?= 
                                    $form
                                        ->field($model, 'address1')
                                    ?>
                                    <?= 
                                        $form->field($model, 'address2')
                                    ?>
                                    <?= 
                                        $form
                                        ->field($model, 'address3')
                                    ?>
                                    <?= 
                                        $form->field($model, 'address4')
                                    ?>
                                    <label>Phone</label>
                                    <?= 
                                    $form->field($model, 'mobile' ,['template'=>'
                                       <div class="input-group col-lg-12 ">
                                          <span class="input-group-addon">
                                             <span class="fa fa-mobile"></span>
                                          </span>
                                          {input}
                                       </div>
                                       {error}{hint}
                                    '])
                                    ?>




                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <legend>Details of anyone complaining with you</legend>
                                    <?= $form->field($model, 'salutation_complain_with')->dropDownList(['Mr'=>'Mr','Mrs'=>'Mrs','Ms'=>'Ms']) ?>
                                    <?= $form->field($model, 'firstname_complain_with') ?>
                                    <?= $form->field($model, 'lastname_complain_with') ?>
                                    <?= $form->field($model, 'occupation_complain_with') ?>
                                    <?= 
                                        $form
                                        ->field($model, 'date_of_birth_complain_with')
                                            ->widget(DatePicker::classname(), [
                                                'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                                                'pluginOptions' => [
                                                    'autoclose'=>true,
                                                    'format' => 'dd-mm-yyyy'
                                                ]
                                            ])
                                        ->label("Date of birth");
                                    ?>
                                    <?= 
                                        $form->field($model, 'postcode_complain_with')
                                    ?>                                    
                                    <?= 
                                    $form
                                        ->field($model, 'address1_complain_with')
                                    ?>
                                    <?= 
                                        $form->field($model, 'address2_complain_with')
                                    ?>
                                    <?= 
                                        $form
                                        ->field($model, 'address3_complain_with')
                                    ?>
                                    <?= 
                                        $form->field($model, 'address4_complain_with')
                                    ?>
                                    <label>Phone</label>
                                    <?= 
                                    $form->field($model, 'mobile_complain_with' ,['template'=>'
                                       <div class="input-group col-lg-12 ">
                                          <span class="input-group-addon">
                                             <span class="fa fa-mobile"></span>
                                          </span>
                                          {input}
                                       </div>
                                       {error}{hint}
                                    '])
                                    ?>                                    

                                <br>
                               <br>
                                </div>
                            </div>
                            <br>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <strong class="sub-section-header">
                                    if someone is complaining on your behalf (eg a solicitor or relative) please give us their details
                                </strong>
                                <table class="table table-bordered table-hover">
                                    <tbody>
                                        <tr>
                                            <td>their name </td>
                                            <td> </td>
                                            <td>relationship to you</td>
                                            <td>Claims Management Company</td>
                                        </tr>
                                        <tr>
                                            <td>address for writing to them (include postcode)</td>
                                            <td>
                                                Wheatfield House <br>
                                                Wheatfield Way <br>
                                                Hinckley <br>
                                                Leicestershire LE10 1YG <br>
                                            </td>
                                            <td></td>
                                            <td> </td>
                                        </tr>
                                        <tr>
                                            <td>their daytime phone </td>
                                            <td>01455 530 034</td>
                                            <td>Fax</td>
                                            <td> </td>
                                        </tr>
                                        <tr>
                                            <td>their email </td>
                                            <td><?= Html::mailto('fos@money-active.co.uk', 'fos@money-active.co.uk'); ?></td>
                                            <td>ref</td>
                                            <td><strong>PBA00198387</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <strong class="sub-section-header">
                                if you’re complaining on behalf of a business, charity or trust please fill in these details
                            </strong>
                            <table class="table table-bordered table-hover">
                                <tbody>
                                    <tr>
                                        <td>Full Official Name</td>
                                        <td><?= $form->field($model, 'behalf_of_charity_official_name')->textInput()->label(""); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Number of employees</td>
                                         <td><?= $form->field($model, 'behalf_of_charity_num_of_employees')->textInput()->label(""); ?></td>

                                    </tr>
                                    <tr>
                                        <td>If a partnership, the number of partners </td>
                                        <td><?= $form->field($model, 'behalf_of_charity_num_of_partners')->textInput()->label(""); ?></td>
                                    </tr>
                                    <tr>
                                        <td>its annual turnover, annual income or net asset value (at the time you first complained) *</td>
                                        <td><?= $form->field($model, 'behalf_of_charity_annual_income')->textInput()->label(""); ?></td>

                                    </tr>
                                </tbody>
                            </table>
                            <i>
                                * We may ask you for evidence of this. Please phone us – or look on our website – for information about what types of businesses, charities and trusts can use our service.
                            </i>
                            <br>
                            <br>
                            <strong class="sub-section-header">
                                Details of the business you think is responsible for your complaint
                            </strong>
                            <table class="table table-bordered table-hover">
                                <tbody>
                                    <tr>
                                        <td>Their name</td>
                                        <td><?= $form->field($model, 'business_responsible_details_name')->textInput()->label(""); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Their address (include postcode)</td>
                                        <td><?= $form->field($model, 'business_responsible_details_address')->textInput()->label(""); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Their phone number</td>
                                        <td><?= $form->field($model, 'business_responsible_details_phone')->textInput()->label(""); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            <strong class="sub-section-header">
                                Details of the adviser or business who originally sold the product or service
                                you’re complaining about <small>(if different from the name above)</small>

                            </strong>
                            <table class="table table-bordered table-hover">
                                <tbody>
                                    <tr>
                                        <td>Their name</td>
                                        <td><?= $form->field($model, 'adviser_detail_name')->textInput()->label(""); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Their address (include postcode)</td>
                                        <td><?= $form->field($model, 'adviser_detail_address')->textInput()->label(""); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Their phone number</td>
                                        <td><?= $form->field($model, 'adviser_detail_phone')->textInput()->label(""); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            <strong class="sub-section-header">
                                The kind of product or service you’re complaining about
                                the name and type of product or service
                            </strong>

                            <?= $form->field($model, 'kind_of_service_complain')->textInput()->label(""); ?>

                            <strong class="sub-section-header">
                                any reference number (eg your account and sort code;
                                hire-agreement or loan number; policy or claim number)
                            </strong>
                            <?= $form->field($model, 'kind_of_service_complain_reference')->textInput()->label(""); ?>
                            
                            <strong class="sub-section-header">
                                Please tell us what your complaint is about
                            </strong>
                            <?= 
                                $form
                                    ->field($model, 'complaint_whole_details')
                                    ->label("")
                                    ->textarea(['style'=>'margin-top: 0px; margin-bottom: 0px; height: 200px;']);
                            ?>
                            <p>
                                <small>
                                    If your complaint is about the sale of payment protection insurance (PPI), you will also need to complete a separate questionnaire.
                                    <ul>
                                        <li>
                                            You may have done this already – if you have already complained directly to the business you think is responsible.
                                        </li>
                                        <li>
                                            If not, you can download the consumer questionnaire off our website – or phone us for a copy on 0300 123 9 123.
                                            The business has eight weeks from this date to send you its final written answer – before we can investigate the complaint.
                                            time limits may apply to your complaint so we need to know these dates day month 
                                        </li>
                                    </ul>
                                </small>
                            </p>
                            <hr>
                            <h3>
                                Time limits may apply to your complaint so we need to know these dates
                            </h3>
                            <ul>
                                <li>
                                     When did the advice, service or transaction you’re complaining about take place?
                                     <!-- datepicker  -->
                                    <?= $form
                                        ->field($model, 'when_trasaction_happen') 
                                        ->widget(DatePicker::classname(), [
                                            'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                                            'pluginOptions' => [
                                                'autoclose'=>true,
                                                'format' => 'dd-mm-yyyy'
                                            ]
                                        ])
                                        ->label("")
                                    ?>                                     
                                </li>
                                <li>
                                     When did you first complain to the business you think is responsible?
                                     <!-- datepicker -->
                                    <?= $form
                                        ->field($model, 'when_first_complain_business') 
                                        ->widget(DatePicker::classname(), [
                                            'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                                            'pluginOptions' => [
                                                'autoclose'=>true,
                                                'format' => 'dd-mm-yyyy'
                                            ]
                                        ])
                                        ->label("")
                                    ?>
                                </li>
                            </ul>
                            <p>
                                The business has eight weeks from this date to send you its final written answer – before we can investigate the complaint.
                            </p>
<!-- todo final page -->
                            <strong class="sub-section-header">
                                Just a few more questions
                            </strong>


                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <label class="control-label form-label-exclusive text-right">
                            Have you ever tried to claim back your money for this packaged account yourself or through another company?
                        </label>
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><br>
 
                        <br>
                        <br>
                        <div id="tried_to_claim_for_package_details" class="hidden">
                            <?= 
                            $form
                                ->field($model, 'tried_to_claim_for_package_details')
                                ->label("") 
                                ->textarea(['style'=>'margin-top: 0px; margin-bottom: 0px; height: 200px;']);

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


                <!-- show this if yes -->
                <div class="hidden" id="usedBenefitsMoreDetailsContainer">
                    <div class="row" >
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                            <label class="control-label form-label-exclusive">
                                2B. Please give details
                            </label>
                        </div>
                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><br>
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
                    </div>
                </div>

                <div class="row hidden" id="didOwnACarContainer">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <label class="control-label form-label-exclusive">
                            18B. Did you own/drive a car?
                        </label>
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><br>
                    </div>
                </div>


                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <label class="control-label form-label-exclusive">
                            19. At the time you opened or upgraded to the packaged bank account, did you own a mobile phone?
                        </label>
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><br>
                    </div>
                </div>

                <div class="row" id="smartphone_has_internet_access">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <label class="control-label form-label-exclusive">
                            19B. Was it a smart phone (i.e. with internet access)?                       
                        </label>
                    </div>
                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                    </div>
                </div>


                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <label class="control-label form-label-exclusive">
                            20. At the time you opened or upgraded to the packaged bank account, how often did you go on holiday?
                        </label>
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><br>
                    </div>
                </div>

                <div id="has_health_problems_during_upgrade_details_container">

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

                <div class="row" id="has_registered_doctor_during_upgrade_container">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <label class="control-label form-label-exclusive">
                            23. At the time or shortly after you opened or upgraded to the packaged bank account, did you already have any of the following products?
                        </label>
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><br>

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
                        <br>
                        <br>
                        <div id="when_opened_account_has_other_account_details_container">

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










                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div id="signaturePanel" style='border: 1px solid black'></div>
                        <?= $form->field($model, 'client_signature_image')->hiddenInput(['id' => 'client_signature'])->label("") ?>
                        <div class="text-center">
                            <?= Html::button('Reset signature panel', ['class' => 'btn btn-default', 'onclick' => 'resetSignature()']) ?>
                        </div>
                        <hr>
                        <div class="form-group">
                            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
                        </div>
                    </div>
                </div>  
            <?php ActiveForm::end(); ?>
        </div><!-- _form -->
    </div>

