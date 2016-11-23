<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

$config = [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'audit' => [
            'class' => 'bedezign\yii2\audit\Audit',
            'ignoreActions' => ['debug/*']
        ],

        'crud' => [
            'class' => 'backend\modules\crud\Module',
        ],
 	'admin' => [
            'class' => 'mdm\admin\Module',
            'layout' => 'left-menu',
        'as access'=>[
            'class'=>'yii\filters\AccessControl',
            'rules' => [
                [

                    'allow' => true,
                    'actions' => ['index','view','create','store','update','edit','assign','remove'],
                    'roles' => ['admin'],
                ]
            ],
        ],
        ]

    ],

    'components' => [


        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@app/mail',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'yiiyaktest@gmail.com',
                'password' => 'opensource',
                'port' => '587',
                'encryption' => 'tls',
            ],
        ],
        'user' => [
            'identityClass' => 'backend\modules\crud\models\User',
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
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['normalUser'],
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            // Hide index.php
            'showScriptName' => false,
            // Use pretty URLs
            'enablePrettyUrl' => true,
            'rules' => [
                [
                    'pattern' => 'crud/icsr/export',
                    'route' => 'crud/icsr/export',
                    'suffix' => '.xml',
                ],
            ],
        ],

    ],
    'params' => $params,
    'defaultRoute' => 'site/landing'
];

if (YII_ENV_DEV)
{
    $config['components'][ 'fileStorage'] =

       [
            'class' => 'yii2tech\filestorage\local\Storage',
            'basePath' => '@webroot/files',
            'baseUrl' => '@web/files',
            'filePermission' => 0777,
            'buckets' => [
                'meddra-files' => [
                    'baseSubPath' => 'MeddrFiles',
                ],
                'icsrVersions' => [
                 'baseSubPath' => 'icsrsVersions',
                                ],
                'icsrVersionsResponse' => [
                    'baseSubPath' =>'icsrsVersionsReponse'
                ],
                'psmfImages' => [
                    'baseSubPath' => 'psmfImages'
                ],
                'psmfHtml' => [
                    'baseSubPath' => 'psmfHtml'
                ],
                'psmfFile' => [
                    'baseSubPath' => 'psmfFiles'
                ],
                ]
            ];


}
else{
    $config['components'][ 'fileStorage'] =

        [
            'class' => 'yii2tech\filestorage\local\Storage',
            'basePath' => '@webroot/files',
            'baseUrl' => '@web/files',
            'filePermission' => 0777,
            'buckets' => [
                'icsrVersions' => [
                    'baseSubPath' => 'icsrsVersions',
                ],
                'icsrVersionsResponse' => [
                    'baseSubPath' =>'icsrsVersionsReponse'
                ],
                'psmfImages' => [
                    'baseSubPath' => 'psmfImages'
                ],
                'psmfHtml' => [
                    'baseSubPath' => 'psmfHtml'
                ],
                'psmfFile' => [
                    'baseSubPath' => 'psmfFiles'
                ],
            ]
        ];
}
return $config;