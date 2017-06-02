<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Tabs;
use rbac\admin\components\Helper;
use rbac\admin\models\User;

/* @var $this yii\web\View */
/* @var $searchModel rbox\admin\models\searchs\User */
/* @var $dataProvider yii\data\ActiveDataProvider */
AppAsset::register($this);
list(,$url) = Yii::$app->assetManager->publish('@rbox/admin/assets');
$this->registerCssFile($url.'/main.css');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <div class="wrap">
         <div class="container">
         <div class="container">
            <div class="user-index">
                <?=
            GridView::widget([
                                    'dataProvider' => $dataProvider,
                                    'filterModel' => $searchModel,
                                    'pager' => [ 'firstPageLabel' => 'First page', 'lastPageLabel' => 'Last page'],
                                    'columns' => [
                                        //['class' => 'yii\grid\SerialColumn'],
                                        [
                                            'attribute' => 'username',
                                            'options' => ['width' => '100px;'],
                                            
                                        ],
                                        [
                                        'attribute' => 'chinese_name',
                                        'options' => ['width' => '150px;'],
                                        
                                        ],
                                        [
                                        'attribute' => 'email',
                                        'options' => ['width' => '200px;'],
                                        
                                        ],
                                        [
                                        'attribute' => 'department',
                                        'options' => ['width' => '200px;'],
                                        'value'=> function($model){
                                             if($model->department){
                                                return $model->department->code.'-'.$model->department->chinese_name;
                                                   }
                                            },
                                        
                                        ],
                                        'mobile',
                                        [
                                        'label' => 'IsOperator',
                                        'options' => ['width' => '200px;'],
                                        'value'=> function($model){
                                            if($model->assignment){
                                                return '<span class="label label-success">system operator</span>';
                                                }else{
                                                return '<span class="label label-info"></span>';
                                                      }
                                            },
                                        'format'=>'html',
                                        ],
                                        [
                                            'class' => 'yii\grid\ActionColumn',
                                            'template' => Helper::filterActionColumn(['assignments']),
                                            'buttons' => [
                                                'assignments' => function ($url, $model) {
                                                        $options = [
                                                            'title' => Yii::t('yii', 'Assignments'),
                                                            'aria-label' => Yii::t('yii', 'Assignments'),
                                                            'data-pjax' => '0',
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
            </div>
            </div>
</div>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>