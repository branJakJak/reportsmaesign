<?php

use yii\db\Migration;

class m170117_113132_add_final_tick_checkbox_col extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%ppi_lead}}', 'final_tick_checklist', $this->string());
    }

    public function safeDown()
    {
       $this->dropColumn('{{%ppi_lead}}','final_tick_checklist');        
    }
}
