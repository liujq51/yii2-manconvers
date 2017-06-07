<?php

use yii\helpers\Html;
use yii\grid\GridView;
use rbac\admin\components\Helper;
//use rbac\admin\models\User;

/* @var $this yii\web\View */
/* @var $searchModel rbox\admin\models\searchs\User */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('rbac-admin', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <?=
            GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    //'layout'=> '{items}{pager}',
                    'layout' => "{summary}\n{items}\n{pager}",
                    'pager' => [ 'firstPageLabel' => 'First page', 'lastPageLabel' => 'Last page'],
                    'filterSelector' => '#custom-filters input',
                    'columns' => [
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
                                            'class' => 'yii\grid\ActionColumn',
                                            'header' => Yii::t('app', 'Action'),
                                            'template' => Helper::filterActionColumn(['userinfo','assignments']),
                                            'buttons' => [
                                                'userinfo' => function ($url, $model) {
                                                        $options = [
                                                            'title' => Yii::t('yii', 'Userinfo'),
                                                            'aria-label' => Yii::t('yii', 'Userinfo'),
                                                            'data-pjax' => '0',
                                                            'class' => 'btn btn-sm btn-primary',
                                                            'type' => 'button',
                                                        ];
                                                        $url = "/rbac/user/update?id=".$model->id;
                                                        return Html::a(Yii::t('rbac-admin', 'Update'), $url, $options);
                                                        },
                                                  'assignments' => function ($url, $model) {
                                                        $options = [
                                                            'title' => Yii::t('yii', 'Assignments'),
                                                            'aria-label' => Yii::t('yii', 'Assignments'),
                                                            'data-pjax' => '0',
                                                            'class' => 'btn btn-sm btn-info',
                                                            'type' => 'button',
                                                        ];
                                                        $url = "/rbac/assignment/view?id=".$model->id;
                                                        return Html::a(Yii::t('rbac-admin', 'Assignments'), $url, $options);
                                                    },
                                                ]
                                            ],
                                        ],
                                    ])
                
                    ?>
</div>