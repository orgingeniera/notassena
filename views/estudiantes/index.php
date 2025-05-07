<?php

use app\models\Estudiantes;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\EstudiantesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Estudiantes';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="estudiantes-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Estudiantes', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'nombre',
            'apellido',
            'fecha_nacimiento',
            'email:email',

            [
                'header' => 'Acciones',
                'format' => 'raw',
                'value' => function ($model) {
                    $viewUrl = Url::to(['view', 'id' => $model->id]);
                    $updateUrl = Url::to(['update', 'id' => $model->id]);
                    $deleteUrl = Url::to(['delete', 'id' => $model->id]);
                    $reporteUrl = Url::to(['reporte/estudiante', 'id' => $model->id]); // Detalle del estudiante
                    $verReporteUrl = Url::to(['reporte/ver-reporte', 'id' => $model->id]); // Reporte general

                    return '
                        <select class="form-select form-select-sm accion-select" data-id="' . $model->id . '">
                            <option selected disabled>Seleccionar</option>
                            <option value="' . $viewUrl . '">🔍 Ver</option>
                            <option value="' . $updateUrl . '">✏️ Editar</option>
                            <option value="' . $deleteUrl . '" data-delete="true">🗑️ Eliminar</option>
                            <option value="' . $reporteUrl . '">📄 Reporte</option>
                        
                        </select>
                    ';
                },
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
        if (confirm('¿Estás seguro de que deseas eliminar este estudiante?')) {
            $.post(url, {_csrf: yii.getCsrfToken()})
                .done(function() {
                    location.reload();
                })
                .fail(function() {
                    alert('Error al eliminar el estudiante.');
                });
        }
    } else {
        window.location.href = url;
    }
});
JS;
$this->registerJs($script);
?>
