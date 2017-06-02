<?php
use backend\assets\AppAsset;
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use yii\widgets\Breadcrumbs;
use yii\helpers\Html;
use rbac\admin\components\MenuHelper;

/* @var $this \yii\web\View */
/* @var $content string */
AppAsset::register($this);
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
        <?php
NavBar::begin([
    'brandLabel' => 'Base-Fx',
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-inverse navbar-fixed-top',
    ],
]);
$menuCallback = function ($menu) {
    $data = eval($menu['data']);
    $icon = (isset($data['icon']) && $data['icon'])?$data['icon']:[];
    return [
        'label' => $menu['name'],
        'url' => [$menu['route']],
        'items' => $menu['children'],
    ];
};
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-left'],
    //'items' => $menuItems,
    'items' => MenuHelper::getAssignedMenu(Yii::$app->user->id, null ,$menuCallback),
]);
$menuItems = [
    //[
    //    'label' => Yii::t('app', 'Modify Password'),
    //    'url' => ['site/change-password'],
    //],
   // ['label' => Yii::t('app', 'Home'), 'url' => ['/site/index']],
];
if (Yii::$app->user->isGuest) {
    //$menuItems[] = ['label' => Yii::t('app', 'Login'), 'url' => ['/site/login']];
} else {
    $menuItems[] = [
        'label' => Yii::t('app', 'Welcome').' ' .Yii::$app->user->identity->username. '(' .Yii::$app->user->identity->email . ')',
        //'linkOptions' => ['data-method' => 'post']
    ];
}
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => $menuItems,
]);
NavBar::end();
        ?>
        <div class="container">
            <div class="content-nav">
    				<?= Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [''],
                    ]) ?>
            </div>
            <div class="content-header">
            	<h1><?= $this->title ?></h1>
            </div>
            <div class="container">
                <?= $content ?>
            </div>
        </div>
</div>
        <footer class="footer">
            <div class="container">
                <!--<p class="pull-right"><?= Yii::powered() ?></p>-->
            </div>
        </footer>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
