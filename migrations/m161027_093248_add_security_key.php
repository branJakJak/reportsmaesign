<?php

use yii\db\Migration;

class m161027_093248_add_security_key extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%lead_esign}}', 'security_key', $this->text());
    }

    public function safeDown()
    {
        $this->dropColumn('{{%lead_esign}}', 'security_key');
    }
}
