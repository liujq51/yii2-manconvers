<?php
namespace api\controllers;

use yii;
use yii\rest\ActiveController;
use yii\helpers\ArrayHelper;
use yii\filters\auth\QueryParamAuth;
use yii\web\Response;
use yii\filters\RateLimiter;

class BaseActiveController extends ActiveController
{
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];
    public function behaviors()
    {
        return ArrayHelper::merge (parent::behaviors(), [
            'authenticator' => [
                'class' => QueryParamAuth::className(),
                'tokenParam' => 'token'
                ],
            'contentNegotiator' => ['formats' => ['text/html' => Response::FORMAT_JSON]],
        ] );
    }
}
