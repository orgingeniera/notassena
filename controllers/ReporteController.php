<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\models\Estudiantes;
use app\models\Notas;
use yii\data\ActiveDataProvider;

class ReporteController extends Controller
{
    /**
     * Muestra un reporte del estudiante.
     * @param int $id ID del estudiante
     * @return string
     * @throws NotFoundHttpException si no se encuentra el estudiante
     */
    public function actionEstudiante($id)
    {
        $model = Estudiantes::findOne($id);

        if ($model === null) {
            throw new NotFoundHttpException("El estudiante con ID $id no existe.");
        }

        return $this->render('estudiante', [
            'model' => $model,
        ]);
    }

    public function actionVerReporte()
{
    $dataProvider = new ActiveDataProvider([
        'query' => Notas::find()->with('estudiante'), // Asumiendo relación con estudiante
        'pagination' => [
            'pageSize' => 20,
        ],
    ]);

    return $this->render('reporte-general', [
        'dataProvider' => $dataProvider,
    ]);
}

}

