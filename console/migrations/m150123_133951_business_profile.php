<?php

use yii\db\Schema;
use yii\db\Migration;

class m150123_133951_business_profile extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_polish_ci ENGINE=InnoDB';
        }
        
        try {
            $this->createTable('{{%business_profile}}', [
                'id' => Schema::TYPE_PK,
                'name' => Schema::TYPE_STRING.'(45) NOT NULL'
                ], $tableOptions
            );
            $this->createIndex('I_business_profile', '{{%business_profile}}', 'name', true);
            
            $this->createTable('{{%employee_business_profile}}', [
                'id' => Schema::TYPE_PK,
                'business_profile_id' => Schema::TYPE_INTEGER.' NOT NULL',
                'employee_id' => Schema::TYPE_INTEGER.' NOT NULL',
                'profile_order' => Schema::TYPE_STRING.'(1) NOT NULL'
            ], $tableOptions);
            
            $this->addForeignKey('F_employee_busines_profile2profile', '{{%employee_business_profile}}', 
                    'business_profile_id', '{{%business_profile}}', 'id', 'RESTRICT', 'RESTRICT');

            $this->addForeignKey('F_employee_busines_profile2employee', '{{%employee_business_profile}}', 
                    'employee_id', '{{%employee}}', 'id', 'RESTRICT', 'RESTRICT');
            
        } catch (Exception $exc) {
            return FALSE;
        }
        
        return TRUE;
    }

    public function safeDown()
    {
        $this->dropTable('{{%employee_business_profile}}');
        $this->dropTable('{{%business_profile}}');
        //echo "m150123_133951_business_profile cannot be reverted.\n";
        //return false;
    }
}
