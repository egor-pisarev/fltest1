<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Work;

/* @var $this yii\web\View */
/* @var $searchModel app\models\WorkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Works';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="work-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Work', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<p>
    Общий опыт работы: <?= floor(Work::getTotalTime() / (2592000*12)) ?> год <?= floor(Work::getTotalTime() / (2592000)) % 12 ?> мес., <?= (Work::getTotalTime() / 86400) % 30 ?> дней
</p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'title',
            'start_date',
            'end_date',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
