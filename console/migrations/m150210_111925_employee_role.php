<?php

use yii\db\Schema;
use yii\db\Migration;

class m150210_111925_employee_role extends Migration
{

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_polish_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%employee_role}}',
            [
            'id' => Schema::TYPE_PK,
            'role' => Schema::TYPE_INTEGER.' NOT NULL',
            'employee_id' => Schema::TYPE_INTEGER.' NOT NULL',
            'created_at' => Schema::TYPE_INTEGER.' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER.' NOT NULL',
            ], $tableOptions);
        $this->createIndex('I_employee_role', '{{%employee_role}}', ['role']);
        $this->addForeignKey('F_role2employee', '{{%employee_role}}', 'employee_id',
            '{{%employee}}', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function down()
    {
        echo "m150210_111925_user_role cannot be reverted.\n";
        $this->dropTable('{{%employee_role}}');
    }
}