<?php

namespace app\controllers;

use app\forms\InterviewEditForm;
use app\forms\InterviewJoinForm;
use app\forms\InterviewMoveForm;
use app\forms\InterviewRejectForm;
use app\services\InterviewService;
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
    private InterviewService $interviewService;

    public function __construct($id, $module, InterviewService $interviewService, $config = [])
    {
        $this->interviewService = $interviewService;
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
        $searchModel = new InterviewSearch();
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

    public function actionJoin()
    {
        $form = new InterviewJoinForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $model = $this->interviewService->joinToInterview(
                    $form->lastName,
                    $form->firstName,
                    $form->email,
                    $form->date
                );

                return $this->redirect(['view', 'id' => $model->id]);
            } catch (\DomainException $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('join', [
            'joinForm' => $form,
        ]);
    }

    public function actionUpdate(int $id)
    {
        $interview = $this->findModel($id);
        $form = new InterviewEditForm($interview);

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {

            $this->interviewService->editInterview(
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

    public function actionMove($id)
    {
        $interview = $this->findModel($id);
        $form = new InterviewMoveForm($interview);

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {

            $this->interviewService->moveInterview($interview->id, $form->date);

            return $this->redirect(['view', 'id' => $interview->id]);
        }

        return $this->render('move', [
            'moveForm' => $form,
            'model' => $interview,
        ]);
    }

    public function actionReject($id)
    {
        $interview = $this->findModel($id);
        $form = new InterviewRejectForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {

            $this->interviewService->rejectInterview($interview->id, $form->reason);

            return $this->redirect(['view', 'id' => $interview->id]);
        }

        return $this->render('reject', [
            'rejectForm' => $form,
            'model' => $interview,
        ]);
    }

    public function actionDelete(int $id)
    {
        $interview = $this->findModel($id);
        $this->interviewService->deleteInterview($interview->id);

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
