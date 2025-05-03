<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%notas}}`.
 */
class m250430_193932_create_notas_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%notas}}', [
            'id' => $this->primaryKey(),
            'estudiante_id' => $this->integer()->notNull(),
            'materia_id' => $this->integer()->notNull(),
            'nota' => $this->decimal(5,2)->notNull(),
            'fecha' => $this->date()->notNull(),

        // Claves foráneasphp 
        'FOREIGN KEY ([[estudiante_id]]) REFERENCES estudiantes(id) ON DELETE CASCADE',
        'FOREIGN KEY ([[materia_id]]) REFERENCES materias(id) ON DELETE CASCADE',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%notas}}');
    }
}
