<?php

use yii\db\Migration;

class m170116_094349_complaining_with_you_details extends Migration
{
    public function safeUp()
    {
       $this->addColumn('{{%ppi_lead}}', 'partner_detail_title', $this->text());
       $this->addColumn('{{%ppi_lead}}', 'partner_detail_firstname', $this->text());
       $this->addColumn('{{%ppi_lead}}', 'partner_detail_lastname', $this->text());
       $this->addColumn('{{%ppi_lead}}', 'partner_detail_date_of_birth', $this->date());
    }

    public function safeDown()
    {
        $this->dropColumn('{{%ppi_lead}}','partner_detail_title');
        $this->dropColumn('{{%ppi_lead}}','partner_detail_firstname');
        $this->dropColumn('{{%ppi_lead}}','partner_detail_lastname');
        $this->dropColumn('{{%ppi_lead}}','partner_detail_date_of_birth');
    }
}
