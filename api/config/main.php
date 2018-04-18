<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'api\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'audit' => [
            'class' => 'bedezign\yii2\audit\Audit',
            'ignoreActions' => ['debug/*']
        ]
    ],
    'components' => [
        /* 'request' => [
             'csrfParam' => '_csrf-backend',
         ], */
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'response' => [
            'format' => yii\web\Response::FORMAT_JSON,
            'charset' => 'UTF-8',
            // ...
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'register'=>'site/register',
                'authorize'=>'site/authorize',
                'accesstoken'=>'site/accesstoken',
                'me'=>'site/me',
                'logout'=>'site/logout',

                /*end points */
                'companydrugs/<id>'=>'company/view',
                'icsrs/<id>'=>'drug/view',
                'editicsr/<id>'=>'icsr/update',
                'countries'=>'country/index',
                'EventOutcomeList'=>'lkp-icsr-eventoutcome/index',
                'drugactionList'=>'lkp-drug-action/index',
                'MeddreaLLtList'=>'lkp-meddra-llt/index',
                'MeddreaPtList'=>'lkp-meddra-pt/index',
                'drugRoleList'=>'lkp-drug-role/index',
                'EventList/<id>'=>'icsr-event-outcome/view',
                'occupationList'=>'lkp-occupation/index',
                'reporttypeslist'=>'lkp-icsr-type/index',
                'saveStorageData'=>'icsr/save-storage-data',
                'saveicsr'=>'icsr/create',
                'addIcsrEvent'=>'icsr-event/create',
                'savereporter'=>'icsr-reporter/create',
                'saveTest'=>'icsr-test/create',
                'saveprescription'=>'drug-prescription/create',

                '1/employees/delete/<id>'=>'employee/delete',


                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                '<module:\w+>/<controller:\w+>/<id:\d+>' => '<module>/<controller>/view',
                '<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<module>/<controller>/<action>',
                // '<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
                '1/employees/create'=>'employee/create',
            ],

        ],


        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => 'employee'],
            ],
        ],
        */


        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */

    ],
    'params' => $params,
];
