<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 10/11/16
 * Time: 11:46 PM
 */

namespace app\models;


use yii\base\Model;
use Yii;
use yii\helpers\VarDumper;

class NewLeadForm extends Model
{
    public $salutation;
    public $firstname;
    public $lastname;
    public $middlename;
    public $account_provider;
    public $monthly_account_charge;
    public $client_signature;

    public function rules()
    {
        return [
            [['salutation', 'firstname', 'lastname','client_signature'], 'required'],
            ['monthly_account_charge', 'double'],
            ['client_signature', 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'salutation' => "Title",
            'firstname' => "Firstname",
            'lastname' => "Lastname",
            'middlename' => "Middlename",
            'account_provider' => "Account Provider",
            'monthly_account_charge' => "Monthly Account Charge",
        ];
    }
    public function prepareData()
    {
        /*output the image content to an outputfile*/
        $outputfile = Yii::getAlias('@app/signatures/')
                .DIRECTORY_SEPARATOR
                .sprintf("%s_%s_%s", $this->firstname,$this->middlename,$this->lastname)
                .uniqid()
                .'.png';
        Yii::warning($outputfile . ' - debug');
        touch($outputfile);
        file_put_contents($outputfile, base64_decode($this->client_signature));
        /*set to client_signature_output_image */
        return $outputfile;
    }

} 