<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use rbac\admin\models\Department;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
$parentCategory = ArrayHelper::merge([0 => Yii::t('rbac-admin', 'Plase Filter')], ArrayHelper::map(Department::get(0, Department::find()->where(['>=','status','-1'])->asArray()->all()), 'id', 'label'));
unset($parentCategory[$model->id]);
?>
<div class="user-form">

    <?php $form = ActiveForm::begin([
        'id' => 'mend-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}{hint}</div>\n<div class=\"col-lg-5\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-2 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'dep_name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'parent_id')->dropDownList($parentCategory) ?>

    <div class="form-group">
        <label class="col-lg-2 control-label" for="">&nbsp;</label>
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
