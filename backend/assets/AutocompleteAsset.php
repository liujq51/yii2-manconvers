<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * AutocompleteAsset
 *
 * @author Misbahul D Munir <misbahuldmunir@gmail.com>
 * @since 1.0
 */
class AutocompleteAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    //public $sourcePath = '@backend';
    //public $basePath = '@webroot';
    //public $baseUrl = '@web';
    /**
     * @inheritdoc
     */
    public $css = [
        'css/jquery-ui.css',
    ];
    /**
     * @inheritdoc
     */
    public $js = [
       'js/jquery-ui.js',
    ];
    /**
     * @inheritdoc
     */
    public $depends = [
         'yii\web\JqueryAsset',
    ];
    //定义按需加载JS方法，注意加载顺序在最后
    public static function addScript($view, $jsfile, $options = []) {
        //$view->registerJsFile($jsfile, [AppAsset::className(), 'depends' => 'backend\assets\AppAsset','position'=>\yii\web\view::POS_HEAD, 'options' =>$options]);
        $view->registerJsFile($jsfile, [AutocompleteAsset::className(), 'depends' => 'backend\assets\AutocompleteAsset','options' =>$options]);
    }
    
    //定义按需加载css方法，注意加载顺序在最后
    public static function addCss($view, $cssfile, $options=[]) {
        $view->registerCssFile($cssfile, [AutocompleteAsset::className(), 'depends' => 'backend\assets\AutocompleteAsset','options' =>$options]);
    }
}
