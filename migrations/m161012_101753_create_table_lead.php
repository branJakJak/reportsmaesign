<?php

use yii\db\Migration;

class m161012_101753_create_table_lead extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        
        }
        $this->createTable('{{%lead_esign}}', [
            'id' => $this->primaryKey(),
            'salutation' => $this->string()->notNull(),
            'firstname' => $this->string()->notNull(),
            'middlename' => $this->string(),
            'lastname' => $this->string()->notNull(),
            'account_provider' => $this->string(),
            'monthly_account_charge' => $this->float()->notNull(),
            'client_signature_image' => $this->string()->notNull(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime()
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%lead_esign}}');
    }
}
