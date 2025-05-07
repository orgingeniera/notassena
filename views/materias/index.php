<?php

use app\models\Materias;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\MateriasSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Materias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="materias-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Materias', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nombre',
            'descripcion:ntext',
            [
                'header' => 'Acciones',
                'format' => 'raw',
                'value' => function ($model) {
                    $viewUrl = Url::to(['view', 'id' => $model->id]);
                    $updateUrl = Url::to(['update', 'id' => $model->id]);
                    $deleteUrl = Url::to(['delete', 'id' => $model->id]);
                    
                    
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
