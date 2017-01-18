<?php

use yii\db\Migration;

class m170113_151305_add_finance_info_details extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%ppi_lead}}', 'finance_start', $this->date());
        $this->addColumn('{{%ppi_lead}}', 'finance_end', $this->date());
    }

    public function safeDown()
    {
        $this->dropColumn('{{%ppi_lead}}','finance_start');
        $this->dropColumn('{{%ppi_lead}}','finance_end');
    }
}
