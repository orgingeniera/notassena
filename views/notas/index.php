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
    <?= Html::beginForm(['export-pdf'], 'post') ?>
        <?= Html::submitButton('Exportar a PDF', ['class' => 'btn btn-danger']) ?>
    <?= Html::endForm() ?>
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
        [
            'class' => ActionColumn::className(),
            'urlCreator' => function ($action, Notas $model, $key, $index, $column) {
                return Url::toRoute([$action, 'id' => $model->id]);
            }
        ],
    ],
]); ?>

</div>
