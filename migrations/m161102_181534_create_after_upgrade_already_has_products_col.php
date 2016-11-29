<?php

use yii\db\Migration;

class m161102_181534_create_after_upgrade_already_has_products_col extends Migration
{
    public function up()
    {
        $this->addColumn('{{%lead_esign}}', 'after_upgrade_already_has_products', $this->text());
    }

    public function down()
    {
        $this->dropColumn('{{%lead_esign}}', 'after_upgrade_already_has_products');
    }

}
