<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "materias".
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 *
 * @property Notas[] $notas
 */
class Materias extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'materias';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion'], 'default', 'value' => null],
            [['nombre'], 'required'],
            [['descripcion'], 'string'],
            [['nombre'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
        ];
    }

    /**
     * Gets query for [[Notas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotas()
    {
        return $this->hasMany(Notas::class, ['materia_id' => 'id']);
    }

}
