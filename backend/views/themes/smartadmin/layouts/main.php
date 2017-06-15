<?php
/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
AppAsset::register($this);
$this->beginPage();
?>
<?= $this->render('//layouts/head.php') ?>
	<body class="smart-style-3 pace-done fixed-header fixed-navigation">
	<?php $this->beginBody() ?>
		<?= $this->render('//layouts/header.php') ?>
		<?= $this->render('//layouts/navigation.php') ?>
		<!-- #MAIN PANEL -->
		<div id="main" role="main" class="clearfix">
			<!-- RIBBON -->
			<div id="ribbon">
				<!-- breadcrumb -->
				<?= Breadcrumbs::widget([
            		'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [''],
            	]) ?>
			</div>
			<!-- END RIBBON -->
			<!-- #MAIN CONTENT -->
			<div id="content">
    			<!-- end col -->
					<?= Alert::widget() ?>
					<?= $content ?>
			</div>
			<!-- end row -->
			<!-- END #MAIN CONTENT -->
		</div>
		<!-- END #MAIN PANEL -->
		<?= $this->render('//layouts/footer.php') ?>
		<?= $this->render('//layouts/shortcut.php') ?>
		<!-- #PLUGINS -->
		<?php //AppAsset::addScript($this, Yii::$app->request->baseUrl.'/themes/smartadmin/js/libs/jquery-ui-1.10.3.min.js'); ?>
		<?php AppAsset::addScript($this, Yii::$app->request->baseUrl.'/themes/smartadmin/js/app.config.seed.js'); ?>
		<?php AppAsset::addScript($this, Yii::$app->request->baseUrl.'/themes/smartadmin/js/app.seed.js'); ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>