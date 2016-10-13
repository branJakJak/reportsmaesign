<?php

use yii\db\Migration;

/**
 * Handles the creation for table `user`.
 */
class m161012_150212_create_user_table extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%account_user}}', [
            'id' => $this->primaryKey(),
            "username" =>  $this->string()->notNull(),
            "password" =>  $this->string()->notNull(),
            "authKey" =>  $this->string()->notNull(),
            "accessToken" =>  $this->string()->notNull(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ], $tableOptions);
    }
    public function safeDown()
    {
        $this->dropTable('{{%account_user}}');
    }
}
