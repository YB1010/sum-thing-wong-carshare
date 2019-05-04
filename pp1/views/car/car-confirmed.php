<?php

/**
 * Created by PhpStorm.
 * User: Yuchen Yao
 * Date: 11/04/2019
 * Time: 7:44 PM
 */

use yii\helpers\Html;

/* @var $this \yii\web\View */
\app\assets\AppAsset::register($this);
?>

<head>

    <body onload="pendingTime()">
        <span id="count"></span>
        <?= HTML::Button('Confirm', ['class' => 'btn btn-primary', 'id' => 'stopPending', 'name' => 'confirm1']) ?>
    </body>
</head>