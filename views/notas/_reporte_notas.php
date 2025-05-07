<?php

use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */
?>

<h1>Reporte de Notas</h1>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute' => 'estudiante_id',
            'value' => function ($model) {
                return $model->estudiante ? $model->estudiante->nombre . ' ' . $model->estudiante->apellido : '—';
            },
            'label' => 'Estudiante',
        ],
        [
            'attribute' => 'materia_id',
            'value' => function ($model) {
                return $model->materia ? $model->materia->nombre : '—';
            },
            'label' => 'Materias',
        ],
        'nota',
        'fecha',
    ],
    'summary' => false, // Opcional: oculta el resumen del GridView
]); ?>