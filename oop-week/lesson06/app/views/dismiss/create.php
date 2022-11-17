<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Dismiss */

$this->title = 'Create Dismiss';
$this->params['breadcrumbs'][] = ['label' => 'Dismisses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dismiss-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
