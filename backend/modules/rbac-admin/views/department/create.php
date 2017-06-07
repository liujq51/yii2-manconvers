<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model admin\models\App */

$this->title = Yii::t('rbac-admin', 'Create Department');
$this->params['breadcrumbs'][] = ['label' => Yii::t('menu', 'User department'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="app-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
