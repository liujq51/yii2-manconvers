<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model rbox\admin\models\AuthItem */
/* @var $context rbox\admin\components\ItemController */

$context = $this->context;
$labels = $context->labels();
$this->title = Yii::t('rbac-admin', 'Create ' . $labels['Item']);
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', $labels['Items']), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-create  container-fluid">
    <?=
    $this->render('_form', [
        'model' => $model,
    ]);
    ?>

</div>
