<?php
/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
AppAsset::register($this);
$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="<?= Yii::$app->charset ?>">
    <title><?= yii::t('app', 'Home') ?></title>
	<meta name="description" content="<?= Html::encode($this->title) ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?= Html::csrfMetaTags() ?>
	<!-- bootstrap & fontawesome -->
    <?php $this->head() ?>
	<?php AppAsset::addCss($this, Yii::$app->request->baseUrl.'/themes/rbox/css/font-awesome.css'); ?>
	<!-- text fonts -->
	<?php AppAsset::addCss($this, Yii::$app->request->baseUrl.'/themes/rbox/css/ace-fonts.css'); ?>
	<!-- rbox styles -->
	<?php AppAsset::addCss($this, Yii::$app->request->baseUrl.'/themes/rbox/css/ace.css'); ?>
	<?php AppAsset::addCss($this, Yii::$app->request->baseUrl.'/themes/rbox/css/ace-skins.css'); ?>
	<?php AppAsset::addCss($this, Yii::$app->request->baseUrl.'/themes/rbox/css/ace-part2.css',['condition'=>'lte IE9']); ?>
	<?php AppAsset::addCss($this, Yii::$app->request->baseUrl.'/themes/rbox/css/ace-ie.css',['condition'=>'lte IE9']); ?>
	<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->
	<?php AppAsset::addScript($this, Yii::$app->request->baseUrl.'/themes/rbox/js/html5shiv.js',['condition' => 'lte IE8']); ?>
	<?php AppAsset::addScript($this, Yii::$app->request->baseUrl.'/themes/rbox/js/respond.js',['condition' => 'lte IE8']); ?>
</head>
<body class="skin-1">
<?php $this->beginBody() ?>
		<!-- #section:basics/navbar.layout -->
		<?= $this->render('//layouts/top-nav.php') ?>
		<!-- /section:basics/navbar.layout -->
		<div class="main-container" id="main-container">
			<!-- #section:basics/sidebar -->
			<?= $this->render('//layouts/sidebar.php') ?>
			<!-- /section:basics/sidebar -->
			<div class="main-content">
				<div class="main-content-inner">
					<!-- #section:basics/content.breadcrumbs -->
					<div class="breadcrumbs" id="breadcrumbs">
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
			<?= $this->render('//layouts/footer.php') ?>
		</div><!-- /.main-container -->
		<!-- basic scripts -->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?=Yii::$app->request->baseUrl?>/themes/rbox/js/jquery.mobile.custom.js'>"+"<"+"/script>");
		</script>
		<!-- page specific plugin scripts -->
		<?php //AppAsset::addScript($this, '/themes/rbox/js/jquery-ui.custom.js'); ?>
		<?php //AppAsset::addScript($this, '/themes/rbox/js/jquery.ui.touch-punch.js'); ?>
		<!-- rbox scripts -->
		<?php AppAsset::addScript($this, Yii::$app->request->baseUrl.'/themes/rbox/js/ace/ace.js'); ?>
		<?php AppAsset::addScript($this, Yii::$app->request->baseUrl.'/themes/rbox/js/ace/ace.sidebar.js'); ?>
		<?php AppAsset::addScript($this, Yii::$app->request->baseUrl.'/themes/rbox/js/ace/ace.submenu-hover.js'); ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>