<?php
namespace api\controllers;

use Yii;
use yii\rest\Controller;

/**
 * Session controller
 */
class SessionController extends Controller
{
	#public $modelClass = 'api\models\User';
	
	public function init(){
		Yii::$app->response->format='json';
	}
	
	public function actions()
	{
		$actions = parent::actions();
		return $actions;
	}

    public function actionIndex()
    {
		//echo 'custom index';
        //return $this->render('index');
		Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;	
		Yii::$app->response->data = ['code'=>200,'data'=>['id'=>1]];
    }
}
