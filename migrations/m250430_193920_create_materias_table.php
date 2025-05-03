<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%materias}}`.
 */
class m250430_193920_create_materias_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%materias}}', [
            'id' => $this->primaryKey(),
            'nombre' => $this->string(100)->notNull(),
            'descripcion' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%materias}}');
    }
}
