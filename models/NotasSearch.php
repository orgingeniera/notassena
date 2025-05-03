<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Notas;

/**
 * NotasSearch represents the model behind the search form of `app\models\Notas`.
 */
class NotasSearch extends Notas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'estudiante_id', 'materia_id'], 'integer'],
            [['nota'], 'number'],
            [['fecha'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */
    public function search($params, $formName = null)
    {
        $query = Notas::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'estudiante_id' => $this->estudiante_id,
            'materia_id' => $this->materia_id,
            'nota' => $this->nota,
            'fecha' => $this->fecha,
        ]);

        return $dataProvider;
    }
}
