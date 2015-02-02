<?php

use yii\db\Schema;
use yii\db\Migration;

class m150131_172023_employee_skills_missing_cols extends Migration
{
    public function safeUp()
    {
        try {
            $this->addColumn('{{%employee_skill}}', "years_of_experience", Schema::TYPE_DECIMAL.'(5,2)');
            $this->addColumn('{{%employee_skill}}', "last_activity", Schema::TYPE_SMALLINT);
        } catch (Exception $exc) {
            return FALSE;
        }
        
        return TRUE;
    }

    public function safeDown()
    {
        $this->dropColumn('{{%employee_skill}}', 'last_activity');
        $this->dropColumn('{{%employee_skill}}', 'years_of_experience');
    }
}
