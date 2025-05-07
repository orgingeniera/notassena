<?php

use app\models\Notas;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\NotasSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Notas';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="notas-index">


    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Create Notas', ['create'], ['class' => 'btn btn-success']) ?>

        <?= Html::a('📊 Generar Reporte de Estudiantes', ['reporte/ver-reporte'], ['class' => 'btn btn-info']) ?>

        <?= Html::beginForm(['export-pdf'], 'post') ?>
            <?= Html::submitButton('Exportar a PDF', ['class' => 'btn btn-danger']) ?>
        <?= Html::endForm() ?>
    </p>
    <p>
        <?=Html::a('Exportar a Excel', ['notas/exportar-excel'], ['class' => 'btn btn-success']);?>
        <?= Html::a('Crear Notas', ['create'], ['class' => 'btn btn-primary']) ?>

    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'estudiante_id',
                'value' => function ($model) {
                    return $model->estudiante ? $model->estudiante->nombre : 'No asignado';
                },
                'label' => 'Estudiante',
            ],

            // Mostrar nombre de la materia
            [
                'attribute' => 'materia_id',
                'value' => function ($model) {
                    return $model->materia ? $model->materia->nombre : 'No asignado';
                },
                'label' => 'Materia',
            ],

            'nota',
            'fecha',
          

            [
                'header' => 'Acciones',
                'format' => 'raw',
                'value' => function ($model) {
                    $viewUrl = \yii\helpers\Url::to(['view', 'id' => $model->id]);
                    $updateUrl = \yii\helpers\Url::to(['update', 'id' => $model->id]);
                    $deleteUrl = \yii\helpers\Url::to(['delete', 'id' => $model->id]);
            
                    return '
                        <select class="form-select form-select-sm accion-select" data-id="' . $model->id . '">
                            <option selected disabled>Seleccionar</option>
                            <option value="' . $viewUrl . '">🔍 Ver</option>
                            <option value="' . $updateUrl . '">✏️ Editar</option>
                            <option value="' . $deleteUrl . '" data-delete="true">🗑️ Eliminar</option>
                        </select>
                    ';
                },
            ],


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
        [
            'class' => ActionColumn::className(),
            'urlCreator' => function ($action, Notas $model, $key, $index, $column) {
                return Url::toRoute([$action, 'id' => $model->id]);
            }
        ],
    ],
]); ?>

</div>

<?php
$script = <<<JS
$(document).on('change', '.accion-select', function() {
    var url = $(this).val();
    var isDelete = $(this).find('option:selected').data('delete');

    if (isDelete) {
        if (confirm('¿Estás seguro de que deseas eliminar esta nota?')) {
            $.post(url, {_csrf: yii.getCsrfToken()})
                .done(function() {
                    location.reload();
                })
                .fail(function() {
                    alert('Error al eliminar la nota.');
                });
        }
    } else {
        window.location.href = url;
    }
});
JS;
$this->registerJs($script);
?>

