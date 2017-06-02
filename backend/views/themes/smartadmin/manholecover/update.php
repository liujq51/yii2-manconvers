<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model admin\models\App */

$this->title = Yii::t('cover', 'Update Manhole Covers').': ' . $model->cover_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('cover', 'Manhole Covers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->cover_id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('cover', 'Update');
?>
<div class="app-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
