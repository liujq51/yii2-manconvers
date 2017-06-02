<?php

/* @var $this yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use common\widgets\Alert;

$this->title = 'Rbox基础管理系统';
//$this->params['breadcrumbs'][] = $this->title;
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
    <?php AppAsset::addCss($this, Yii::$app->request->baseUrl.'/themes/ace/css/font-awesome.css'); ?>
    <!-- text fonts -->
    <?php AppAsset::addCss($this, Yii::$app->request->baseUrl.'/themes/ace/css/ace-fonts.css'); ?>
    <!-- ace styles -->
    <?php AppAsset::addCss($this, Yii::$app->request->baseUrl.'/themes/ace/css/ace.css'); ?>
    <?php AppAsset::addCss($this, Yii::$app->request->baseUrl.'/themes/ace/css/ace-skins.css'); ?>
    <?php AppAsset::addCss($this, Yii::$app->request->baseUrl.'/themes/ace/css/ace-part2.css',['condition'=>'lte IE9']); ?>
    <?php AppAsset::addCss($this, Yii::$app->request->baseUrl.'/themes/ace/css/ace-ie.css',['condition'=>'lte IE9']); ?>
    <!-- ace settings handler -->
    <?php AppAsset::addScript($this, Yii::$app->request->baseUrl.'/themes/ace/js/ace-extra.js'); ?>
    <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->
    <?php AppAsset::addScript($this, Yii::$app->request->baseUrl.'/themes/ace/js/html5shiv.js',['condition' => 'lte IE8']); ?>
    <?php AppAsset::addScript($this, Yii::$app->request->baseUrl.'/themes/ace/js/respond.js',['condition' => 'lte IE8']); ?>
<?php
//$bjsj=rand(1,5);
$this->registerCss('
.bg{position: absolute;right: 0px;top: 0px;bottom: 0px;left: 0px;-moz-background-size: 100% 100%;-o-background-size: 100% 100%;-webkit-background-size: 100% 100%;-ms-background-size: 100% 100%;background-size: 100% 100%;filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=\'scale\')";background-color:#364150!important;}
');
?>
</head>
<body class="login-layout bg">
<?php $this->beginBody() ?>
	<div class="main-container">
	<div class="main-content">
    <div class="row">
	<div class="col-sm-10 col-sm-offset-1">
	<!-- PAGE CONTENT BEGINS -->
		<?= Alert::widget() ?>
      <?= $content ?>
      <!-- PAGE CONTENT ENDS -->
	</div>
	</div>
	</div>
	</div>
        <script type="text/javascript">
            if('ontouchstart' in document.documentElement) document.write("<script src='/themes/ace/js/jquery.mobile.custom.js'>"+"<"+"/script>");
        </script>
        <!-- page specific plugin scripts -->
        <?php AppAsset::addScript($this, Yii::$app->request->baseUrl.'/themes/ace/js/excanvas.js',['condition'=>'lte IE8']); ?>
        <?php AppAsset::addScript($this, Yii::$app->request->baseUrl.'/themes/ace/js/jquery-ui.custom.js'); ?>
        <?php AppAsset::addScript($this, Yii::$app->request->baseUrl.'/themes/ace/js/jquery.ui.touch-punch.js'); ?>
        <!-- ace scripts -->
        <?php AppAsset::addScript($this, Yii::$app->request->baseUrl.'/themes/ace/js/ace/ace.js'); ?>
        <?php AppAsset::addScript($this, Yii::$app->request->baseUrl.'/themes/ace/js/ace/ace.sidebar.js'); ?>
        <?php AppAsset::addScript($this, Yii::$app->request->baseUrl.'/themes/ace/js/ace/ace.submenu-hover.js'); ?>
        		<?php
			$this->registerJs("$(document).on('click', '.toolbar a[data-target]', function(e) {
				e.preventDefault();
				var target = $(this).data('target');
				$('.widget-box.visible').removeClass('visible');//hide others
				$(target).addClass('visible');//show target
			 });
");
		?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>