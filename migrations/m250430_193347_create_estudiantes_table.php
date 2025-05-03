<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%estudiantes}}`.
 */
class m250430_193347_create_estudiantes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%estudiantes}}', [
            'id' => $this->primaryKey(),
            'nombre' => $this->string(100)->notNull(),
            'apellido' => $this->string(100)->notNull(),
            'fecha_nacimiento' => $this->date(),
            'email' => $this->string(100),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%estudiantes}}');
    }
}
