<?php

use yii\db\Migration;

class m170113_160045_add_prev_name extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%ppi_lead}}', 'prev_salutation', $this->text());
        $this->addColumn('{{%ppi_lead}}', 'prev_firstname', $this->text());
        $this->addColumn('{{%ppi_lead}}', 'prev_lastname', $this->text());
    }

    public function safeDown()
    {
        $this->dropColumn('{{%ppi_lead}}','prev_salutation');
        $this->dropColumn('{{%ppi_lead}}','prev_firstname');
        $this->dropColumn('{{%ppi_lead}}','prev_lastname');
    }

}
