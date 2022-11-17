<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Dismiss */

$this->title = 'Update Dismiss: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Dismisses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dismiss-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
