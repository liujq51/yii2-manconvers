<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        #'assets/css/site.css',
        '/jquery-ui/jquery-ui.min.css',
    ];
    public $js = [
        //'/themes/ace/js/jquery.js',
		//'themes/ace/js/bootstrap.js'
        '/jquery-ui/jquery-ui.min.js',
    ];
    public $depends = [
         'yii\web\YiiAsset',
         'yii\bootstrap\BootstrapAsset',
         'yii\bootstrap\BootstrapPluginAsset',
    ];
	//定义按需加载JS方法，注意加载顺序在最后  
    public static function addScript($view, $jsfile, $options = []) {  
        //$view->registerJsFile($jsfile, [AppAsset::className(), 'depends' => 'backend\assets\AppAsset','position'=>\yii\web\view::POS_HEAD, 'options' =>$options]);  
        $view->registerJsFile($jsfile, [ 'depends' => 'backend\assets\AppAsset','options' =>$options]);  
    }  
      
   //定义按需加载css方法，注意加载顺序在最后  
    public static function addCss($view, $cssfile, $options=[]) {  
        $view->registerCssFile($cssfile, [ 'depends' => 'backend\assets\AppAsset','options' =>$options]);  
    }
}
