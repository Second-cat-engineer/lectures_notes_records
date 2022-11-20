<?php

namespace app\controllers;

use app\forms\EmployeeCreateForm;
use app\models\Interview;
use app\services\dto\RecruitData;
use app\services\EmployeeService;
use Yii;
use app\models\Employee;
use app\forms\search\EmployeeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EmployeeController implements the CRUD actions for Employee model.
 */
class EmployeeController extends Controller
{
    private EmployeeService $employeeService;

    public function __construct($id, $module, EmployeeService $employeeService, $config = [])
    {
        $this->employeeService = $employeeService;
        parent::__construct($id, $module, $config = []);
    }

    /**
     * @inheritdoc
     */
    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new EmployeeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView(int $id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $form = new EmployeeCreateForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $employee = $this->employeeService->createEmployee(
                new RecruitData($form->firstName, $form->lastName, $form->address, $form->email),
                $form->orderDate,
                $form->contractDate,
                $form->recruitDate
            );

            Yii::$app->session->setFlash('success', 'Employee is recruit.');
            return $this->redirect(['view', 'id' => $employee->id]);
        }
        return $this->render('create', [
            'createForm' => $form,
        ]);
    }

    public function actionCreateByInterview($interview_id)
    {
        $interview = $this->findInterviewModel($interview_id);

        $form = new EmployeeCreateForm($interview);

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $employee = $this->employeeService->createEmployeeByInterview(
                $interview->id,
                new RecruitData($form->firstName, $form->lastName, $form->address, $form->email),
                $form->orderDate,
                $form->contractDate,
                $form->recruitDate
            );

            Yii::$app->session->setFlash('success', 'Employee is recruit.');
            return $this->redirect(['view', 'id' => $employee->id]);
        }

        return $this->render('create', [
            'createForm' => $form,
        ]);
    }

    public function actionUpdate(int $id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete(int $id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Employee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Employee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(int $id): Employee
    {
        if (($model = Employee::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * @param integer $id
     * @return Interview the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findInterviewModel(int $id): Interview
    {
        if (($model = Interview::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
