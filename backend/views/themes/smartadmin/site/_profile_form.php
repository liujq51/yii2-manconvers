<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\User;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => 255])->label(Yii::t('app', 'Username')) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 255])->label(Yii::t('app', 'Email')) ?>
    
    <?= $form->field($model, 'mobile')->textInput(['maxlength' => 255])->label(Yii::t('app', 'Mobile')) ?>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
