<?php

use yii\db\Migration;

class m161014_095449_add_new_column_select_hotkey extends Migration
{
    public function up()
    {
        $this->addColumn("lead_esign", "hotkey", "string");
    }

    public function down()
    {
        $this->dropColumn("lead_esign", "hotkey");
    }
}
