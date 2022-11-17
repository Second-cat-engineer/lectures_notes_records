<?php

use app\models\Employee;
use app\models\Interview;
use yii\helpers\ArrayHelper;
use app\helpers\InterviewHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Interview */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="interview-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?php if ($model->getScenario() == Interview::SCENARIO_DEFAULT): ?>

        <?= $form->field($model, 'status')->dropDownList($model->getNextStatusList()) ?>

        <?= $form
            ->field($model, 'employee_id')
            ->dropDownList(ArrayHelper::map(Employee::find()->all(), 'id', 'fullName'))
        ?>

        <?= $form->field($model, 'reject_reason')->textarea(['rows' => 5]) ?>

    <?php endif; ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
