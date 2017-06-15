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

<div class="user-form col-lg-8 col-xs-6">
    
        <?php 
       $form = ActiveForm::begin([
        'id' => 'user-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-8\">{input}{hint}</div>\n<div class=\"col-lg-3\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-2 control-label'],
        ],
    ]); ?>
    <?= $form->field($model, 'avatar_url')->hiddenInput(['id'=>'crop-avatar-submit-url'])->label('')?>
    <?= $form->field($model, 'username')->textInput(['maxlength' => 255])->label(Yii::t('rbac-admin', 'Username')) ?>
    <?= $form->field($model, 'password')->passwordInput(['maxlength' => 255])->label(Yii::t('rbac-admin', 'Password')) ?>
    <?= $form->field($model, 'repassword')->passwordInput(['maxlength' => 255])->label(Yii::t('rbac-admin', 'Confirm password')) ?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => 255])->label(Yii::t('rbac-admin', 'Email')) ?>
    <?= $form->field($model, 'mobile')->textInput(['maxlength' => 255])->label(Yii::t('rbac-admin', 'Mobile')) ?>
    <?= $form->field($model, 'dep_id')->dropDownList($parentCategory)->label(Yii::t('rbac-admin', 'Department')) ?>
    <div class="form-group">
        <label class="col-lg-2 col-xs-2 control-label" for="">&nbsp;</label>
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<div class="col-lg-3 col-xs-6">
    <?= \hyii2\avatar\AvatarWidget::widget(['imageUrl'=>$model->avatar_url?:'/themes/smartadmin/img/avatars/sunny-big.png','avatarPath'=>$avatarPath]); ?>
</div>
