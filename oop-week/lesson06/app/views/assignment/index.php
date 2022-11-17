<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\forms\search\AssignmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Assignments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assignment-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Assignment', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'order_id',
            'employee_id',
            'position_id',
            'date',
            'rate',
            'salary',
            'active',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
