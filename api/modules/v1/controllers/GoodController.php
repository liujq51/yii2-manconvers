<?php
namespace api\modules\v1\controllers;

use api\controllers\BaseActiveController;
use api\models\Goods;
use yii\filters\RateLimiter;

class GoodController extends BaseActiveController
{
    public $modelClass = 'api\models\Goods';
    
    public function behaviors()
    {
       $behaviors = parent::behaviors();
       $behaviors['rateLimiter'] = [
        'class' => RateLimiter::className(),
        'enableRateLimitHeaders' => true,
        ];
        return $behaviors;
    }
    
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['delete'], $actions['create']);
        //$actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        return $actions;
    }
    
    public function prepareDataProvider()
    {
        // 为"index"操作准备和返回数据provider
    }

}
