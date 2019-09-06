<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);


use \yii\web\Request;
//$baseUrl2=str_replace('/frontend', '', (new Request)->getBaseUrl());

$baseUrl=(new Request)->getBaseUrl();

//echo $baseUrl2;

return [
    'id' => 'app-frontend',
    'name'=>'Cats Support',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'parsers' => [
                  'application/json' => 'yii\web\JsonParser',
             ],
             'enableCookieValidation'=>false,
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
            'enableSession'=>false,
            'loginUrl'=>null,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
        'urlManager' => [
            'baseUrl'=>$baseUrl,
            'enablePrettyUrl' => true,
            //'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => 'auth'],
            ],
        ]
    ],

    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
        ],

        'staff' => [
            'class' => 'app\modules\staff\Module',
        ],

        'customer' => [
            'class' => 'app\modules\customer\Module',
        ],
        'utilities' => [
            'class' => 'app\modules\utilities\Module',
        ],
    ],
    'params' => $params,
];
