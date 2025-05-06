<?php
use yii\helpers\Html;
?>

<h1>Promedio de Notas por Materia</h1>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Materia</th>
            <th>Promedio</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($promedios as $materia): ?>
            <tr>
                <td><?= Html::encode($materia['nombre']) ?></td>
                <td><?= number_format($materia['promedio'], 2) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>