<?php

use yii\db\Schema;
use yii\db\Migration;

class m150119_182513_skills_tables extends Migration
{

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_polish_ci ENGINE=InnoDB';
        }

        try {
            //Locations
            $this->createTable('{{%location}}',
                [
                'id' => Schema::TYPE_PK,
                'name' => Schema::TYPE_STRING.'(45) NOT NULL',
                ], $tableOptions);
            $this->createIndex('I_location_name', '{{%location}}', ['name'],
                true);

            //Employees
            $this->createTable('{{%employee}}',
                [
                'id' => Schema::TYPE_PK,
                'user_id' => Schema::TYPE_INTEGER.' NULL DEFAULT NULL',
                'location_id' => Schema::TYPE_INTEGER.' NOT NULL',
                'firstName' => Schema::TYPE_STRING.'(60) NOT NULL',
                'lastName' => Schema::TYPE_STRING.'(60) NOT NULL',
                'created_at' => Schema::TYPE_INTEGER.' NOT NULL',
                'updated_at' => Schema::TYPE_INTEGER.' NOT NULL',
                ], $tableOptions);
            $this->addForeignKey('F_employee2user', '{{%employee}}',
                'user_id', '{{%user}}', 'id', 'RESTRICT', 'RESTRICT');
            $this->addForeignKey('F_employee2location', '{{%employee}}',
                'location_id', '{{%location}}', 'id', 'RESTRICT', 'RESTRICT');
            $this->createIndex('I_eployees_name', '{{%employee}}',
                ['lastName', 'firstName'], false);


            //category
            $this->createTable('{{%category}}',
                [
                'id' => Schema::TYPE_PK,
                'name' => Schema::TYPE_STRING.'(45) NOT NULL',
                ], $tableOptions);
            $this->createIndex('I_category_name', '{{%category}}', ['name'],
                true);

            //category
            $this->createTable('{{%skill}}',
                [
                'id' => Schema::TYPE_PK,
                'name' => Schema::TYPE_STRING.'(45) NOT NULL',
                'category_id' => Schema::TYPE_INTEGER.' NOT NULL',
                ], $tableOptions);
            $this->createIndex('I_skill_name', '{{%skill}}', ['name'],
                true);
            $this->addForeignKey('F_skill2category', '{{%skill}}',
                'category_id', '{{%category}}', 'id', 'RESTRICT', 'RESTRICT');

            //Skill Level
            $this->createTable('{{%skill_level}}',
                [
                'id' => Schema::TYPE_PK,
                'name' => Schema::TYPE_STRING.'(45) NOT NULL',
                ], $tableOptions);
            $this->createIndex('I_skill_level_name', '{{%skill_level}}', ['name'],
                true);

            //employee skill
            $this->createTable('{{%employee_skill}}',
                [
                'id' => Schema::TYPE_PK,
                'skill_id' => Schema::TYPE_INTEGER.' NOT NULL',
                'skill_level_id' => Schema::TYPE_INTEGER.' NOT NULL',
                'employee_id' => Schema::TYPE_INTEGER.' NOT NULL',
                ], $tableOptions);
            $this->addForeignKey('F_employee_skill2skill', '{{%employee_skill}}',
                'skill_id', '{{%skill}}', 'id', 'RESTRICT', 'RESTRICT');

            $this->addForeignKey('F_employee_skill2skill_level', '{{%employee_skill}}',
                'skill_level_id', '{{%skill_level}}', 'id', 'RESTRICT', 'RESTRICT');

            $this->addForeignKey('F_employee_skill2employee', '{{%employee_skill}}',
                'employee_id', '{{%employee}}', 'id', 'RESTRICT', 'RESTRICT');
            
        } catch (Exception $exc) {
            return FALSE;
        }

        return TRUE;
    }

    public function safeDown()
    {
        $this->dropTable('{{%employee_skill}}');
        $this->dropTable('{{%employee}}');
        $this->dropTable('{{%skill}}');
        $this->dropTable('{{%skill_level}}');
        $this->dropTable('{{%category}}');
        $this->dropTable('{{%location}}');
//        echo "m150119_182513_skills_tables cannot be reverted.\n";
//        return false;
    }
}