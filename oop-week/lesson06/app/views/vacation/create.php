<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Vacation */

$this->title = 'Create Vacation';
$this->params['breadcrumbs'][] = ['label' => 'Vacations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vacation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
