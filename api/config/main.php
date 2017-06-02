<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'api\controllers',
    'bootstrap' => ['log'],
    'modules' => [
	    'v1' => [
	        'class' => 'api\modules\v1\Module',
	    ],
	 ],
    'components' => [
        'user' => [
            'identityClass' => 'api\models\User',
            'enableAutoLogin' => true,
            'enableSession'=>false
           ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
		'response' => [
			'format' => \yii\web\Response::FORMAT_JSON,
		],
      'request' => [
         'parsers' => [
            'application/json' => 'yii\web\JsonParser',
            ]
        ],
       'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
				    ['class'=>'yii\rest\UrlRule','controller' =>['user','v1/city'],'pluralize'=>false],
                ['class' => 'yii\rest\UrlRule','controller' => ['good'=>'v1/good']],
                ],
        ],
    ],
    'params' => $params,
];
