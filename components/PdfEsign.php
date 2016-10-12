<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 10/11/16
 * Time: 11:55 PM
 */

namespace app\components;


use yii\base\Component;

class PdfEsign extends Component{
	public $leadData;
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
    	/*create pdf file here with */
    	$pdfOutput = "";
    	
    	return $pdfOutput;
    }
} 