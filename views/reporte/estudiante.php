<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Estudiantes $model */

$this->title = "Reporte de " . $model->nombre . " " . $model->apellido;
$this->params['breadcrumbs'][] = ['label' => 'Estudiantes', 'url' => ['index']];
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
                    <div class="mb-4">
                        <?= DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                'id',
                                'nombre',
                                'apellido',
                                'fecha_nacimiento',
                                'email:email',
                            ],
                            'options' => ['class' => 'table table-hover table-bordered'],
                        ]) ?>
                    </div>

                    <h2 class="text-center text-dark">Notas del estudiante</h2>

                    <?php if ($model->notas): ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead class="table-secondary">
                                    <tr>
                                        <th>📘 Materia</th>
                                        <th>📝 Nota</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($model->notas as $nota): ?>
                                        <tr>
                                            <td><?= Html::encode($nota->materia->nombre) ?></td>
                                            <td><?= Html::encode($nota->nota) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-warning text-center">Este estudiante no tiene notas registradas.</div>
                    <?php endif; ?>
                </div>
                
            </div>
        </div>
    </div>
</div>
