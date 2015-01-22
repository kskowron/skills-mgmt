<?php

use yii\db\Schema;
use yii\db\Migration;

class m150122_224534_competences_table extends Migration
{
    public function safeUp() 
    {
        $tableOptions = null;
        
        if ($this->db->driverName == 'mysql')
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_polish_ci ENGINE=InnoDB';
        }
        
        try {
            
            $this->createTable('{{%competence}}', 
                    [
                        'id' => Schema::TYPE_PK,
                        'name' => Schema::TYPE_STRING.'(45) NOT NULL',
                        'created_at' => Schema::TYPE_INTEGER.' NOT NULL',
                        'updated_at' => Schema::TYPE_INTEGER.' NOT NULL',
                    ], $tableOptions);
            $this->createIndex('I_competence_name', '{{%competence}}', ['name'], TRUE);
            
            $this->addColumn('{{%employee}}', 'primary_competence_id', Schema::TYPE_INTEGER.' NOT NULL');
            $this->addColumn('{{%employee}}', 'secondary_competence_id', Schema::TYPE_INTEGER);
            
            $this->addForeignKey('F_employee2competence_prim', '{{%employee}}', 
                    'primary_competence_id', '{{%competence}}', 'id');
            $this->addForeignKey('F_employee2competence_sec', '{{%employee}}', 
                    'secondary_competence_id', '{{%competence}}', 'id');
            
        } catch (Exception $exc) {
            return FALSE;
        }
        
        return TRUE;
    }
    
    public function safeDown() {
        $this->dropColumn('{{%employee}}', 'primary_competence_id');
        $this->dropColumn('{{%employee}}', 'secondary_competence_id');
        $this->dropTable('{{%competence}}');
    }
}

