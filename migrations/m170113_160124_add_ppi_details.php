<?php

use yii\db\Migration;

class m170113_160124_add_ppi_details extends Migration
{

    public function safeUp()
    {
        $this->addColumn('{{%ppi_lead}}', 'is_joint', $this->boolean());
        $this->addColumn('{{%ppi_lead}}', 'finance_status', $this->text());//Arrears, Debt Management or IVA
    }

    public function safeDown()
    {
        $this->dropColumn('{{%ppi_lead}}','is_joint');
        $this->dropColumn('{{%ppi_lead}}','finance_status');
    }
}
