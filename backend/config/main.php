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

//        'cms' => [
//            'class' => 'yii2mod\cms\Module',
//        ],

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
        'helpers' => [
            'class' => 'backend\components\HelpersComponent',
        ],

        'response' => [
            'formatters' => [
                'pdf' => [
                    'class' => 'robregonm\pdf\PdfResponseFormatter',
                    'format' => 'A4',  // Optional but recommended. http://mpdf1.com/manual/index.php?tid=184
                    'defaultFontSize' => 0, // Optional
                    'defaultFont' => '', // Optional
                    'marginLeft' => 15, // Optional
                    'marginRight' => 15, // Optional
                    'marginTop' => 16, // Optional
                    'marginBottom' => 16, // Optional
                    'marginHeader' => 9, // Optional
                    'marginFooter' => 9, // Optional
                    'orientation' => 'Landscape',
                ],
            ]
        ],

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
            'defaultRoles' => ['Qppv Deputy'],
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            // Hide index.php
            'showScriptName' => false,
            // Use pretty URLs
            'enablePrettyUrl' => true,
            'rules' => [
                [
                    
                  //  'class' => 'yii2mod\cms\components\PageUrlRule',
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
                'prsu-ack' => [
                    'baseSubPath' => 'prsuAckFiles'
                ],
                'prsu' => [
                    'baseSubPath' => 'prsuFiles'
                ],
                'rmp-ack' => [
                    'baseSubPath' => 'rmpAckFiles'
                ],
                'rmp' => [
                  'baseSubPath' => 'rmpFiles'
                ],
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
                "icsrTestImage"=>[
                    "baseSubPath"=>"icsrTestImages"
                ]
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
                'prsu-ack' => [
                    'baseSubPath' => 'prsuAckFiles'
                ],
                'prsu' => [
                    'baseSubPath' => 'prsuFiles'
                ],
                'rmp-ack' => [
                    'baseSubPath' => 'rmpAckFiles'
                ],
                'rmp' => [
                  'baseSubPath' => 'rmpFiles'
                ],
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
                "icsrTestImage"=>[
                    "baseSubPath"=>"icsrTestImages"
                ]
            ]
        ];
}
return $config;