<?php

/**
 * Created by PhpStorm.
 * User: Yuchen Yao
 * Date: 4/04/2019
 * Time: 4:36 PM
 */

/* @var $this \yii\web\View */

use app\assets\AppAsset;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Booking car';

?>
<head>
    <title><?= HTML::encode($this->title) ?></title>

</head>
<body>

<span id="count"></span>

<?= HTML::Button('Booking', ['class' => 'btn btn-primary','id'=>'startClocking','name'=>'booking1']) ?>&emsp14;

<?=Html::a('Confirm',['car/confirm-status'],['class' =>'btn btn-success'])?>
</body>