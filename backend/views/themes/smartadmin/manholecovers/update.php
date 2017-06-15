<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model admin\models\App */

$this->title =  $model->cover_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Manhole Cover'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->cover_id,];
?>
<div class="app-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
