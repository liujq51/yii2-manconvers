<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model admin\models\App */
/* @var $form yii\widgets\ActiveForm */

$this->registerJsFile('http://api.map.baidu.com/api?v=2.0&ak=jcM1TIy1YKLrb78wGbHoKST86xduLZWV');
$poiArr = explode(',', $model->poi);
$this->registerJs("var _poi_lat = {$poiArr[1]},_poi_long = {$poiArr[0]};");
$this->registerJs($this->render('_script.js'));
?>
<div class="manhole-cover-form col-lg-6">
    <?php $form = ActiveForm::begin([
        'id' => 'manhole-cover-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-9\">{input}{hint}</div>\n<div class=\"col-lg-3\"></div>\n<div class=\"col-lg-9\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-3 control-label'],
        ],
     ]);?>
    <?= $form->field($model, 'cover_id')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'cover_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'poi')->textInput(['maxlength' => true])->label(Yii::t('app', 'Poi')) ?>
    <?= $form->field($model, 'province_id')->textInput(['maxlength' => true])->label(Yii::t('app', 'Province')) ?>
    <?= $form->field($model, 'city_id')->textInput(['maxlength' => true])->label(Yii::t('app', 'City')) ?>
    <?= $form->field($model, 'area_id')->textInput(['maxlength' => true])->label(Yii::t('app', 'Area')) ?>
    <?= $form->field($model, 'construction_time')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'remark')->widget(CKEditor::className(),['editorOptions' => ['preset' => 'basic', 'inline' => false,]]);?>
    <?= $form->field($model, 'status')->textInput() ?>
    
    <div class="form-group">
        <label class="col-lg-2 control-label" for="">&nbsp;</label>
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<div class="col-lg-6" id="allmap" style="height:600px;">
</div>
