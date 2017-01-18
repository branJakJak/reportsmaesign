<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 1/11/17
 * Time: 1:16 AM
 */

namespace app\models\events;


use app\components\PdfEsign;
use app\components\PPIAffiliatePdfEsign;
use app\components\PPINonAffiliate;
use app\models\PPILead;
use Yii;

class PPIPdfFactory {
    /**
     * @param $args
     * @return PdfEsign
     */
    public function create($args){
        /**
         * @var $model PPILead
         */
        $model = $args['model'];
        $fileDestination = \Yii::getAlias("@app/data").'/'.sprintf("%s_%s_%s.pdf",$model->firstname,$model->lastname,$model->security_key);
        $pdfTemplte = Yii::getAlias("@app/documentation/pdf_template/".$model->pdf_template.".pdf");
        $pdfEsign = null;
        if ($model->pdf_template === 'PPI Form') {
            $pdfEsign = new PPINonAffiliate();
        } else if($model->pdf_template === 'PPI Affiliate Form') {
            $pdfEsign = new PPIAffiliatePdfEsign();
        }
        $pdfEsign->setTemplate($pdfTemplte);
        $pdfEsign->setLeadObject($model);
        $pdfEsign->setDestinationFile($fileDestination);
        $pdfEsign->export();
        return $pdfEsign;
    }
} 