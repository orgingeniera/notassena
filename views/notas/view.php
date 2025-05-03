<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Notas $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Notas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="notas-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
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
    ]) ?>

</div>
