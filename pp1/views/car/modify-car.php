<?php

/**
 * Created by PhpStorm.
 * User: Yuchen Yao
 * Date: 25/05/2019
 * Time: 3:29 PM
 */

/* @var $this \yii\web\View */
/* @var $searchModel app\models\CarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Admin function';
$this->params['breadcrumbs'][] = $this->title;

use yii\helpers\Html;
use yii\grid\GridView;?>
<div class="car-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'carName',
            'carImgUrl:image',
            'numOfPassenger',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
