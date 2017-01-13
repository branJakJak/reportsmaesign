<?php
/* @var $this yii\web\View */


use kartik\widgets\Growl;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use kartik\date\DatePicker;


// $this->registerJsFile('js/signature_pad-1.5.3/signature_pad.min.js', ['position' => \yii\web\View::POS_END, 'depends' => \yii\web\JqueryAsset::className()]);
$this->registerJsFile('js/signature_pad-1.5.3/signature_pad.js', ['position' => \yii\web\View::POS_END, 'depends' => \yii\web\JqueryAsset::className()]);

$signaturePanelJs = <<< SCRIPT
    var clearButton = document.getElementById("clearButton"),
        wrapper = document.getElementById("signature-wrapper"),
        saveButton = document.getElementById("signed-btn"),
        canvas = document.getElementById("signaturePanel"),
        signaturePad;

    signaturePad = new SignaturePad(canvas);

    clearButton.addEventListener("click", function (event) {
        signaturePad.clear();
    });
    function resizeCanvas() {
        var ratio =  Math.max(window.devicePixelRatio || 1, 1);
        canvas.width = canvas.offsetWidth * ratio;
        canvas.height = canvas.offsetHeight * ratio;
        canvas.getContext("2d").scale(ratio, ratio);
    }

    //before submit  , assign the data to client_signature_image
    jQuery("form:eq(0)").submit(function(event) {
        encodedImage = signaturePad.toDataURL();
        jQuery("#client_signature").val(encodedImage.substr(encodedImage.indexOf(',')));
    });
    window.onresize = resizeCanvas;
    resizeCanvas();
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

<style type="text/css">
    /* Smartphones (portrait and landscape) ----------- */
    @media only screen and (min-width : 320px) and (max-width : 480px) {
        #signaturePanel {
            margin-bottom: -20px;
        }
        .signature-label-text ,.signature-date-label-text{
            font-size: 10px !important;
        }
    }

    /* Smartphones (landscape) ----------- */
    @media only screen and (min-width : 321px) {
        #signaturePanel {
            margin-bottom: -25px;
        }

    }

    /* Smartphones (portrait) ----------- */
    @media only screen and (max-width : 320px) {
    /* Styles */
    }

    /* iPads (portrait and landscape) ----------- */
    @media only screen and (min-width : 768px) and (max-width : 1024px) {
    /* Styles */
    }

    /* iPads (landscape) ----------- */
    @media only screen and (min-width : 768px) and (max-width : 1024px) and (orientation : landscape) {
    /* Styles */
    }

    /* iPads (portrait) ----------- */
    @media only screen and (min-width : 768px) and (max-width : 1024px) and (orientation : portrait) {
    /* Styles */
    }

    /* Desktops and laptops ----------- */
    @media only screen and (min-width : 1224px) {
    /* Styles */
    }

    /* Large screens ----------- */
    @media only screen and (min-width : 1824px) {
    /* Styles */
    }

    
    /*exclusive for iPhone 6 - because they are rich*/
    /*iPhone 6 Portrait*/
    @media only screen and (min-device-width: 375px) and (max-device-width: 667px) and (orientation : portrait) { 
        #signaturePanel {
            margin-bottom: -20px;
        }
    }

    /*iPhone 6 landscape*/
    @media only screen and (min-device-width: 375px) and (max-device-width: 667px) and (orientation : landscape) { 

    }

    /*iPhone 6+ Portrait*/
    @media only screen and (min-device-width: 414px) and (max-device-width: 736px) and (orientation : portrait) { 

    }

    /*iPhone 6+ landscape*/
    @media only screen and (min-device-width: 414px) and (max-device-width: 736px) and (orientation : landscape) { 

    }

    /*iPhone 6 and iPhone 6+ portrait and landscape*/
    @media only screen and (max-device-width: 640px), only screen and (max-device-width: 667px), only screen and (max-width: 480px){ 
    }

    /*iPhone 6 and iPhone 6+ portrait*/
    @media only screen and (max-device-width: 640px), only screen and (max-device-width: 667px), only screen and (max-width: 480px) and (orientation : portrait){ 

    }

    /*iPhone 6 and iPhone 6+ landscape*/
    @media only screen and (max-device-width: 640px), only screen and (max-device-width: 667px), only screen and (max-width: 480px) and (orientation : landscape){ 

    }
</style>


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
                        <div class="alert">
                            <h3>
                                <strong>Final Step</strong>
                                <p>
                                    Review your information before afixing your signature.
                                </p>
                            </h1>
                        </div>
                        <br>
                        <div class="alert">
                            <h3>
                                <strong>Money Active System Reference</strong>
                                <p>
                                    <?= Html::encode($model->security_key); ?>
                                </p>
                            </h1>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
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
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
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
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">Bank Details</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-4">
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
                                    <div class="col-lg-4">
                                        <label class="form-label-exclusive">
                                            Sort Code
                                        </label>
                                    </div>
                                    <div class="col-lg-8">

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label class="control-label form-label-exclusive">Is the account just in your name or joint names?</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <?= $form->field($model, 'ppi_claim_type')->dropDownList(['Single'=>'Single','Joint'=>'Joint'])->label("") ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label class="control-label form-label-exclusive">Account Provider</label>
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
                                    <div class="col-lg-4" >
                                        <label class="control-label form-label-exclusive">
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
                                    <div class="col-lg-4">
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
                                    <div class="col-lg-4">
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

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
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
                                    <h4 style="color:red" class="text-center">
                                        Mis-sold Packaged Bank Account &amp; Payment Protection Insurance Terms of Engageme nt -
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
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">Section A</h3>
                            </div>
                            <div class="panel-body">
                                <h2 class="section-header">Section A: about your packaged bank account</h2>
                                <hr>


                                <strong class="sub-section-header">A2. what is the name of the financial business you are complaining about?</strong>
                                <?= $form->field($model, 'financial_business_name')->label("") ?>



                                <br>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <strong class="sub-section-header">A5. details of the packaged bank account holder(s)</strong>
                                        <?= $form->field($model, 'salutation')->dropDownList(['Mr'=>'Mr','Mrs'=>'Mrs','Ms'=>'Ms'])->label("") ?>
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
                </div>

                </div>
            <?php ActiveForm::end(); ?>
        </div><!-- _form -->
    </div>

