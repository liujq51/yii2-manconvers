<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use rbac\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $model rbox\admin\models\User */

$this->title = $model->dep_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', 'Department'), 'url' => ['/rbac/department']];
$this->params['breadcrumbs'][] = $this->title;

$controllerId = $this->context->uniqueId . '/';
?>
<div class="user-view">
    <p>
        <?php
        if ($model->status == -1 && Helper::checkRoute($controllerId . 'activate')) {
            echo Html::a(Yii::t('rbac-admin', 'Activate'), ['activate', 'id' => $model->id], [
                'class' => 'btn btn-primary',
                'data' => [
                    'confirm' => Yii::t('rbac-admin', 'Are you sure you want to activate this user?'),
                    'method' => 'post',
                ],
            ]);
        }
        ?>
        <?php
        if (Helper::checkRoute($controllerId . 'delete')) {
            echo Html::a(Yii::t('rbac-admin', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]);
        }
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'dep_name',
            'desc',
            'status',
            'created_at:date',
        ],
    ])
    ?>

</div>
