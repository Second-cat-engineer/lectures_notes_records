<?php

namespace app\controllers;

use app\forms\InterviewEditForm;
use app\forms\InterviewJoinForm;
use app\forms\InterviewRejectForm;
use app\services\StaffService;
use Yii;
use app\models\Interview;
use app\forms\search\InterviewSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * InterviewController implements the CRUD actions for Interview model.
 */
class InterviewController extends Controller
{
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

    /**
     * Lists all Interview models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InterviewSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Interview model.
     * @param integer $id
     * @return mixed
     */
    public function actionView(int $id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Interview model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionJoin()
    {
        $form = new InterviewJoinForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $service = new StaffService();

            $model = $service->joinToInterview(
                $form->lastName,
                $form->firstName,
                $form->email,
                $form->date
            );

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('join', [
            'joinForm' => $form,
        ]);
    }

    /**
     * Updates an existing Interview model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate(int $id)
    {
        $interview = $this->findModel($id);
        $form = new InterviewEditForm($interview);

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {

            $service = new StaffService();
            $service->editInterview(
                $interview->id,
                $form->lastName,
                $form->firstName,
                $form->email
            );

            return $this->redirect(['view', 'id' => $interview->id]);
        }

        return $this->render('update', [
            'editForm' => $form,
            'model' => $interview,
        ]);
    }

    public function actionReject($id)
    {
        $interview = $this->findModel($id);
        $form = new InterviewRejectForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $service = new StaffService();
            $service->rejectInterview($interview->id, $form->reason);

            return $this->redirect(['view', 'id' => $interview->id]);
        }

        return $this->render('reject', [
            'rejectForm' => $form,
            'model' => $interview,
        ]);
    }

    /**
     * Deletes an existing Interview model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete(int $id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Interview model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Interview the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(int $id): Interview
    {
        if (($model = Interview::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
