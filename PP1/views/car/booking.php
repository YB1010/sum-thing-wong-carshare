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
//import js file
AppAsset::addScript($this, Yii::$app->request->baseUrl . 'web/js/jquery-3.3.1.min.js');
?>
<head>
    <title><?= HTML::encode($this->title) ?></title>
</head>
<body>

<span id="count"></span>
<?= HTML::Button('Booking', ['class' => 'btn btn-primary','id'=>'startClocking','name'=>'booking1']) ?>&emsp14;
<?= HTML::Button('Confirm', ['class' => 'btn btn-primary','id'=>'stopPending','name'=>'confirm1']) ?>
</body>