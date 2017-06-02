<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model admin\models\App */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="app-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'cover_id')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'cover_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'poi')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'province_id')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'city_id')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'area_id')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'construction_time')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'remark')->widget(CKEditor::className(),['editorOptions' => ['preset' => 'basic', 'inline' => false,]]);?>
    <?= $form->field($model, 'status')->textInput() ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('cover', 'Create') : Yii::t('cover', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
