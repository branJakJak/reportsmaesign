<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'Reports MA Esign',
    'name' => 'MoneyActive',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerMap' => [
        'ppi-lead' => 'app\controllers\PPILeadController',
    ],
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['normal_user'],
        ],
        'pdfEsign' =>[
            'class'=>'app\components\PdfEsign',
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'E2DGY70bFe1ozqjcXB95',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]            
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\AccountUser',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
        ],
        'log' => [
            // 'traceLevel' => YII_DEBUG ? 3 : 0,
            'traceLevel' => 3,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            // 'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => array(
                // ['class' => 'yii\rest\UrlRule', 'controller' => 'api/v1/pba','pluralize' => false],
                // ['class' => 'yii\rest\UrlRule', 'controller' => 'ppi-lead','pluralize' => false],
                '/export/ppi/<securityKey:\w+>' => 'export/ppi',
                '/export/pba/<securityKey:\w+>' => 'export/pba',                
                'POST /api/v1/pba/<action:\w+>' => 'api/pba/<action>',
                'POST /api/v1/pba/non-affiliate' => 'api/pba/non-affiliate',
                'POST /api/v1/ppi/<action:\w+>' => 'api/ppi/<action>',
                'POST /api/v1/ppi/non-affiliate' => 'api/ppi/non-affiliate',
                '/success' => 'site/success',
                '/signature/ppi/<securityKey:\w+>' => 'signature/ppi',
                '/signature/pba/<securityKey:\w+>' => 'signature/pba',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ],        
        'db' => require(__DIR__ . '/db.php'),
    ],
    'modules' => [
        'api' => [
            'class' => 'app\modules\api\v1',
        ],
        'gridview' => [
          'class' => '\kartik\grid\Module'
        ],
    ],    
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}


return $config;
