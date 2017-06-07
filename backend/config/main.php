<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-admin',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'layout' => 'main',
    'aliases' => [
		'@rbac/admin' => __DIR__.'/../modules/rbac-admin',
	],
    //'language' => 'zh-CN',
    'on beforeRequest' => function ($event) {
    
        $lSaved = null;
        //$lSaved = Yii::$app->request->cookies->get('locale');
        $lSaved = Yii::$app->session['language'];
        $language = ($lSaved) ? $lSaved : 'zh-CN';
        // Yii::$app->sourceLanguage = 'en';
        Yii::$app->language = $language;
        return;
    },

    'modules' => [
		'rbac' => [
			'class' => 'rbac\admin\Module',
			//'layout' => '@admin/views/layouts/ace.php',
			'controllerMap' => [  
				'assignment' => [  
					'class' => 'rbac\admin\controllers\AssignmentController',  
					'userClassName' => 'backend\models\Admin',  
					'idField' => 'id'  
				]  
			],  
			'menus' => [  
				'assignment' => [  
				],  
				'role' => [
				],
				'permission'=> [
				],
				'route' => [
				],
				'rule' => [
				],
				'user' => null,
				'menu' => [
				],
				//'route' => null, // disable menu route  
			]
		],
	],
    'components' => [
        'user' => [
            'identityClass' => 'backend\models\Admin',
            'enableAutoLogin' => true,
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
        'view' =>[
            'theme' =>[
                'pathMap' => [
                    '@app/views'=>'@app/views/themes/smartadmin',
                ],
                'baseUrl' => '@app/views/themes/smartadmin',
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
		'authManager' => [
			'class' => 'yii\rbac\DbManager',
			'defaultRoles' => [],//指定默认规则为"未登录用户"
		],
		'i18n' => [
            'translations' => [
             'app*' => [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@common/messages',
    			'sourceLanguage' => 'en',
                'fileMap' => [
                  'app' => 'app.php',
                  //'menu' => 'menu.php',
				 ],
                ],
              '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                    'sourceLanguage' => 'en',
                    'fileMap' => [
                        //'app' => 'app.php',
                        'menu' => 'menu.php',
                    ],
                ],
            ],
        ],
    ],
	'as access' => [
		'class' => 'rbac\admin\components\AccessControl',
		'allowActions' => [
			//允许访问的节点，可自行添加
            'site/*',
		],
	],
    'params' => $params,
];
