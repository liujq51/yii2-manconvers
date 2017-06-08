<?php

use yii\helpers\Html;
use yii\grid\GridView;
use rbac\admin\components\RouteRule;
use rbac\admin\components\Configs;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel rbox\admin\models\searchs\AuthItem */
/* @var $context rbox\admin\components\ItemController */

$context = $this->context;
$labels = $context->labels();
$this->title = Yii::t('rbac-admin', $labels['Items']);
$this->params['breadcrumbs'][] = $this->title;

$rules = array_keys(Configs::authManager()->getRules());
$rules = array_combine($rules, $rules);
unset($rules[RouteRule::RULE_NAME]);
?>
<div class="role-index  container-fluid">
    <p>
        <?= Html::a(Yii::t('rbac-admin', 'Create ' . $labels['Item']), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'name',
                'label' => Yii::t('rbac-admin', 'Name'),
            ],
            [
                'attribute' => 'ruleName',
                'label' => Yii::t('rbac-admin', 'Rule Name'),
                'filter' => $rules
            ],
            [
                'attribute' => 'description',
                'label' => Yii::t('rbac-admin', 'Description'),
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}&nbsp;&nbsp;{delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        $options = [
                            'title' => Yii::t('app', 'View'),
                            'aria-label' => Yii::t('app', 'View'),
                            'data-pjax' => '0',
                            'class' => 'btn btn-xs btn-primary',
                            'type' => 'button',
                        ];
                        $url = ['view','id'=>$model->name];
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, $options);
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
                        $url = ["delete",'id'=>$model->name];
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, $options);
                    },
                    ]
            ],
        ],
    ])
    ?>

</div>
