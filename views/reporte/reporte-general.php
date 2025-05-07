<?php
use yii\grid\GridView;
use yii\helpers\Html;

/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Reporte General de Notas';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-header bg-info text-white text-center">
                    <h3><?= Html::encode($this->title) ?></h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'tableOptions' => ['class' => 'table table-hover table-striped table-bordered'],
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                [
                                    'attribute' => 'estudiante_id',
                                    'label' => 'Estudiante',
                                    'value' => function ($model) {
                                        return $model->estudiante->nombre . ' ' . $model->estudiante->apellido;
                                    },
                                ],
                                [
                                    'attribute' => 'materia_id',
                                    'label' => 'Materia',
                                    'value' => function ($model) {
                                        return $model->materia->nombre ?? 'Sin nombre';
                                    },
                                ],
                                'nota',
                                'fecha',
                             
                            ],
                        ]); ?>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
</div>
