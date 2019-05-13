<?php

/**
 * Created by PhpStorm.
 * User: Yuchen Yao
 * Date: 11/04/2019
 * Time: 7:44 PM
 */

use app\assets\PaypalCallback;
use yii\helpers\Html;

/* @var $this \yii\web\View */
\app\assets\AppAsset::register($this);
PaypalCallback::register($this);
?>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
</head>
<body onload="pendingTime()">

<span id="count"></span>
<div id="paypal-button-container"></div> <h1>To Confirm</h1>
</body>