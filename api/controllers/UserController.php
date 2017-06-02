<?php
namespace api\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\filters\auth\QueryParamAuth;

/**
 * U controller
 */
class UserController extends ActiveController
{
	public $modelClass = 'api\models\User';
	
	public function init(){
	   parent::init();
		Yii::$app->response->format='json';
	}
	
	public function behaviors()
	{
	    $behaviors = parent::behaviors();
	    $behaviors['authenticator'] = [
	        'class' => QueryParamAuth::className(),
	        'tokenParam' => 'token'
	    ];
	    return $behaviors;
	}
	
}
