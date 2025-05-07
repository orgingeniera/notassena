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
            [['nota'], 'number'],
            [['fecha'], 'safe'],
            [['comentarios'], 'string'],
            [['estudiante_id'], 'exist', 'skipOnError' => true, 'targetClass' => Estudiantes::class, 'targetAttribute' => ['estudiante_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'estudiante_id' => 'Estudiante ID',
            'materia_id' => 'Materia ID',
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
