<?php
/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
AppAsset::register($this);
$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
	<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
   <meta charset="<?= Yii::$app->charset ?>">
   <title><?= yii::t('app', $this->title) ?></title>
	<meta name="description" content="<?= Html::encode($this->title) ?>" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<?= Html::csrfMetaTags() ?>
	<!-- bootstrap & fontawesome -->
   <?php $this->head() ?>
		<!-- #CSS Links -->
		<!-- Basic Styles -->
		<?php AppAsset::addCss($this, Yii::$app->request->baseUrl.'/themes/smartadmin/css/font-awesome.min.css'); ?>
		<!-- SmartAdmin Styles : Caution! DO NOT change the order -->
		<?php AppAsset::addCss($this, Yii::$app->request->baseUrl.'/themes/smartadmin/css/smartadmin-production.css'); ?>
		<?php //AppAsset::addCss($this, Yii::$app->request->baseUrl.'/themes/smartadmin/css/smartadmin-production-plugins.css'); ?>
		<?php AppAsset::addCss($this, Yii::$app->request->baseUrl.'/themes/smartadmin/css/smartadmin-skins.min.css'); ?>
		<?php AppAsset::addCss($this, Yii::$app->request->baseUrl.'/themes/smartadmin/css/rbox.css'); ?>
		<!-- #FAVICONS -->
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
		<link rel="icon" href="/favicon.ico" type="image/x-icon">
		<!-- #GOOGLE FONT -->
		<?php AppAsset::addCss($this, Yii::$app->request->baseUrl.'/themes/smartadmin/css/googleapis.css'); ?>
		<!-- #APP SCREEN / ICONS -->
		<link rel="apple-touch-icon" href="/themes/smartadmin/img/splash/sptouch-icon-iphone.png">
		<link rel="apple-touch-icon" sizes="76x76" href="/themes/smartadmin/img/splash/touch-icon-ipad.png">
		<link rel="apple-touch-icon" sizes="120x120" href="/themes/smartadmin/img/splash/touch-icon-iphone-retina.png">
		<link rel="apple-touch-icon" sizes="152x152" href="/themes/smartadmin/img/splash/touch-icon-ipad-retina.png">
		<!-- iOS web-app metas : hides Safari UI Components and Changes Status Bar Appearance -->
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<!-- Startup image for web apps -->
		<link rel="apple-touch-startup-image" href="/themes/smartadmin/img/splash/ipad-landscape.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
		<link rel="apple-touch-startup-image" href="/themes/smartadmin/img/splash/ipad-portrait.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
		<link rel="apple-touch-startup-image" href="/themes/smartadmin/img/splash/iphone.png" media="screen and (max-device-width: 320px)">
	</head>