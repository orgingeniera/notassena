<?php

namespace app\controllers;

use app\models\Notas;
use app\models\NotasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;   
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


use app\models\Estudiantes;
use app\models\Materias;
use yii\helpers\ArrayHelper; // Asegúrate de incluir ArrayHelper

/**
 * NotasController implements the CRUD actions for Notas model.
 */
class NotasController extends Controller
{

    public function actionExportarExcel()
    {
        $notas = \app\models\Notas::find()->with(['estudiante', 'materia'])->all();
    
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
    
        // Encabezados
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Estudiante');
        $sheet->setCellValue('C1', 'Materia');
        $sheet->setCellValue('D1', 'Nota');
        $sheet->setCellValue('E1', 'Fecha');
    
        // Datos
        $fila = 2;
        foreach ($notas as $nota) {
            $sheet->setCellValue('A' . $fila, $nota->id);
            $sheet->setCellValue('B' . $fila, $nota->estudiante->nombre ?? 'N/A');
            $sheet->setCellValue('C' . $fila, $nota->materia->nombre ?? 'N/A');
            $sheet->setCellValue('D' . $fila, $nota->nota);
            $sheet->setCellValue('E' . $fila, $nota->fecha);
            $fila++;
        }
    
        // Descargar el archivo
        $nombreArchivo = 'notas_' . date('Ymd_His') . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=\"$nombreArchivo\"");
        header('Cache-Control: max-age=0');
    
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                        'export-pdf' => ['POST'], // Agregamos la acción para exportar a PDF
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Notas models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new NotasSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionExportPdf()
    {
        $searchModel = new NotasSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $content = $this->renderPartial('_reporte_notas', [
            'dataProvider' => $dataProvider,
        ]);

        $pdf = new Pdf([
            'mode' => Pdf::MODE_CORE, // 'UTF-8'
            'format' => Pdf::FORMAT_A4,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_DOWNLOAD,
            'content' => $content,
            'cssFile' => '@webroot/css/pdf.css', // Opcional: archivo CSS para el PDF
            'options' => ['title' => 'Reporte de Notas'],
            'methods' => [
                'SetHeader' => ['Reporte de Notas'],
                'SetFooter' => ['|Página {PAGENO}|'],
            ]
        ]);

        return $pdf->render();
    }

    /**
     * Displays a single Notas model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Notas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new \app\models\Notas();

        // Obtener la lista de estudiantes y materias
        $estudiantes = ArrayHelper::map(Estudiantes::find()->all(), 'id', 'nombre');
        $materias = ArrayHelper::map(Materias::find()->all(), 'id', 'nombre');

        // Verificar si el formulario fue enviado y procesar los datos
        if ($model->load($this->request->post()) && $model->save()) {
            // Si el modelo se guarda correctamente, redirigir al view
            return $this->redirect(['view', 'id' => $model->id]);
        }

        // Si no se guardó, mostrar el formulario
        return $this->render('create', [
            'model' => $model,
            'estudiantes' => $estudiantes,
            'materias' => $materias,
        ]);
    }

    /**
     * Updates an existing Notas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Notas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Notas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Notas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Notas::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}


