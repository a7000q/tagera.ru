<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'gridview' =>  [
            'class' => '\kartik\grid\Module',
            // enter optional module parameters below - only if you need to
            // use your own export download action or custom translation
            // message source
            //'downloadAction' => false,
            // 'i18n' => []
        ],
        'user' => [
            // following line will restrict access to profile, recovery, registration and settings controllers from backend
            'as backend' => 'dektrium\user\filters\BackendFilter',
            'controllerMap' => [
                'security' => 'backend\controllers\user\SecurityController'
            ],
            'modelMap' => [
                'User' => 'backend\models\user\User',
            ],
        ]
    ],
    'defaultRoute' => 'category',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'assetManager' => [
            'linkAssets' => true,
        ],
        'user' => [
            'identityCookie' => [
                'name'     => '_backendIdentity',
                'path'     => '/',
                'httpOnly' => true,
            ],
        ],
        'session' => [
            'name' => 'BACKENDSESSID',
            'cookieParams' => [
                'httpOnly' => true,
                'path'     => '/',
            ],
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
        'assetManager' => [
            'bundles' => [
                'nullref\datatable\DataTableAsset' => [
                    'depends' => [
                        'backend\assets\AppAsset'
                    ]
                ]
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<controller>/<action>?<arg:\d+>' => '<controller>/<action>',
            ],
        ],

    ],
    'params' => $params,
];
