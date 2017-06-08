<?php

use yii\helpers\Html;
use yii\grid\GridView;
use rbac\admin\components\Helper;
use rbac\admin\models\User;

/* @var $this yii\web\View */
/* @var $searchModel rbox\admin\models\searchs\User */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('rbac-admin', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <p>
        <?= Html::a(Yii::t('rbac-admin', 'Create') . Yii::t('rbac-admin', 'User'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('rbac-admin', 'Batch ') . Yii::t('rbac-admin', 'Enabled'), '#', ['class' => 'btn btn-primary', 'id' => 'batchEnabled','data-type'=> 'STATUS_ENABLED']) ?>
        <?= Html::a(Yii::t('rbac-admin', 'Batch ') . Yii::t('rbac-admin', 'Disabled'), '#', ['class' => 'btn btn-info', 'id' => 'batchDisabled','data-type'=> 'STATUS_DISABLED']) ?>
        <?= Html::a(Yii::t('rbac-admin', 'Batch ') . Yii::t('rbac-admin', 'Delete'), '#', ['class' => 'btn btn-danger', 'id' => 'batchDelete','data-type'=> 'STATUS_DELETED']) ?>
    </p>
    <?=
        GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                //'layout'=> '{items}{pager}',
                'layout' => "{summary}\n{items}\n{pager}",
                'pager' => [ 'firstPageLabel' => 'First page', 'lastPageLabel' => 'Last page'],
                'filterSelector' => '#custom-filters input',
                'columns' => [
                    [
                         'class' => 'yii\grid\CheckboxColumn',
                         'options' => ['width' => '30px;'],
                    ],
                    //['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'username',
                        'label' => Yii::t('rbac-admin', 'Name'),
                        'options' => ['width' => '100px;'],
                        
                    ],
                    [
                    'attribute' => 'email',
                    'label' => Yii::t('rbac-admin', 'Email'),
                    'options' => ['width' => '200px;'],
                    
                    ],
                    [
                        'attribute' => 'mobile',
                        'label' => Yii::t('rbac-admin', 'Mobile'),
                        'options' => ['width' => '300px;'],
                    ],
                    [
                    'label' => Yii::t('rbac-admin', 'Assignment'),
                    'value'=> function($model){
                            if($model->assignment){
                                return array_reduce((array)$model->assignment, function ($result, $v){
                                    return $result .'<span class="label label-success pull-left" style="padding:0.1em .6em .1em;margin:.1em 0.2em;font-size:98%;">'.$v->item_name.'</span>';    
                                 });
                             }else{
                                return '<span class="label label-info"></span>';
                             }
                         },
                        'format'=>'html',
                    ],
                    [
                    'attribute' => 'status',
                        'format' => 'html',
                        'value' => function ($model) {
                        if ($model->status === User::STATUS_ENABLED) {
                            $class = 'label-success';
                        } elseif ($model->status === User::STATUS_DISABLED) {
                            $class = 'label-warning';
                        } else {
                        $class = 'label-info';
                        }
                        return (!empty($model->status))?'<span class="label ' . $class . '">' . User::getStatusLabels($model->status) . '</span>':'';
                        },
                'filter' => Html::activeDropDownList(
                                        $searchModel,
                                        'status',
                                        User::getStatusLabels(),
                                        ['class' => 'form-control', 'prompt' => Yii::t('app', 'Please Filter')]
                    )
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => Yii::t('app', 'Action'),
                        'template' => Helper::filterActionColumn(['userinfo','assignments']),
                        'buttons' => [
                            'userinfo' => function ($url, $model) {
                                    $options = [
                                        'title' => Yii::t('yii', 'Userinfo'),
                                        'aria-label' => Yii::t('yii', 'Userinfo'),
                                        'data-pjax' => '0',
                                        'class' => 'btn btn-xs btn-primary',
                                        'type' => 'button',
                                    ];
                                    $url = "/rbac/user/update?id=".$model->id;
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, $options);
                                    },
                              'assignments' => function ($url, $model) {
                                    $options = [
                                        'title' => Yii::t('yii', 'Assignments'),
                                        'aria-label' => Yii::t('yii', 'Assignments'),
                                        'data-pjax' => '0',
                                        'class' => 'btn btn-xs btn-info',
                                        'type' => 'button',
                                    ];
                                    $url = "/rbac/assignment/view?id=".$model->id;
                                    return Html::a('<span class="glyphicon glyphicon-cog"></span>', $url, $options);
                                },
                            ]
                        ],
                    ],
                ])
?>
</div>
<?php
$urlBatchUpdateStatus = \yii\helpers\Url::to(['/rbac/user/batch-update-status']);
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