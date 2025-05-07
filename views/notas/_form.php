<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Notas $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="notas-form">
<?php if ($model->hasErrors()): ?>
    <div class="alert alert-danger">
        <strong>¡Atención!</strong> Corrige los siguientes errores:
        <ul>
            <?php foreach ($model->getErrors() as $errors): ?>
                <?php foreach ($errors as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'estudiante_id')->dropDownList(
        \yii\helpers\ArrayHelper::map(
            \app\models\Estudiantes::find()->all(),
            'id',
            function ($model) {
                return $model->nombre . ' ' . $model->apellido;
            }
        ),
        ['prompt' => 'Seleccione un estudiante']
    ) ?>

<?= $form->field($model, 'materia_id')->dropDownList(
    \yii\helpers\ArrayHelper::map(
        \app\models\Materias::find()->all(),
        'id',
        'nombre'
    ),
    ['prompt' => 'Seleccione una materia']
) ?>

    <?= $form->field($model, 'nota')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha')->input('date')     ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
