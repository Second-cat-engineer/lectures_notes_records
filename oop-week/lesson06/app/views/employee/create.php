<?php

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $createForm app\forms\EmployeeCreateForm */

$this->title = 'Create Employee';
$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="employee-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($createForm, 'orderDate')->textInput(['maxlength' => true]) ?>

        <?= $form->field($createForm, 'contractDate')->textInput(['maxlength' => true]) ?>

        <?= $form->field($createForm, 'recruitDate')->textInput(['maxlength' => true]) ?>

        <?= $form->field($createForm, 'firstName')->textInput(['maxlength' => true]) ?>

        <?= $form->field($createForm, 'lastName')->textInput(['maxlength' => true]) ?>

        <?= $form->field($createForm, 'address')->textInput(['maxlength' => true]) ?>

        <?= $form->field($createForm, 'email')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('Recruit', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
