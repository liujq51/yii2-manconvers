<?php
namespace api\modules\v1\controllers;

use api\controllers\BaseActiveController;

class ManholecoverController extends BaseActiveController
{
    public $modelClass = 'api\models\Manholecover';
    
    public function actionIndex()
    {
        $ret = ['code'=>200, 'data'=>['a'=>'abc']];
        echo json_encode($ret);
        //return $this->render('index');
    }

}
