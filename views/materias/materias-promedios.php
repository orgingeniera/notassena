<?php
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Materias[] $materias */

$this->title = 'Promedio de Notas por Materia';
$this->registerCss("
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap');

    /* Animación desde el fondo */
    @keyframes zoomIn {
        from {
            opacity: 0;
            transform: scale(0.8);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .animated-title {
        animation: zoomIn 0.8s ease-out;
        transform-origin: center;
        font-family: 'Montserrat', sans-serif;
        font-size: 2.5rem;
        text-align: center;
        color: #343a40;
        margin-bottom: 2rem;
    }

    .animated-table {
        animation: zoomIn 1s ease-out;
        transform-origin: top;
    }

    .custom-table thead {
        background: linear-gradient(135deg, #007bff, #6610f2);
        color: white;
        text-align: center;
    }

    .custom-table tbody tr:hover {
        background-color: #f1f1f1;
    }

    .custom-table {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
");
?>

<h1 class="animated-title"><?= Html::encode($this->title) ?></h1>

<div class="table-responsive animated-table">
    <table class="table table-bordered table-hover table-striped custom-table">
        <thead>
            <tr>
                <th>Materia</th>
                <th>Promedio de Notas</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($materias as $materia): ?>
                <tr>
                    <td><?= Html::encode($materia->nombre) ?></td>
                    <td><?= $materia->promedioNotas !== null ? number_format($materia->promedioNotas, 2) : 'N/A' ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
