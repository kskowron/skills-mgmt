<?php

use yii\db\Schema;
use yii\db\Migration;

class m150213_103236_business_profile_description extends Migration
{
    public function safeUp()
    {
        try {
            $this->addColumn('{{%business_profile}}', 'description', Schema::TYPE_TEXT);
        } catch (Exception $exc) {
            return FALSE;
        }

        return TRUE;
    }

    public function safeDown()
    {
        $this->dropColumn('{{%business_profile}}', 'description');
    }
}
