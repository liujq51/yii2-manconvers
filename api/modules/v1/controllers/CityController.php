<?php
namespace api\modules\v1\controllers;

use api\controllers\BaseActiveController;

class CityController extends BaseActiveController
{
    public $modelClass = 'api\models\Citys';
    
    public function actionIndex()
    {
        return $this->render('index');
    }

}
