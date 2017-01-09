<?php

use yii\db\Migration;

class m170102_103438_add_pdf_template_column extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%lead_esign}}', 'pdf_template', $this->text());
    }

    public function safeDown()
    {
        $this->dropColumn('{{%lead_esign}}','pdf_template');
    }

}
