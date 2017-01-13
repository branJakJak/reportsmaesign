<?php

use yii\db\Migration;

class m170110_113101_add_addressinformation extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%ppi_lead}}', 'address1', $this->text());
        $this->addColumn('{{%ppi_lead}}', 'address2', $this->text());
        $this->addColumn('{{%ppi_lead}}', 'address3', $this->text());
        $this->addColumn('{{%ppi_lead}}', 'address4', $this->text());
        $this->addColumn('{{%ppi_lead}}', 'postcode', $this->text());
        $this->addColumn('{{%ppi_lead}}', 'date_of_birth', $this->date());
        $this->addColumn('{{%ppi_lead}}', 'account_provider', $this->text());
        $this->addColumn('{{%ppi_lead}}', 'monthly_account_charge', $this->double());
    }

    public function safeDown()
    {
        $this->dropColumn('{{%ppi_lead}}','address1');
        $this->dropColumn('{{%ppi_lead}}','address2');
        $this->dropColumn('{{%ppi_lead}}','address3');
        $this->dropColumn('{{%ppi_lead}}','address4');
        $this->dropColumn('{{%ppi_lead}}','postcode');
        $this->dropColumn('{{%ppi_lead}}','date_of_birth');
        $this->dropColumn('{{%ppi_lead}}','account_provider');
        $this->dropColumn('{{%ppi_lead}}','monthly_account_charge');
    }
}
