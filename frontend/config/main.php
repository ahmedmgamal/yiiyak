<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [

        'cms' => [
            'class' => 'yii2mod\cms\Module',
        ],
    ],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'authManager' => [
            'class' => 'yii\rbac\PhpManager',
            'defaultRoles' => ['admin', 'company'],

        ],

        'urlManager' => [

          //  'enablePrettyUrl' => true,
           // 'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii2mod\cms\components\PageUrlRule',
                    'route' => 'site',
                ],
            ],
        ],

    ],
    'params' => $params,
    'defaultRoute' => '/'
];
