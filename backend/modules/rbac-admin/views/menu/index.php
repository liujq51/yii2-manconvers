<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use rbac\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel rbox\admin\models\searchs\Menu */

$this->title = Yii::t('rbac-admin', 'Menus');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-index container-fluid">
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>
    <p>
        <?= Html::a(Yii::t('rbac-admin', 'Create Menu'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            'name',
            [
                'attribute' => 'menuParent.name',
                'filter' => Html::activeTextInput($searchModel, 'parent_name', [
                    'class' => 'form-control', 'id' => null
                ]),
                'label' => Yii::t('rbac-admin', 'Parent'),
            ],
            'route',
            'order',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update}&nbsp;&nbsp;{delete}',
                    'buttons' => [
                        'update' => function ($url, $model) {
                            $options = [
                                'title' => Yii::t('app', 'Update'),
                                'aria-label' => Yii::t('app', 'Update'),
                                'data-pjax' => '0',
                                'class' => 'btn btn-xs btn-primary',
                                'type' => 'button',
                            ];
                            $url = ['update','id'=>$model->id];
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
                            $url = ["delete",'id'=>$model->id];
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, $options);
                        },
                      ]
                ],
        ],
    ]);
    ?>
<?php Pjax::end(); ?>
</div>