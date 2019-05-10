<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Car */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="car-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype'=>'multipart/form-data']
    ]); ?>

    <?= $form->field($model, 'latitude')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'longitude')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'pendingTime')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'inUse')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'carName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'carImgUrl')->fileInput() ?>

    <?= $form->field($model, 'numOfPassenger')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
