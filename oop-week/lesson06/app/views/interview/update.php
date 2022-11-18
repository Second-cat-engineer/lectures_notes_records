<?php

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Interview */
/* @var $editForm app\forms\InterviewEditForm */

$this->title = 'Update Interview: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Interviews', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="interview-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="interview-form">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($editForm, 'firstName')->textInput(['maxlength' => true]) ?>

        <?= $form->field($editForm, 'lastName')->textInput(['maxlength' => true]) ?>

        <?= $form->field($editForm, 'email')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('Update', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

</div>
