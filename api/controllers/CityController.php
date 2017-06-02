<?php
namespace api\controllers;

use Yii;
use yii\rest\ActiveController;

/**
 * City controller
 */
class CityController extends ActiveController
{
    public $modelClass = 'api\models\City';
    
    public function init(){
        Yii::$app->response->format='json';
    }
    
    /**
     * @inheritdoc
     */
    public function actions()
    {
		$actions = parent::actions();
		return $actions;
    }

}
