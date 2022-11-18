<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $joinForm app\forms\InterviewJoinForm */

$this->title = 'Join to Interview';
$this->params['breadcrumbs'][] = ['label' => 'Interviews', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="interview-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="interview-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($joinForm, 'date')->textInput() ?>

        <?= $form->field($joinForm, 'firstName')->textInput(['maxlength' => true]) ?>

        <?= $form->field($joinForm, 'lastName')->textInput(['maxlength' => true]) ?>

        <?= $form->field($joinForm, 'email')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('Join', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>


</div>