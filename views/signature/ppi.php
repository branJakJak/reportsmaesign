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
    h1.panel-title{
        font-size: 30px !important;
        font-weight: bolder;
    }

SCRIPT;
$this->registerCss($customCss);

/*font awesome*/
$this->registerCssFile('//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');


$this->title = "Final Step :: Review your information before afixing your signature.";
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
        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
            <?= Html::img("/images/ppi_top_banner.png", ['class' => 'img-responsive']); ?>            
        </div>
        <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
            <?= Html::img("/images/moneyactive.jpg", ['class' => 'img-responsive']); ?>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <h3 style="
    padding: 24px;
    background: lightgray;
    border-radius: 10px;
    text-align: center;
    font-weight: bolder;
    line-height: 46px;
">
                Our Reference :
                <br>
                <?= Html::encode($model->security_key); ?>
            </h3>
        </div>

    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h3 id="banner-top">
                PPI REFUND CLAIM PACK – Getting YOUR money back 
            </h3>           
        </div>
    </div>
    <div class="row">
        <div class="form">
            <?php $form = ActiveForm::begin([]); ?>
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

                    </div>
                </div>
                <br>
                <?php if ($model->hasErrors()): ?>                    
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h1 class="panel-title">Please fix the following error(s)</h1>
                            </div>
                            <div class="panel-body">
                                <?= Html::errorSummary($model); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif ?>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h1 class="panel-title">Finance Details</h1>
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
                                        <label class="control-label form-label-exclusive">Account Provider</label>
                                    </div>
                                    <div class="col-lg-8 ">
                                        <?= $form->field($model, 'finance_status')->dropDownList([
                                            "Arrears"=>"Arrears",
                                            "Debt Management"=>"Debt Management",
                                            "IVA"=>"IVA",
                                        ])->label("") ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4" >
                                        <label class="control-label form-label-exclusive">
                                            Amount of PPI
                                        </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <br>
                                        <?= $form->field($model, 'amount_ppi' ,['template'=>'
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
                                            ->field($model, 'finance_start') 
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
                                            Finance Provider
                                        </label>
                                    </div>
                                    <div class="col-lg-8"><br>
                                        <?= $form
                                            ->field($model, 'finance_provider')
                                            ->label("")
                                        ?>
                                    </div>                                
                                </div>


                                <div class="row">
                                    <div class="col-lg-4">
                                        <label class="control-label form-label-exclusive">
                                            Did a broker arrange this?
                                        </label>
                                    </div>
                                    <div class="col-lg-8"><br>
                                        <?= $form->field($model, 'did_broker_arrange')->dropDownList(['Yes'=>'Yes','No'=>'No'])->label(''); ?> 
                                    </div>                                
                                </div>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <label class="control-label form-label-exclusive">
                                            Broker Name
                                        </label>
                                    </div>
                                    <div class="col-lg-8"><br>
                                        <?= $form
                                            ->field($model, 'broker_name')
                                            ->label("")
                                        ?>
                                    </div>                                
                                </div>                                
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label class="control-label form-label-exclusive">
                                            Original Loan (or) Average Balance
                                        </label>
                                    </div>
                                    <div class="col-lg-8"><br>

                                        <?= $form->field($model, 'ppi_claim_type')->dropDownList([
                                            'Original Loan'=>'Original Loan',
                                            'Average Balance'=>'Average Balance'
                                        ]); ?>
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
                                            ->field($model, 'finance_end') 
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
                                <h1 class="panel-title">Bank Details</h1>
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
                                <h1 class="panel-title">Disclaimer</h1>
                            </div>
                            <div class="panel-body">

                                <h3 class="text-center">
                                    Payment Protection Insurance Terms of Engagement - Please Read, Date and Sign below.
                                </h3>
                                <p>
                                    ‘I/We’ and ‘the Client’ means the client(s) whose signature appears afoot of these terms and conditions ‘Company’ means
                                    Money Active Ltd.
                                </p>

                                <p>
                                    I/We herewith appoint Money Active Ltd to act exclusively on my/our behalf as my/our representative in respect of my/our
                                    claim/s for any mis-sold Payment Protection Insurance. I/We shall provide all information required by Money Active Ltd, as
                                    requested, by return. I/We shall not enter into any agreement with the Bank/Lender/Broker without first consulting Money
                                    Active Ltd.
                                </p>
                                <strong>Cancellation Conditions:</strong>

                                <p>Money Active Ltd can cancel this agreement at any time and no fee will be payable by you if we think there are no grounds
                                for a complaint or that your claim is unlikely to succeed.</p>

                                <p>Money Active Ltd has the right to terminate the contract by giving written notice to you (the client), also at any time to
                                immediately terminate the contract if the client materially breaches any term of the contract or if the client is
                                adjudicated bankrupt. In the case of redeemable breaches the client will be afforded 28 days to remedy the breach.</p>  

                                <p>You will have the right to terminate the contract within 14 days of signing the contract by giving written or verbal
                                notice to Money Active Ltd
                                </p>

                                <p>In the event that you wish to terminate the contract after the statutory 14 day ‘cooling off’ period you may do so but Money
                                Active Ltd reserve the right to issue a cancellation charge that reflects the work already undertaken in pursuance of your
                                claim, calculated by hourly rate of £45 plus VAT.</p>   

                                <p>If Money Active Ltd has already achieved an offer of compensation that is made in accordance with FCA and FOS guidelines
                                the full fee is payable.</p>

                                <p>A cancellation fee would only be charged if you cancel the contract after 14 days of signing.
                                </p>

                                Cancellation of the agreement must be done by clear statement. For more information, please see our Notice of Right to
                                cancel within the claim pack.


                                <p><strong>Law &amp; Jurisdiction:</strong> In all matters affecting this contract the law applicable to this contract shall be English law and the parties
                                consent to the jurisdiction of the English courts. The Company makes no representation or warranty to the Client that
                                compensation will be obtained or is in any way guaranteed. The Company reserves the right at any time, at its discretion, to
                                not pursue a claim for compensation and in such instances will notify the Client in writing promptly.
                                </p>

                                <p><strong>Compensation:</strong> Compensation refers to the total monies offered by the Third Party (i.e. Loan Company, Lender, Broker, IFA
                                or any other organisation associated with your claim/s) whether as compensation, as a gesture of goodwill, refund, discount
                                or otherwise arising from any claim made by the Company on behalf of the Client for an allegedly mis-sold PPI and/or any
                                offer to reduce any loan amount outstanding and/or any interest or capital recovered. Where such an offer is revised on
                                appeal and subject to the client having not cancelled our agreement, then the higher amount shall be used in order to
                                calculate the amount of the Compensation.</p>

                                <u>
                                <center><strong>Responsibilities:</strong></center>
                                </u>
                                <strong>Money Active Ltd shall:</strong>
                                <ul>
                                    <li>a) Conduct ourselves in the best interest of the client in the pursuance of any potential claim against any financial institution.</li>
                                    <li>b) Afford the client with impartial advice on any risks and benefits of pursing a claim against any financial institution.</li>
                                    <li>c) Endeavour to achieve a satisfactory outcome via complaint to the lender/broker, through the Financial Ombudsman or Financial Services Compensation Scheme, as necessary. Our work is limited to reaching a settlement without court action.</li>
                                    <li>d) Advise the client on the suitability of any offer of settlement on behalf of any financial institution.</li>
                                </ul>

                                <strong>The Client shall:</strong>
                                <ul>
                                    <li>a) Provide Money Active Ltd with full and accurate information and not mislead it or obstruct it in any way.</li>
                                    <li>b) Provide Money Active Ltd with all documents, including in electronic form, in his/her possession relating to / giving evidence to the claim/s.</li>
                                    <li>c) Respond without delay to any request from Money Active Ltd for instructions or further information without delay.</li>
                                    <li>d) Advise Money Active Ltd of any change of address details or contact telephone numbers immediately.</li>
                                    <li>e) Advise Money Active Ltd immediately if the Third Party contacts the client directly regarding the claim.</li>
                                </ul>

                                <strong>Payment & Our Fees:</strong>
                                <p>Money Active Ltd will strive to recover all monies owed and undertake to forward any payment from our bank to you,
                                the client, within 7 days from the date received, subject to the agreed fee of 33% plus VAT.
                                If you are paid the compensation directly we require that you pay our fee no later than 10 days after payment is received by
                                you.</p>

                                <p>If based on all available evidence your offer of compensation is correct and was calculated in accordance with Financial
                                Conduct Authority and Financial Ombudsman Service rules or guidance and we recommend that you accept it and you
                                choose not to accept it our fee must be paid within 20 days of our recommendation.</p>

                                <p>If you fail to pay our fee and Money Active Ltd takes steps to recover any service charges due, the Client shall pay to Money
                                Active Ltd a recovery fee that reflects the cost of work undertaken to recover the fee, in addition to our normal fee.</p>

                                <p>If you fail to pay our fees within our agreed terms you give permission for us to obtain a reference from a credit
                                reference agency, who will perform a credit check on our behalf.</p>

                                <p>You may be paid directly in cash, or a reduction to your balance may be made. If your claim relates to a loan that is still
                                ongoing you may receive compensation both as a cash sum and also a reduction in your future loan payments, in such cases
                                our fee will only be payable on the cash in hand sum.</p>

                                <p>If your claim relates to a credit or store card that is still active the compensation may be paid as a cash sum and/or an
                                amount credited to the card, naturally in such cases our fee will be payable on any amount credited to the card and any cash
                                in hand sum.</p>

                                <br>
                                <h3>Examples of the Company’s fee –</h3>
                                <br>

                                <table class="table table-hover table-bordered">
                                    <tr>
                                        <td colspan="2">
                                            <strong>Example A: All compensation is "cash in hand"            </strong>
                                        </td>
                                        <td colspan="2">
                                            <strong>Example B: Compensation includes "cash in hand" award with loan and future instalment reduction</strong>
                                        </td>
                                        <td colspan="2">
                                            <strong>Example C: Compensations is used to offset arrears consumer has on credit card or loan            </strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Total compensation
                                            Received by Customer:
                                        </td>
                                        <td>
                                            £3,000
                                        </td>
                                        <td>
                                            Total compensation Received by
                                            Customer:
                                        </td>
                                        <td>
                                            £3,000
                                        </td>
                                        <td>
                                            Total compensation Received by
                                            Customer:
                                        </td>
                                        <td>
                                            £3,000
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Loan Reduction by Lender </td>
                                        <td>£0 </td>
                                        <td>Loan Reduction by Lender </td>
                                        <td>£2,000 </td>
                                        <td>Arrears Reduction by Lender </td>
                                        <td>£3,000</td>
                                    </tr>
                                    <tr>
                                        <td>Of which cash received by Customer after Loan reduction</td>
                                        <td>£3,000</td>
                                        <td>Of which cash received by Customer after Loan reduction</td>
                                        <td>£1,000</td>
                                        <td>Of which cash received by Customer after Arrears reduction</td>
                                        <td>£0        </td>
                                    </tr>
                                    <tr>
                                        <td>Money Active Fee charged @ 33% + VAT</td>
                                        <td>£1,188</td>
                                        <td>Money Active Fee charged @ 33% + VAT</td>
                                        <td>£1,188</td>
                                        <td>Money Active Fee charged @ 33% + VAT</td>
                                        <td>£1,188</td>
                                    </tr>
                                    <tr>
                                        <td>Consumer Pays Money Active</td>
                                        <td>£1,188 </td>
                                        <td>Consumer Pays Money Active </td>
                                        <td>£1,188 </td>
                                        <td>Consumer pays Money Active </td>
                                        <td>£1,188    </td>
                                    </tr>
                                </table>

                                <p><strong>No Win No Fee:</strong> Unless you cancel the contract after the 14 day cooling off period you, the Client, shall not pay any fee if
                                an offer of compensation is not achieved via complaint to the lender/broker, through the Financial Ombudsman or Financial
                                Services Compensation Scheme and/or the Company has deemed it appropriate not to pursue a claim for compensation.</p>

                                <p><strong>Complaints:</strong> Money Active Ltd has an internal complaints procedure, included in a separate sheet in your pack.</p>

                                <p><strong><u>Declaration</u>: You should only sign this document if you have read it and agree to be bound by the terms and
                                conditions. By signing this agreement you are entering into a legally binding contract.</strong></p>

                                <center>
                                    <strong style="color:red">Any Questions? Call our helpline, we are happy to answer them – 01455 530 034</strong>
                                </center>


                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h1 class="panel-title">To whom it may concern:</h1>
                            </div>
                            <div class="panel-body">
                                <p>
                                     1. <strong>Authorisation to Money Active Ltd</strong> – I/We hereby give authorisation to Money Active to act on my/our behalf in
                                    pursuing my/our claim/s in respect of advice received from and/or sales made by the company relating to the above and
                                    any other account I/we hold or have held with the company. I/We give Money Active Ltd full authority to refer the
                                    complaint to the Financial Ombudsman Service and/or Financial Services compensation Scheme if this is believed to be in
                                    my/our best interest. I/We further consent that a copy of this agreement holds the same validity as the original
                                    and that this authority will endure until further notice.
                                </p>
                                <p>2 . I/We acknowledge that I/we could pursue this complaint myself/ourselves without the involvement of Money Active Ltd,
                                but that I/we have instead opted to engage Money Active Ltd whose fees will be recoverable from me/us.</p>  
                                <p>3 . <strong>Instructions to the company</strong>- Please take this letter as my/our instructions to you, the company, to deal
                                directly with Money Active Ltd in respect of the complaint and to provide them with any information they
                                request either verbally or in any other media format that they require to pursue my/our complaint. As of the
                                date I/we have signed this letter of authority, we do not wish to receive any correspondence from the company in relation
                                to our complaint.</p>
                                <p>4 . <strong>Compensation</strong> – I authorise that any compensation monies arising from this matter may be paid directly to Money Active
                                Ltd. Such monies will promptly be paid to me/us by Money Active Ltd less their fee for the services carried out by them. I/
                                We have received details of any fees payable contained within our signed letter of engagement.</p>  
                                <p>5. I/We understand that in the eventuality of a successful claim my/our payment protection policy will be terminated and it is
                                my/our responsibility to arrange replacement cover if so required.</p>
                                <p>6 . In the case of an ongoing loan or mortgage I/We require any compensation monies to be paid directly in accordance with
                                article 5 above and not used to reduce an outstanding loan balance other than to reduce future loan payments by means
                                of removal of the PPI.</p>
                                <p>7 . In the case of an active credit or store card account I/We understand that if the card provider uses my redress monies to
                                reduce an outstanding balance on my credit or store card, the total fee will still be payable to Money Active Ltd.</p>
                                <p>8 . <strong>Instructions to third party</strong> – In the eventuality that you need to contact a third party to progress my/our claim for any
                                reason, I/we hereby give my/ our authority and consent for the third party to provide the company and Money Active Ltd
                                with any information they request and may require to pursue my/our claim.
                                I understand that, in addition to the present Letter of Authority I will need to provide further information when raising an
                                expression of dis-satisfaction to the Lender, about the underlying product(s), service(s) and where known, specific account
                                number(s) being complained about. Doing so will enable the Lender to assess and determine the complaint as quickly and
                                as effectively as possible.</p>
                                <p>9 . <strong>Declaration of Truth</strong> – I/We have read and accepted the Money Active Ltd Terms of Engagement and give them full
                                authority to make a claim on my/our behalf. I/We confirm that the information given in this letter is in the best of my/our
                                knowledge accurate and a truthful reflection of my/our recollections of events at the point of sale.</p>
                                <p>10. <strong>Terms of Engagement</strong> – I/We have read and accept the Money Active Ltd Terms of Engagement and give them full
                                authority to make a claim on my/our behalf.</p>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h1 class="panel-title">Payment Protection Insurance: consumer questionnaire</h1>
                            </div>
                            <div class="panel-body">
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <strong>WHAT IS THIS QUESTIONNAIRE FOR?</strong>
                                    <hr>
                                    <ul>
                                        <li>
                                            <p>
                                                This questionnaire is for consumers to bring
                                                a complaint about the sale of payment protection
                                                insurance (PPI).
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                The questionnaire asks you for the personal
                                                and financial details needed to sort out
                                                your complaint.
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                If you’re not sure about anything – or have any
                                                difficulties filling in this questionnaire – phone
                                                us at the Financial Ombudsman Service on
                                                0300 123 6222 or 0800 121 6222 .
                                            </p>
                                        </li>
                                    </ul>                                    
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <strong>WHAT IS THIS QUESTIONNAIRE FOR?</strong>
                                    <hr>
                                    <ul>
                                        <li>
                                            <p>
                                                Please fill in the questionnaire, giving as much
                                                information as you can.
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                It may take you some time to go through the
                                                questionnaire and get all your facts together.
                                                But having all the information in one place should
                                                mean your case can then be assessed more quickly.
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                Once you have completed the questionnaire,
                                                please return it to us at the address at the end.
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                If you have any documents you think may be of
                                                interest, please send copies of them as well.
                                            </p>
                                        </li>
                                    </ul>                                    
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h1 class="panel-title">section A: about you</h1>
                            </div>
                            <div class="panel-body">
                                <h3> A.1 Your name and contact details</h3>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <legend>Name</legend>
                                        <?= $form->field($model, 'salutation')->dropDownList(['Mr'=>'Mr','Mrs'=>'Mrs','Ms'=>'Ms'],['prompt'=>'-- Please select --']) ?>
                                        <?= $form->field($model, 'firstname') ?>
                                        <?= $form->field($model, 'lastname') ?>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                        <legend>Previous Name (If different)</legend>
                                        <?= $form->field($model, 'prev_salutation')->dropDownList(['Mr'=>'Mr','Mrs'=>'Mrs','Ms'=>'Ms'],['prompt'=>'-- Please select --']) ?>
                                        <?= $form->field($model, 'prev_firstname') ?>
                                        <?= $form->field($model, 'prev_lastname') ?>
                                    </div>
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
                                            Daytime Phone
                                        </label>                                    
                                        <?= 
                                        $form->field($model, 'daytime_phone' ,['template'=>'
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
                                            Home Phone
                                        </label>                                    
                                        <?= 
                                        $form->field($model, 'home_phone' ,['template'=>'
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
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <?= 
                                                $form->field($model, 'address5')
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <legend>Previous Address</legend>
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <?= 
                                                $form->field($model, 'prev_postcode')
                                            ?>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <?= 
                                                $form
                                                    ->field($model, 'prev_address1')
                                                ?>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <?= 
                                                $form->field($model, 'prev_address2')
                                            ?>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <?= 
                                                $form
                                                ->field($model, 'prev_address3')
                                            ?>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <?= 
                                                $form->field($model, 'prev_address4')
                                            ?>
                                        </div>                                       
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <?= 
                                                $form->field($model, 'prev_address5')
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <hr>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <h4>Details of anyone complaining with you</h4>
                                        <br>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <legend>Previous Name (If different)</legend>
                                        <?= $form->field($model, 'partner_detail_title')->dropDownList(['Mr'=>'Mr','Mrs'=>'Mrs','Ms'=>'Ms'],['prompt'=>'-- Please select --']) ?>
                                        <?= $form->field($model, 'partner_detail_firstname') ?>
                                        <?= $form->field($model, 'partner_detail_lastname') ?>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <?= 
                                            $form
                                            ->field($model, 'partner_detail_date_of_birth')
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
                                <br>
                                <br>
                                <h3>
                                    A.2 if someone is complaining on your behalf (eg a relative or claims manager) please give us their details                                    
                                </h3>
                                <br>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <table class="table table-hover table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td><strong>Their name : </strong> </td>
                                                    <td>Money Active Limited</td>
                                                    <td><strong>Relationship to you : </strong></td>
                                                    <td>Claims Handler</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Address for writing to them(including postcode) : </strong></td>
                                                    <td>
                                                        <address>
                                                            Wheatfield House, <br>
                                                            Wheatfield Way, <br>
                                                            Hinckley, Leicestershire <br>
                                                            <b>LE10 1YG</b> <br>
                                                        </address>
                                                    </td>
                                                    <td><strong>Their Fax : </strong></td>
                                                    <td>0845 358 2510</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Daytime Phone : </strong></td>
                                                    <td>01455 530 034</td>
                                                    <td><strong>Their Ref : </strong></td>
                                                    <td>n/a</td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                    <br>                                    
                                </div>
                                <br>
                                <h3>
                                    A.3 what’s the name of the financial business you’re complaining about?
                                </h3>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">                                    
                                        <?= $form->field($model, 'financial_business_name')->textInput()->label(""); ?>
                                    </div>
                                </div>
                                <br>
                                <h3>A.4 what’s the policy number of the payment protection insurance you’re complaining about?</h3>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <?= $form->field($model, 'ppi_policy_number')->textInput()->label(""); ?>
                                    </div>
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
 
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h1 class="panel-title">Section B: about the sale of the insurance</h1>
                            </div>
                            <div class="panel-body">
                                <h3>B.1 when did you take out this payment protection insurance?</h3>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <?= 
                                            $form
                                            ->field($model, 'when_did_you_takeout_ppi')
                                                ->widget(DatePicker::classname(), [
                                                    'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                                                    'pluginOptions' => [
                                                        'autoclose'=>true,
                                                        'format' => 'dd-mm-yyyy'
                                                    ]
                                                ])
                                            ->label("");
                                        ?>
                                        <?= $form->field($model, 'can_remember_date_of_ppi_takeout')->checkbox(['label'=>'Can\'t Remember']); ?>
                                    </div>
                                </div>
                                <h3>B.2 did the payment protection insurance provide single cover (to cover just you) or joint cover (to cover you and your partner)?</h3>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <?= $form->field($model, 'is_joint')->radioList([
                                            1=>'single',
                                            2=>'joint'
                                        ])->label(""); ?>
                                    </div>
                                </div>
                                <h3>B.3 how was this insurance sold to you?</h3>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <?= $form->field($model, 'how_was_ppi_sold')->dropDownList([
                                                'during a meeting'=>'during a meeting',
                                                'during a phone conversation'=>'during a phone conversation',
                                                'you were given a leaflet to fill in'=>'you were given a leaflet to fill in',
                                                'over the internet'=>'over the internet',
                                                'by post'=>'by post',
                                                'can’t remember'=>'can’t remember',
                                        ], [])->hint('You might have been sold the insurnce at a different time to when you look out your loan or credit')->label(''); ?>
                                    </div>
                                </div>
                                <h3>B.4 did the financial business give you advice or recommend that you take out this insurance?</h3>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <?= $form->field($model, 'did_financial_business_give_advice')->radioList([
                                                'Yes'=>'Yes',
                                                'No'=>'No',
                                                'can’t remember'=>'can’t remember',
                                        ], [])->label('')
                                        ?>
                                    </div>
                                </div>
                                <h3 >B.5 how did you pay for this insurance?</h3>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <?= $form->field($model, 'ppi_payment_method')->dropDownList([
                                                'with a single payment (“premium”) paid up-front as a one-off'=>'with a single payment (“premium”) paid up-front as a one-off',
                                                'with a “premium” paid each month'=>'with a “premium” paid each month',
                                                'not sure'=>'not sure',
                                        ], [])->label('')
                                        ?>
                                    </div>
                                </div>
                                <h3>B.6 what’s the current situation with this insurance?</h3>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <?= $form->field($model, 'ppi_insurance_current_situation')->dropDownList([
                                                'the insurance is still running'=>'the insurance is still running',
                                                'the insurance ended when the loan was paid off (or when the credit card account was closed)'=>'the insurance ended when the loan was paid off (or when the credit card account was closed)',
                                                'the insurance was cancelled (if so, when did this happen?)'=>'the insurance was cancelled (if so, when did this happen?)',
                                        ], [])->label('')
                                        ?>
                                        <?= 
                                            $form
                                            ->field($model, 'ppi_insurance_cancelled_situation_date')
                                                ->widget(DatePicker::classname(), [
                                                    'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                                                    'pluginOptions' => [
                                                        'autoclose'=>true,
                                                        'format' => 'dd-mm-yyyy'
                                                    ]
                                                ])
                                            ->label("Date of cancellation (If insurance is cancelled)");
                                        ?>   
                                    </div>
                                </div>
                                <h3>B.7 have you ever made a claim on the payment protection insurance you’re complaining about?</h3>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">   
                                        <?= $form->field($model, 'had_a_claim_ppi_insurance')->radioList(['Yes'=>'Yes','No'=>'No'], [])->label(''); ?>
                                        <?= $form->field($model, 'had_a_claim_ppi_insurance_details')->textarea(['style' => 'margin-top: 0px; margin-bottom: 0px; height: 212px;'])->label(' If “yes”, tell us below why you claimed on the policy (for example, you were made unemployed) and the date of your claim. Also tell us if the insurer turned down your claim. <br><br><br> Please enclose copies of any paperwork you received from the insurer about this claim.'); ?>
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
                                <h1 class="panel-title">Section C: about the money you borrowed</h1>
                            </div>
                            <div class="panel-body">
                                <h3>C.1 what did you buy the payment protection insurance to cover?</h3>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <?= $form->field($model, 'bought_cover_with_ppi_insurance')->checkboxList([
                                            'a personal loan'=>'a personal loan',
                                            'a business loan'=>'a business loan',
                                            'a credit card'=>'a credit card',
                                            'a mortgage'=>'a mortgage',
                                            'an overdraft'=>'an overdraft',
                                            'a store card'=>'a store card',
                                            'a loan secured on your home in addition to your mortgage'=>'a loan secured on your home in addition to your mortgage',
                                            'catalogue shopping'=>'catalogue shopping',
                                            'hire purchase'=>'hire purchase',
                                            'not sure'=>'not sure'
                                        ], ['separator'=>'<br>']); ?>
                                        <?= $form->field($model, 'account_number')->textInput()->label('What was the account number ?')->hint('This account number will be different to the insurance policy number on page 1 (at question A.4).'); ?>
                                    </div>
                                </div>
                                <h3>C.2 what was your reason for borrowing the money (or taking out the credit)?</h3>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <?= $form->field($model, 'reason_of_borrowing')->checkboxList([
                                            'refinancing or consolidating other debts'=>'refinancing or consolidating other debts (if so, please complete question C.3 on the next page )',
                                            'buying a car'=>'buying a car',
                                            'paying for home improvements'=>'paying for home improvements',
                                            'paying for a wedding'=>'paying for a wedding',
                                            'paying for a holiday'=>'paying for a holiday',
                                            'non-essential spending (for example, buying a new TV)'=>'non-essential spending (for example, buying a new TV)',
                                            'essential everyday spending (for example, rent, household bills or food shopping)'=>'essential everyday spending (for example, rent, household bills or food shopping)',
                                            'business loan'=>'business loan',
                                            'other (please tell us more below)'=>'other (please tell us more below)',
                                        ], ['separator'=>'<br>']); ?>
                                    </div>
                                </div>
                                <h3>C.3 if you borrowed the money to pay off other debts, please tell us more about those debts?</h3>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>what were the names of the companies you had those other debts with?</th>
                                                    <th>were they credit cards or loans?</th>
                                                    <th>how much did you owe?</th>
                                                    <th>when did you take them out?</th>
                                                    <th>when did you pay them off?</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $borrowed_money_to_payoff_debt_details_temp_container = json_decode($model->borrowed_money_to_payoff_debt_details , true);

                                                ?>
                                                <?php foreach (range(0, 2) as $key => $value): ?>
                                                <tr>
                                                    <td><?= Html::textInput('borrowed_money_to_payoff_debt_details[company_debt_with][]',@$borrowed_money_to_payoff_debt_details_temp_container['company_debt_with'][$key],['class'=>'form-control']); ?></td>
                                                    <td>
                                                        <?= Html::dropDownList('borrowed_money_to_payoff_debt_details[is_credit_loan][]', @$borrowed_money_to_payoff_debt_details_temp_container['is_credit_loan'][$key], ['credit'=>'credit','loan'=>'loan'] , ['class'=>'form-control','prompt'=>'Select type']); ?>    
                                                    </td>
                                                    <td>
                                                       <div class="input-group col-lg-12 ">
                                                          <span class="input-group-addon" style="padding-bottom: 3px;padding-top: 3px;font-size: 13px">
                                                            &pound;
                                                          </span>
                                                         <?= Html::textInput('borrowed_money_to_payoff_debt_details[how_much_owe][]',@$borrowed_money_to_payoff_debt_details_temp_container['how_much_owe'][$key],['class'=>'form-control']); ?>
                                                       </div>
                                                    </td>
                                                    <td>
                                                        <?= 
                                                            DatePicker::widget([
                                                                'name'  => 'borrowed_money_to_payoff_debt_details[when_borrowed][]',
                                                                'value' => @$borrowed_money_to_payoff_debt_details_temp_container['when_borrowed'][$key],
                                                                'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                                                                'pluginOptions'=>[
                                                                    'autoclose'=>true,
                                                                    'format' => 'dd-mm-yyyy'
                                                                ]
                                                            ]);
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?= 
                                                            DatePicker::widget([
                                                                'name'  => 'borrowed_money_to_payoff_debt_details[when_paid][]',
                                                                'value' => @$borrowed_money_to_payoff_debt_details_temp_container['when_paid'][$key],                                                                
                                                                'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                                                                'pluginOptions'=>[
                                                                    'autoclose'=>true,
                                                                    'format' => 'dd-mm-yyyy'
                                                                ]
                                                            ]);
                                                        ?>                                                        
                                                    </td>
                                                </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- borrowed_money_to_payoff_debt_details -->
                                </div>
                                <h3>C.4 have you ever missed payments – or gone into arrears – on the loan or credit you listed in question C.1?</h3>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <?= $form->field($model, 'ever_missed_payments')->radioList(['Yes'=>'Yes','No'=>'No'], [])->label('')->hint('* If “yes”, please tell us more below. <br>For example – how many times have you missed payments and by how much – and what’s your current situation?'); ?>
                                        <?= $form->field($model, 'ever_missed_payments_explanation')->textarea(['style' => 'height: 150px;'])->label(''); ?>
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
                                <h1 class="panel-title">Section D: about your personal circumstances</h1>
                            </div>
                            <div class="panel-body">
                                <h3>D.1 at the time you took out the payment protection insurance, what was your employment status (and your partner’s – if relevant)?</h3>
                                <hr>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                        <strong>You</strong>
                                        <?= 
                                            $form->field($model, 'employment_status_during_ppi_payment_you')->dropDownList([
                                                'employed'=>'employed',
                                                'self employed'=>'self employed',
                                                'temporary / agency worker'=>'temporary / agency worker',
                                                'not working'=>'not working',
                                                'retired'=>'retired',
                                                'director of own company'=>'director of own company',
                                                'student in full-time or part-time education'=>'student in full-time or part-time education',
                                                'working fewer than 16 hours'=>'working fewer than 16 hours',
                                                'not known'=>'not known',
                                                'other'=>'other',
                                            ])
                                            ->label('')
                                            ->hint('If you were a student – but also had a job –');
                                        ?>
                                        <label>how many hours were you working each week?</label>
                                        <?= $form->field($model, 'employment_status_during_ppi_payment_you_hours_work')->textInput()->label(''); ?>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                        <strong>Your Partner</strong>
                                        <?= 
                                            $form->field($model, 'employment_status_during_ppi_payment_partner')->dropDownList([
                                                'employed'=>'employed',
                                                'self employed'=>'self employed',
                                                'temporary / agency worker',
                                                'not working',
                                                'retired',
                                                'director of own company',
                                                'student in full-time or part-time education',
                                                'working fewer than 16 hours',
                                                'not known',
                                                'other',
                                            ])
                                            ->label('')
                                            ->hint('If you were a student – but also had a job –');
                                        ?>
                                        <label>how many hours were you working each week?</label>                                        
                                        <?= $form->field($model, 'employment_status_during_ppi_payment_partner_hours_work')->textInput()->label(''); ?>                                        
                                    </div>
                                </div>
                                <h3>D.2 if your employment status has changed since you took out the insurance, tell us how.</h3>
                                <hr>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="hint">For example – if you were self-employed, but are now employed.</div>
                                        <?= $form->field($model, 'employment_status_change_details')->textarea(['style'=>'margin-top: 0px; margin-bottom: 0px; height: 200px;']); ?>
                                    </div>
                                </div>
                                <h3>D.3 what type of work did you do when you took out the payment protection insurance – and what was the name of your employer?</h3>
                                <hr>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                        <legend>You</legend>
                                        <?= $form->field($model, 'type_of_work_ppi_you')->textInput()->label('Type of work'); ?>
                                        <?= $form->field($model, 'name_of_employer_you')->textInput()->label('Name of your employer(s)'); ?>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                        <legend>Your Partner</legend>
                                        <?= $form->field($model, 'type_of_work_ppi_partner')->textInput()->label('Type of work'); ?>                                        
                                        <?= $form->field($model, 'name_of_employer_partner')->textInput()->label('Name of your employer(s)'); ?>                                        
                                    </div>
                                </div>
                                <h3>D.4 how long had you been working there, when you took out the payment protection insurance?</h3>
                                <hr>
                                <div class="row">
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                        <label>You</label>
                                        <?= $form->field($model, 'how_long_been_working_years_you')->textInput()->hint("years")->label(''); ?>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                        <label></label>
                                        <?= $form->field($model, 'how_long_been_working_months_you')->textInput()->hint("months")->label(''); ?>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                        <label>Your Partner</label>
                                        <?= $form->field($model, 'how_long_been_working_years_partner')->textInput()->hint("years")->label(''); ?>
                                    </div>                                    
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                        <label></label>
                                        <?= $form->field($model, 'how_long_been_working_months_partner')->textInput()->hint("months")->label(''); ?>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                                    </div>
                                </div>

                                <h3>D.5 if you were employed when you took out the insurance, would you have received any pay from your employer – if you were off work due to sickness or an accident – or if you were made redundant?</h3>
                                <hr>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                        <strong>You</strong>
                                        <br>
                                        <br>
                                        <?= $form->field($model, 'would_you_still_receive_payment')->dropDownList([
                                            'Yes'=>'Yes',
                                            'No'=>'No',
                                            "Can't remember"=>"Can't remember",
                                            'Not relevant'=>'Not relevant',
                                        ]); ?>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                        <strong>Your Partner</strong>
                                        <br>
                                        <br>
                                        <?= $form->field($model, 'would_partner_still_receive_payment')->dropDownList([
                                            'Yes'=>'Yes',
                                            'No'=>'No',
                                            "Can't remember"=>"Can't remember",
                                            'Not relevant'=>'Not relevant',
                                        ])->label(''); ?>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <strong>* If “yes”, what pay would you have received from your employer?</strong>
                                        <?= 
                                            $form->field($model, 'would_you_still_receive_payment_details')->dropDownList([
                                                'less than 3 months'=>'less than 3 months',
                                                '3 months or more, but less than 6 months'=>'3 months or more, but less than 6 months',
                                                '6 months or more, but less than 12 months'=>'6 months or more, but less than 12 months',
                                                '12 months or more'=>'12 months or more',
                                                'no pay (or statutory pay)'=>'no pay (or statutory pay)',
                                                'other (please tell us more below)'=>'other (please tell us more below)'                                        
                                            ])->label('');
                                        ?>
                                        <label>If "Others"</label>
                                        <?= Html::textarea('would_you_still_receive_payment_details_other', '', ['style' => "margin: 0px -1px 0px 0px; width: 1138px; height: 201px;"]); ?>
                                    </div>
                                </div>
                                <h3>D.6 if you hadn’t been able to work (because you were ill, in an accident or had been made redundant), would you have had any other way of making your repayments?</h3>
                                <hr>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="hint">For example – from savings or other insurance policies.</div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                        <label>You</label>
                                        <?= $form->field($model, 'other_way_of_making_money_for_repayments_you')->dropDownList(['Yes'=>'Yes','No'=>'No'])->label(''); ?>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                        <label>Your Partner</label>
                                        <?= $form->field($model, 'other_way_of_making_money_for_repayments_partner')->dropDownList(['Yes'=>'Yes','No'=>'No'])->label(''); ?>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <strong class="hint">* If “yes”, how would you have made your repayments – if you hadn’t been able to work?</strong>
                                        <?= $form->field($model, 'other_way_of_making_money_for_repayments_you_details')->dropDownList([
                                            'from savings or insurance – worth less than 3 months of your pay'=>'from savings or insurance – worth less than 3 months of your pay',
                                            'from savings or insurance – worth 3 months or more, but less than 6 months of your pay'=>'from savings or insurance – worth 3 months or more, but less than 6 months of your pay',
                                            'from savings or insurance – worth 6 months or more, but less than 12 months of your pay'=>'from savings or insurance – worth 6 months or more, but less than 12 months of your pay',
                                            'from savings or insurance – worth 12 months or more of your pay'=>'from savings or insurance – worth 12 months or more of your pay',
                                            'none'=>'none',
                                            'by some other means (please tell us more below)'=>'by some other means (please tell us more below)'
                                        ])->label(''); ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <h3>D.7 when you took out this insurance, did you or your partner have any health problems –    or were either of you registered as disabled?</h3>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                        <?= $form->field($model, 'has_health_problems_you')->dropDownList(['Yes'=>'Yes','No'=>'No'])->label(''); ?>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                        <?= $form->field($model, 'has_health_problems_partner')->dropDownList(['Yes'=>'Yes','No'=>'No'])->label(''); ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="hint">
                                            * If “yes”, have you ever been off work because of this condition – and if so, for how long?
                                        </div>
                                        <?= 
                                            $form
                                            ->field($model, 'has_health_problems_you_details')
                                            ->textarea(['style'=>'margin-top: 0px; margin-bottom: 0px; height: 200px;'])
                                            ->label("");
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
                                <h1 class="panel-title">section E: about your complaint</h1>
                            </div>
                            <div class="panel-body">
                                <!-- TODO -->
                                <h4>this page is for you to tell us what happened – when you took out the payment protection insurance</h4>
                                <div style="border: 10px; ">
                                    For example, please tell us any details you remember about:
                                    <ul>
                                        <li>Where the sale took place – and who you spoke to at the financial business.</li>
                                        <li>The information you were given before you took out the insurance.</li>
                                        <li>How the cost, benefits and terms of the insurance were explained to you.</li>
                                        <li>The questions you asked before taking out the insurance.</li>
                                        <li>Why you decided to take out the insurance.                                    </li>
                                    </ul>
                                    
                                    <?= 
                                        $form
                                        ->field($model, 'what_happen_tookout_payment_protection')
                                        ->textarea(['style'=>'margin-top: 0px; margin-bottom: 0px; height: 200px;'])
                                        ->label('')
                                    ?>
                                    <br>
                                    <strong style='background-color : lightgray; color: black;padding: 15px; font-size: 20px; margin: 30px 20px; '>Please send us copies of any documents you have from when you took out the payment protection insurance.</strong>                  
                                    <br>
                                    <br>
                                    <h3>finally, tell us why you are now unhappy with the insurance</h3>
                                    <?= 
                                        $form
                                        ->field($model, 'reason_of_unhappiness_with_insurance')
                                        ->textarea(['style'=>'margin-top: 0px; margin-bottom: 0px; height: 200px;'])
                                        ->label('')
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h1 class="panel-title">Financial Ombudsman Service</h1>
                            </div>
                            <div class="panel-body">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">                                
                                    <?= Html::img('/images/ombudsman.jpg'); ?>
                                    <br>
                                    <h4>if you’re complaining on behalf of a business, charity or trust please fill in these details</h4>
                                    <h4>Please use this form to tell us about your complaint – so we can see if we’re able to help you.
                                    If you’re not sure about anything – or have difficulties filling in this form – just phone us on 0300 123 9 123.</h4>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <div style="background-color: lightgray;font-size: 18px;padding: 20px;border-radius: 20px;">
                                        Please let us know if you have any practical
                                        needs where we could help – for example with
                                        information in another format (eg large print,
                                        Braille etc) or in a different language.
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <div style="background-color: lightgray;font-size: 18px;padding: 20px;border-radius: 20px;">
                                        You can download this form off our website
                                        (www.financial-ombudsman.org.uk) to complete
                                        by hand. Or you can fill it in on screen – then print
                                        it off and post it back to us.                                        
                                    </div>
                                </div>


                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <legend>
                                        if someone is complaining on your behalf (eg a solicitor or relative) please give us their details
                                    </legend>
                                    <table class="table table-bordered table-hover">
                                        <tbody>
                                            <tr>
                                                <td>their name </td>
                                                <td> Money Active Limited</td>
                                                <td>relationship to you</td>
                                                <td>Claims Handler</td>
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
                                <h3 class="sub-section-header">
                                    if you’re complaining on behalf of a business, charity or trust please fill in these details
                                </h3>

                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <table class="table table-bordered table-hover">
                                        <tbody>
                                            <tr>
                                                <td>Full Official Name</td>
                                                <td><?= $form->field($model, 'complaining_on_behalf_name')->textInput()->label(""); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Number of employees</td>
                                                 <td><?= $form->field($model, 'complaining_on_behalf_of_a_business_num_employees')->textInput()->label(""); ?></td>
                                            </tr>
                                            <tr>
                                                <td>If a partnership, the number of partners </td>
                                                <td><?= $form->field($model, 'complaining_on_behalf_of_a_business_num_partners')->textInput()->label(""); ?></td>
                                            </tr>
                                            <tr>
                                                <td>its annual turnover, annual income or net asset value (at the time you first complained) *</td>
                                                <td><?= $form->field($model, 'complaining_on_behalf_of_a_business_annual_income')->textInput()->label(""); ?></td>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <i>
                                    * We may ask you for evidence of this. Please phone us – or look on our website – for information about what types of businesses, charities and trusts can use our service.
                                </i>
                                <br>
                                <br>
                                <h3 class="sub-section-header">
                                    Details of the business you think is responsible for your complaint
                                </h3>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">                            
                                    <table class="table table-bordered table-hover">
                                        <tbody>
                                            <tr>
                                                <td>Their name</td>
                                                <td><?= $form->field($model, 'company_details_responsible_on_complaint_name')->textInput()->label(""); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Their address (include postcode)</td>
                                                <td><?= $form->field($model, 'company_details_responsible_on_complaint_address')->textarea(['style'=>'margin-top: 0px; margin-bottom: 0px; height: 200px;'])->label(""); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Their phone number</td>
                                                <td><?= $form->field($model, 'company_details_responsible_on_complaint_phone')->textInput()->label(""); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <br>
                                <h3 class="sub-section-header">
                                    Details of the adviser or business who originally sold the product or service
                                    you’re complaining about <small>(if different from the name above)</small>
                                </h3>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <table class="table table-bordered table-hover">
                                        <tbody>
                                            <tr>
                                                <td>Their name</td>
                                                <td><?= $form->field($model, 'adviser_who_sold_product_name')->textInput()->label(""); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Their address (include postcode)</td>
                                                <td><?= $form->field($model, 'adviser_who_sold_product_address')->textarea(['style'=>'margin-top: 0px; margin-bottom: 0px; height: 200px;'])->label(""); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Their phone number</td>
                                                <td><?= $form->field($model, 'adviser_who_sold_product_phone_number')->textInput()->label(""); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <br>
                                <h3 class="sub-section-header">
                                    The kind of product or service you’re complaining about
                                    the name and type of product or service
                                </h3>

                                <?= $form->field($model, 'kind_of_service_complained')->textInput()->label(""); ?>

                                <h3 class="sub-section-header">
                                    Any reference number (eg your account and sort code;
                                    hire-agreement or loan number; policy or claim number)
                                </h3>
                                <?= $form->field($model, 'kind_of_service_complained_reference_number')->textInput()->label(""); ?>
                                
                                <h3 class="sub-section-header">
                                    Please tell us what your complaint is about
                                </h3>
                                <?= 
                                    $form
                                        ->field($model, 'full_complain_details')
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
                                <br>
                                 <label>When did the advice, service or transaction you’re complaining about take place?</label>
                                 <!-- datepicker  -->
                                <?= $form
                                    ->field($model, 'when_did_transaction_take_place') 
                                    ->widget(DatePicker::classname(), [
                                        'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                                        'pluginOptions' => [
                                            'autoclose'=>true,
                                            'format' => 'dd-mm-yyyy'
                                        ]
                                    ])
                                    ->label("")
                                ?>
                                <br>
                                 <label>When did you first complain to the business you think is responsible?</label>
                                 <!-- datepicker -->
                                <?= $form
                                    ->field($model, 'first_complain_took_place') 
                                    ->widget(DatePicker::classname(), [
                                        'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                                        'pluginOptions' => [
                                            'autoclose'=>true,
                                            'format' => 'dd-mm-yyyy'
                                        ]
                                    ])
                                    ->label("")
                                ?>
                                <small>
                                    The business has eight weeks from this date to send you its final written answer – before we can investigate the complaint.
                                </small>
                                <!-- todo final page -->
                                <h2 class="sub-section-header">
                                    Just a few more questions
                                </h2>
                                <br>

                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                            <h4>
                                                Has the business you’re complaining about sent you its final written answer?
                                                <br><small>Please enclose a copy of the last letter that the business sent you.</small>
                                            </h4>
                                        </div>
                                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                            <?= $form->field($model, 'did_company_sent_message')->radioList(['Yes'=>'Yes','No'=>'No'])->label(""); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                            <h4>
                                                Has there been any court action relating to your complaint (or is any planned)?
                                                <br><small>* If YES, please enclose copies of relevant paperwork.</small>
                                            </h4>
                                        </div>
                                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                             <?= $form->field($model, 'any_court_action')->radioList(['Yes'=>'Yes','No'=>'No'])->label(""); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <h4>
                                                 How do you want the business to put things right for you?
                                            </h4>
                                            <?= $form->field($model, 'settlement_details')->label("")->textarea(['style'=>'margin-top: 0px; margin-bottom: 0px; height: 200px;']); ?>                                       
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h2>
                                    Accessibility and practical needs
                                </h2>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="col-lg-9">
                                            <h4>
                                                Do you have any practical needs where we could help – by making adjustments like
                                                using large print, Braille or a different language? <br>
                                                <small>* If YES, please tell us how we can help you.</small>
                                            </h4>
                                        </div>
                                        <div class="col-lg-3">
                                            <?= $form->field($model, 'has_accessibility_problem')->radioList(['Yes'=>'Yes','No'=>'No'])->label(""); ?>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="alert alert-info">
                                    <h2>
                                        Finally, please read and sign this declaration
                                    </h2>
                                    <div>
                                        I’d like the Financial Ombudsman Service to look into my complaint. To the best of my
                                        knowledge, all the information I’ve given you is accurate.
                                        <ul>
                                            <li>I understand that you usually resolve complaints by phone, letter and email.</li>

                                            <li>
                                                I understand that you will need some personal details about me, that you might need to
                                                share information I give you – including sensitive or personal information – with the
                                                business involved and other relevant organisations, and that you might need to ask them
                                                for information that’s relevant to my case.
                                            </li>

                                            <li>
                                                I understand that you have a duty to publish your ombudsmen’s final decisions on your
                                                website – with consumers’ details removed - but that most cases can be resolved before
                                                they reach an ombudsman
                                            </li>
                                            <li>
                                                I understand that to help you provide the best possible service, you (or a trusted third party)
                                                might ask me about my experience. And though you sometimes publish anonymous
                                                examples of the cases you look at, you’ll always keep my information confidential.
                                            </li>
                                            <li>You need to sign, even if someone else is complaining on your behalf. This shows you have
                                            given them your permission to complain for you.</li>
                                            <Li>For complaints involving accounts or policies held jointly, each person needs to sign.</Li>
                                            <li>If you’re signing on behalf of a business, please give your job title.</li>
                                        </ul>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <strong>post to …</strong> <br>
                                        Financial Ombudsman Service <br>
                                        Exchange Tower <br>
                                        London E14 9SR <br>                                    
                                    </div>
                                    <div class="col-lg-6">
                                        <?= 
                                            $form
                                            ->field($model, 'final_tick_checklist')
                                            ->label("Please tick  to show you have …")
                                            ->checkboxList([
                                                    "enclosed a copy of the business’s last letter to you."=>"enclosed a copy of the business’s last letter to you.",
                                                    "enclosed copies of other relevant information."=>"enclosed copies of other relevant information.",
                                                    "included everything you want to tell us about your complaint."=>"included everything you want to tell us about your complaint.",
                                            ])
                                        ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                        <h4 class="text-left">
                                            <strong>0300 123 9 123 or 0800 023 4567</strong>  <br>
                                            <small>
                                                calls are recorded for training <br>
                                                and monitoring purposes 
                                            </small>
                                        </h4>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                        <h4 class="text-right">
                                            <strong>fax 020 7964 1001 dx 141280 Isle of Dogs</strong> <br>
                                            <small>
                                            <?= Html::mailto('complaint.info@financial-ombudsman.org.uk', 'complaint.info@financial-ombudsman.org.uk'); ?>
                                            <br>
                                            <a href="www.financial-ombudsman.org.uk">www.financial-ombudsman.org.uk</a>
                                            <br>
                                            </small>
                                        </h4>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <canvas class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style='border: 1px solid black;min-height: 250px;' id="signaturePanel"></canvas>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-center signature-label-text">
                            <strong>Signature</strong>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 signature-date-label-text">
                            <?= date("F j, Y"); ?>
                        </div>
                        <?= $form->field($model, 'client_signature_image')->hiddenInput(['id' => 'client_signature'])->label("") ?>
                        <div class="text-center">
                            <?= Html::button('Reset signature panel', ['id'=>'clearButton','class' => 'btn btn-default', 'data-action' => 'clear']) ?>
                        </div>
                        <hr>
                        <div class="form-group">
                            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary btn-block', 'id'=>'signed-btn','name' => 'sign-button','data-action' => 'save']) ?>
                        </div>
                    </div>
                </div>                




                </div>
            <?php ActiveForm::end(); ?>
        </div><!-- _form -->
    </div>

