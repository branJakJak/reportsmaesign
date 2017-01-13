<?php

use yii\db\Migration;

class m170109_154308_add_ppi_new_cols extends Migration
{

    public function safeUp()
    {
        $this->addColumn('{{%ppi_lead}}', 'pdf_template', $this->text());
        $this->addColumn('{{%ppi_lead}}', 'security_key', $this->text());
    }

    public function safeDown()
    {
        $this->dropColumn('{{%ppi_lead}}','pdf_template');
        $this->dropColumn('{{%ppi_lead}}','security_key');
    }

}
