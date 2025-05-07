<?php


namespace app\models;
use yii\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "notas".
 *
 * @property int $id
 * @property int $estudiante_id
 * @property int $materia_id
 * @property float $nota
 * @property string $fecha
 * @property string|null $comentarios
 *
 * @property Estudiantes $estudiante
 */
class Notas extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['comentarios'], 'default', 'value' => null],
            [['estudiante_id', 'materia_id', 'nota'], 'required'],
            [['estudiante_id', 'materia_id'], 'integer'],
    

            ['nota', 'number', 'min' => 0.00, 'max' => 5.00, 'tooSmall' => 'La nota mínima es 0.00.', 'tooBig' => 'La nota máxima es 5.00.'],
    
            [['fecha'], 'safe'],

            [['estudiante_id'], 'exist', 'skipOnError' => true, 'targetClass' => Estudiantes::class, 'targetAttribute' => ['estudiante_id' => 'id']],
            [['materia_id'], 'exist', 'skipOnError' => true, 'targetClass' => Materias::class, 'targetAttribute' => ['materia_id' => 'id']],
    
            [['estudiante_id', 'materia_id'], 'unique', 'targetAttribute' => ['estudiante_id', 'materia_id'], 'message' => 'Este estudiante ya tiene una nota registrada en esta materia.'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',

            'estudiante_id' => 'Estudiante',
            'materia_id' => 'Materia',

            'estudiante_id' => 'Estudiante ',
            'materia_id' => 'Materia ',

            'nota' => 'Nota',
            'fecha' => 'Fecha',
            
        ];
    }

    /**
     * Gets query for [[Estudiante]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEstudiante()
    {
        return $this->hasOne(Estudiantes::class, ['id' => 'estudiante_id']);
       
    }
    
    public function getMateria()
{
    return $this->hasOne(Materias::class, ['id' => 'materia_id']);
    return $this->hasOne(\app\models\Materias::class, ['id' => 'materia_id']);
    
}


}
