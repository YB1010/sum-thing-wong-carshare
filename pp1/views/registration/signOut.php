<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use app\models\LoginForm;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\web\View;

$this->title = 'Sign out';
$this->params['breadcrumbs'][] = ['label' => 'registration', 'url' => ['signout']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= HTML::encode($this->title) ?>
<?php
        unset(Yii::$app->session["email"]);
        Yii::$app->response->redirect(['/car/booking']);
    ?>
