<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model rbox\admin\models\Menu */

$this->title = Yii::t('rbac-admin', 'Edit Menu') . ': ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', 'Menus'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('rbac-admin', 'Edit');
?>
<div class="menu-update container-fluid">
    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
