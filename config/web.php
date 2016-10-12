<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'Reports MA Esign',
    'name' => 'Reports MA Esign',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        // 'view' => [
        //     'theme' => [
        //         'pathMap' => [
        //             'class' => \yii\base\Theme::className(),
        //             '@app/views' => '@app/themes/dashgum'
        //          ],
        //      ],
        // ],
        'pdfEsign' =>[
            'class'=>'app\components\PdfEsign',
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'E2DGY70bFe1ozqjcXB95',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'showScriptName' => false,
            'enablePrettyUrl' => true,
            'rules' => array(
                '/pdf/<leadId:\d+>' => 'site/pdf',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ],        
        'db' => require(__DIR__ . '/db.php'),
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
$config['modules']['gridview']= [
  'class' => '\kartik\grid\Module'
  ];

return $config;
