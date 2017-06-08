<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use rbac\admin\models\Department;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
$parentCategory = ArrayHelper::merge([0 => Yii::t('rbac-admin', 'Please Filter')], ArrayHelper::map(Department::get(0, Department::find()->where(['>=','status','-1'])->asArray()->all()), 'id', 'label'));
unset($parentCategory[$model->id]);
?>
<div class="user-form">

    <?php 
       $form = ActiveForm::begin([
        'id' => 'mend-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-4\">{input}{hint}</div>\n<div class=\"col-lg-5\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-2 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'dep_name')->textInput(['maxlength' => 255])->label(Yii::t('rbac-admin', 'Department Name')) ?>

    <?= $form->field($model, 'desc')->textarea(['rows' => 6])->label(Yii::t('rbac-admin', 'Department Desc')) ?>

    <?= $form->field($model, 'parent_id')->dropDownList($parentCategory,['value' => $model->parent_id])->label(Yii::t('rbac-admin', 'Parent Department')) ?>

    <div class="form-group">
        <label class="col-lg-2 control-label" for="">&nbsp;</label>
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
