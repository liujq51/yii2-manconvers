<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Manholecovers;

/* @var $this yii\web\View */
/* @var $searchModel admin\models\AppSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('cover', 'Manhole Covers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="app-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('cover', 'Create Manhole Covers'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('cover', 'Batch ') . Yii::t('cover', 'Disabled'), '#', ['class' => 'btn btn-info', 'id' => 'batchDisabled']) ?>
        <?= Html::a(Yii::t('cover', 'Batch ') . Yii::t('cover', 'Delete'), '#', ['class' => 'btn btn-danger', 'id' => 'batchDelete']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\CheckboxColumn',
            ],

            'cover_id',
            'cover_name',
            /*[
                'attribute'=>'province',
                'label' => Yii::t('cover', 'Province'),
                'value' => function($model){
                    return $model->province?$model->province->province:'';
                },
                'format' => 'html',
            ],*/
            ['label'=>Yii::t('cover', 'Province'), 'attribute' => 'province',  'value' => 'province.province' ],
            ['label'=>Yii::t('cover', 'City'), 'attribute' => 'city',  'value' => 'city.city' ],
            ['label'=>Yii::t('cover', 'Area'), 'attribute' => 'area',  'value' => 'area.area' ],
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => function ($model) {
                    if ($model->status === Manholecovers::STATUS_ENABLED) {
                        $class = 'label-success';
                    } elseif ($model->status === Manholecovers::STATUS_DISABLED) {
                        $class = 'label-warning';
                    } else {
                        $class = 'label-info';
                    }
                   return (!empty($model->status))?'<span class="label ' . $class . '">' . Manholecovers::getStatusLabels($model->status) . '</span>':'';
                },
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'status',
                    Manholecovers::getStatusLabels(),
                    ['class' => 'form-control', 'prompt' => Yii::t('cover', 'Please Filter')]
                )
            ],
            'construction_time',
            // 'remark',
            // 'status',
            // 'createat',
            // 'updateat',
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => Yii::t('cover', 'Action'),
                'options' => ['width' => '200px;'],
                'template' => '{view}&nbsp;{delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        $options = [
                        'title' => Yii::t('cover', 'View'),
                        'aria-label' => Yii::t('cover', 'View'),
                        'data-pjax' => '0',
                        'class' => 'btn btn-sm btn-primary',
                        'type' => 'button',
                        ];
                        $url = ['view','id'=>$model->id];
                        return Html::a(Yii::t('cover', 'View'), $url, $options);
                    },
                    'delete' => function ($url, $model) {
                        $options = [
                            'title' => Yii::t('cover', 'Delete'),
                            'aria-label' => Yii::t('cover', 'Delete'),
                            'data-pjax' => '0',
                            'class' => 'btn btn-sm btn-danger',
                            'type' => 'button',
                            'data' => [
                                'confirm' => Yii::t('cover', 'Are you sure you want to disable this item?'),
                                'method' => 'post',
                            ],
                        ];
                        $url = ["delete",'id'=>$model->id];
                        return Html::a(Yii::t('cover', 'Delete'), $url, $options);
                    },
                ]
            ],
        ],
    ]); ?>
</div>
<?php
$urlBatchDelete = \yii\helpers\Url::to(['/manholecovers/batch-delete']);
$urlBatchDisabled = \yii\helpers\Url::to(['/manholecovers/batch-disabled']);
$js = <<<JS
jQuery(document).ready(function() {
    $("#batchDelete").click(function() {
        var keys = $("#w0").yiiGridView("getSelectedRows");
        $.ajax({
            type: "POST",
            url: "{$urlBatchDelete}",
            dataType: "json",
            data: {ids: keys}
        });
    });
    $("#batchDisabled").click(function() {
        var keys = $("#w0").yiiGridView("getSelectedRows");
        $.ajax({
            type: "POST",
            url: "{$urlBatchDisabled}",
            dataType: "json",
            data: {ids: keys}
        });
    });
});
JS;
$this->registerJs($js, \yii\web\View::POS_END);