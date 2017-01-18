<?php

use yii\db\Migration;

class m170116_190730_add_columns_section_D_employment extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%ppi_lead}}', 'employment_status_during_ppi_payment_you_hours_work', $this->double());
        $this->addColumn('{{%ppi_lead}}', 'employment_status_during_ppi_payment_partner_hours_work', $this->double());
    }

    public function safeDown()
    {
       $this->dropColumn('{{%ppi_lead}}','employment_status_during_ppi_payment_you_hours_work');
       $this->dropColumn('{{%ppi_lead}}','employment_status_during_ppi_payment_partner_hours_work');
    }
}
