<?php
namespace api\controllers;

use Yii;
use yii\web\Controller;
use api\models\LoginForm;
use yii\filters\VerbFilter;

/**
 * Site controller
 */
class TestController extends Controller
{
    public function actionIndex()
    {
		$ret = ['code'=>200, 'data'=>['a'=>'abc']];
		echo json_encode($ret);
        //return $this->render('index');
    }
}
