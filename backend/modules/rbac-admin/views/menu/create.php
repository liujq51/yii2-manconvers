<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model rbox\admin\models\Menu */

$this->title = Yii::t('rbac-admin', 'Create Menu');
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', 'Menus'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-create  container-fluid">
    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
