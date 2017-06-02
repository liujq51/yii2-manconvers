<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use backend\components\SideNav;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use rbac\admin\components\MenuHelper;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="<?= Yii::$app->charset ?>">
    <title><?= Html::encode($this->title) ?></title>
	<meta name="description" content="<?= Html::encode($this->title) ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?= Html::csrfMetaTags() ?>
	<!-- bootstrap & fontawesome -->
    <?php $this->head() ?>
	<?php AppAsset::addCss($this, '/assets/css/font-awesome.css'); ?>
	<!-- text fonts -->
	<?php AppAsset::addCss($this, '/assets/css/ace-fonts.css'); ?>
	<!-- ace styles -->
	<?php AppAsset::addCss($this, '/assets/css/ace.css'); ?>
	<?php AppAsset::addCss($this, '/assets/css/ace-skins.css'); ?>
	<?php AppAsset::addCss($this, '/assets/css/ace-part2.css',['condition'=>'lte IE9']); ?>
	<?php AppAsset::addCss($this, '/assets/css/ace-ie.css',['condition'=>'lte IE9']); ?>
	<!-- ace settings handler -->
	<?php AppAsset::addScript($this, '/assets/js/ace-extra.js'); ?>
	<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->
	<?php AppAsset::addScript($this, '/assets/js/html5shiv.js',['condition' => 'lte IE8']); ?>
	<?php AppAsset::addScript($this, '/assets/js/respond.js',['condition' => 'lte IE8']); ?>
</head>
<body class="skin-1">
<?php $this->beginBody() ?>
		<!-- #section:basics/navbar.layout -->
		<div id="navbar" class="navbar navbar-default">
                <?php
                $this->registerJs(
                    "try{ace.settings.check('navbar' , 'fixed')}catch(e){}"
                );
                ?>

			<div class="navbar-container" id="navbar-container">
				<!-- #section:basics/sidebar.mobile.toggle -->
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<!-- /section:basics/sidebar.mobile.toggle -->
				<div class="navbar-header pull-left">
					<!-- #section:basics/navbar.layout.brand -->
					<a href="#" class="navbar-brand">
						<small>
							<i class="fa fa-group"></i>
							统一用户管理系统
						</small>
					</a>
					<!-- /section:basics/navbar.layout.brand -->
				</div>
				<!-- #section:basics/navbar.dropdown -->
				<div class="navbar-buttons navbar-header pull-right" role="navigation">
				<?php
				$menuItems = [
					[
						'label' => '<img class="nav-user-photo" src="http://localhost/Ace_admin_1.3.4/assets/avatars/user.jpg" alt="Jason\'s Photo"><span class="user-info"><small>您好：</small>liujiaqiang@126.com</span>',
						'encode' => false,
						'items' => [
							['label' => '设置', 'icon'=>['class' => 'ace-icon fa fa-cog'], 'url' => '#'],
							['label' => '个人资料', 'icon'=>['class' => 'ace-icon fa fa-user'],'url' => '#'],
							'<li class="divider"></li>',
							'<li><a href="'.Url::to('/site/logout').'"><i class="ace-icon fa fa-power-off"></i>退出</a></li>',
							'<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                '退出',
                ['class' => 'btn btn-link']
            )
            . Html::endForm()
            . '</li>',
							]
						],
				];
				echo Nav::widget([
					'options' => ['class' => 'nav ace-nav'],
					'items' => $menuItems,
					//'items' => MenuHelper::getAssignedMenu(Yii::$app->user->id, null ,$menuCallback),
				]);
				?>
				</div>
				<!-- /section:basics/navbar.dropdown -->
			</div><!-- /.navbar-container -->
		</div>

		<!-- /section:basics/navbar.layout -->
		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>

			<!-- #section:basics/sidebar -->
			<div id="sidebar" class="sidebar responsive">
				<?php
				$this->registerJs(
					"try{ace.settings.check('sidebar' , 'fixed')}catch(e){}"
				);
				?>
				<!-- #section:basics/sidebar.layout.minimize -->
				<div class="sidebar-toggle sidebar-collapse" >
					<i class="ace-icon fa fa-th-large" data-icon1="ace-icon fa fa-th-large" data-icon2="ace-icon fa fa-th"></i>
				</div>
				<!-- /section:basics/sidebar.layout.minimize -->
				<!-- /.sidebar-shortcuts -->

<?php
$menuCallback = function ($menu) {
    $data = eval($menu['data']);
	$icon = (isset($data['icon']) && $data['icon'])?$data['icon']:[];
    return [
        'label' => $menu['name'],
        'url' => [$menu['route']],
		'icon' => $icon,
        'items' => $menu['children'],
        ];
};
    echo SideNav::widget([
        'options' => ['class' => 'nav nav-list'],
        //'items' => $menuItems,
        'items' => MenuHelper::getAssignedMenu(Yii::$app->user->id, null ,$menuCallback),
    ]);
    ?>
				<!-- /section:basics/sidebar.layout.minimize -->
				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
				</script>
			</div>

			<!-- /section:basics/sidebar -->
			<div class="main-content">
				<div class="main-content-inner">
					<!-- #section:basics/content.breadcrumbs -->
					<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>
						<?= Breadcrumbs::widget([
								'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [''],
						]) ?>
						<!-- /.breadcrumb -->

					</div>
					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
									<?= Alert::widget() ?>
							        <?= $content ?>
								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			<div class="footer">
				<div class="footer-inner">
					<!-- #section:basics/footer -->
					<div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder">Ace</span>
							Application &copy; 2013-2014
						</span>

						&nbsp; &nbsp;
						<span class="action-buttons">
							<a href="#">
								<i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-rss-square orange bigger-150"></i>
							</a>
						</span>
					</div>

					<!-- /section:basics/footer -->
				</div>
			</div>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='/assets/js/jquery.js'>"+"<"+"/script>");
		</script>
		<!-- <![endif]-->

		<!--[if IE]>
		<script type="text/javascript">
			window.jQuery || document.write("<script src='/assets/js/jquery1x.js'>"+"<"+"/script>");
		</script>
		<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='/assets/js/jquery.mobile.custom.js'>"+"<"+"/script>");
		</script>
		<!-- page specific plugin scripts -->
		<?php AppAsset::addScript($this, '/assets/js/excanvas.js',['condition'=>'lte IE8']); ?>
		<?php AppAsset::addScript($this, '/assets/js/jquery-ui.custom.js'); ?>
		<?php AppAsset::addScript($this, '/assets/js/jquery.ui.touch-punch.js'); ?>
		<!-- ace scripts -->
		<?php AppAsset::addScript($this, '/assets/js/ace/ace.js'); ?>
		<?php AppAsset::addScript($this, '/assets/js/ace/ace.sidebar.js'); ?>
		<?php AppAsset::addScript($this, '/assets/js/ace/ace.submenu-hover.js'); ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
