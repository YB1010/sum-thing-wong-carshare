<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Car */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="car-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'latitude')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'longitude')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'pendingTime')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'inUse')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
