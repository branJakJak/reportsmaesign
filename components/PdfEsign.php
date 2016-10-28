<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 10/11/16
 * Time: 11:55 PM
 */

namespace app\components;


use TCPDF;
use yii\base\Component;

class PdfEsign extends Component
{
    public $leadData;
    protected $htmlContents;

    public function init()
    {
        parent::init();
    }

    /**
     * Exports the pdf file using leadData
     * @return string The location of exported pdf
     */
    public function export()
    {
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('esign.site8.co');
        $pdf->SetTitle('esign');
        $pdf->SetSubject('esign');
        // $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 052', PDF_HEADER_STRING);
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // $signatureFile = \Yii::getAlias("@app/signatures").'/'.'81036890-www.site8.co_.cert';
        // $certificate = 'file://'.realpath($signatureFile);

        // set document signature
        // $pdf->setSignature($certificate, $certificate, 'esign.site8', '', 2, []);

        $pdf->SetFont('helvetica', '', 12);
        $pdf->AddPage(18);
        $pdf->writeHTML($this->htmlContents, true, 0, true, 0);
        // $pdf->setSignatureAppearance(180, 60, 15, 15);
        $pdf->addEmptySignatureAppearance(180, 80, 15, 15);
        $pdfOutput = \Yii::getAlias("@web/pdf/" . uniqid().'.pdf');

        // $pdf->Output($pdfOutput,'D');//download
        $pdf->Output($pdfOutput,'I');
    }

    public function setContent($htmlContents)
    {
        $this->htmlContents = $htmlContents;
    }
} 