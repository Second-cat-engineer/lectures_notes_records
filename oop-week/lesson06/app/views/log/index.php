<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\forms\search\LogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Logs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'id',
            'created_at:datetime',
            'user_id',
            'message:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
