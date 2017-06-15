<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = Yii::t('rbac-admin', 'Update') . Yii::t('rbac-admin', 'Department') . ' ' . $model->dep_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', 'Department'), 'url' => ['/rbac/department']];
$this->params['breadcrumbs'][] = ['label' => $model->dep_name];
?>
<div class="user-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
