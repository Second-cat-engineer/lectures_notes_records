<?php

use app\helpers\InterviewHelper;
use app\models\Interview;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Interview */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Interviews', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="interview-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Edit', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php if ($model->isNew()): ?>
            <?= Html::a('Move', ['interview/move', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if (!$model->isPassed()): ?>
            <?= Html::a('Recruit', ['employee/create-by-interview', 'interview_id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?php endif; ?>
        <?php if ($model->isNew()): ?>
            <?= Html::a('Reject', ['reject', 'id' => $model->id], ['class' => 'btn btn-danger']) ?>
        <?php endif; ?>
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
            'date',
            'first_name',
            'last_name',
            'email:email',
            [
                'attribute' => 'status',
                'value' => InterviewHelper::getStatusName($model->status),
            ],
            'reject_reason:ntext',
            'employee_id',
        ],
    ]) ?>

</div>
