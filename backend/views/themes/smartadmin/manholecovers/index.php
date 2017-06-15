<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Manholecovers;

/* @var $this yii\web\View */
/* @var $searchModel admin\models\AppSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Manhole Cover');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="app-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Manhole Cover'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Batch ') . Yii::t('app', 'Enabled'), '#', ['class' => 'btn btn-primary', 'id' => 'batchEnabled','data-type'=> 'STATUS_ENABLED']) ?>
        <?= Html::a(Yii::t('app', 'Batch ') . Yii::t('app', 'Disabled'), '#', ['class' => 'btn btn-info', 'id' => 'batchDisabled','data-type'=> 'STATUS_DISABLED']) ?>
        <?= Html::a(Yii::t('app', 'Batch ') . Yii::t('app', 'Delete'), '#', ['class' => 'btn btn-danger', 'id' => 'batchDelete','data-type'=> 'STATUS_DELETED']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\CheckboxColumn',
                'options' => ['width' => '30px;'],
            ],

            'cover_id',
            'cover_name',
            /*[
                'attribute'=>'province',
                'label' => Yii::t('app', 'Province'),
                'value' => function($model){
                    return $model->province?$model->province->province:'';
                },
                'format' => 'html',
            ],*/
            ['label'=>Yii::t('app', 'Province'), 'attribute' => 'province',  'value' => 'province.province' ],
            ['label'=>Yii::t('app', 'City'), 'attribute' => 'city',  'value' => 'city.city' ],
            ['label'=>Yii::t('app', 'Area'), 'attribute' => 'area',  'value' => 'area.area' ],
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
                    ['class' => 'form-control', 'prompt' => Yii::t('app', 'Please Filter')]
                )
            ],
            [
                'attribute' => 'construction_time',
                'options' => ['width' => '100px;'],
            ],
            // 'remark',
            // 'status',
            // 'createat',
            // 'updateat',
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => Yii::t('app', 'Action'),
                'options' => ['width' => '150px;'],
                'template' => '{view}&nbsp;{delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        $options = [
                        'title' => Yii::t('app', 'View'),
                        'aria-label' => Yii::t('app', 'View'),
                        'data-pjax' => '0',
                        'class' => 'btn btn-xs btn-info',
                        'type' => 'button',
                        ];
                        $url = ['update','id'=>$model->id];
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, $options);
                    },
                    'delete' => function ($url, $model) {
                        $options = [
                            'title' => Yii::t('app', 'Delete'),
                            'aria-label' => Yii::t('app', 'Delete'),
                            'data-pjax' => '0',
                            'class' => 'btn btn-xs btn-danger',
                            'type' => 'button',
                            'data' => [
                                'confirm' => Yii::t('app', 'Are you sure you want to disable this item?'),
                                'method' => 'post',
                            ],
                        ];
                        $url = ["delete",'id'=>$model->id];
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, $options);
                    },
                ]
            ],
        ],
    ]); ?>
</div>
<?php
$urlBatchUpdateStatus = \yii\helpers\Url::to(['/manholecovers/batch-update-status']);
$js = <<<JS
jQuery(document).ready(function() {
    $("#batchDelete,#batchDisabled,#batchEnabled").click(function() {
        var keys = $("#w0").yiiGridView("getSelectedRows");
        var statusType = $(this).data("type");
        if(keys.length ==0){
            alert('请选择操作节点。');
            return ;
        }
        $.ajax({
            type: "POST",
            url: "{$urlBatchUpdateStatus}",
            dataType: "json",
            data: {ids: keys,statusType:statusType}
        });
    });
});
JS;
$this->registerJs($js, \yii\web\View::POS_END);