<?php

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Interview */
/* @var $rejectForm app\forms\InterviewRejectForm */

$this->title = 'Reject Interview: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Interviews', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="interview-reject">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="interview-form">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($rejectForm, 'reason')->textarea(['rows' => 5]) ?>

        <div class="form-group">
            <?= Html::submitButton('Reject', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
