<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estudiantes".
 *
 * @property int $id
 * @property string $nombre
 * @property string $apellido
 * @property string|null $fecha_nacimiento
 * @property string|null $email
 */
class Estudiantes extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'estudiantes';
    }


    public function getNotas()
    {
        return $this->hasMany(Notas::class, ['estudiante_id' => 'id'])->with('materia');
        return $this->hasMany(\app\models\Notas::class, ['estudiante_id' => 'id'])->with('materia');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fecha_nacimiento', 'email'], 'default', 'value' => null],
            [['nombre', 'apellido'], 'required'],
            [['fecha_nacimiento'], 'safe'],
            [['nombre', 'apellido', 'email'], 'string', 'max' => 100],
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
            'apellido' => 'Apellido',
            'fecha_nacimiento' => 'Fecha Nacimiento',
            'email' => 'Email',
        ];
    }

}

