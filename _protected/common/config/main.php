<?php
return [
    'name' => 'My Company',
    //'language' => 'sr',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
	'bootstrap' => [
		'log',
		'common\config\settings',
    ],
    'components' => [
        'assetManager' => [
            'bundles' => [
                // we will use bootstrap css from our theme
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [], // do not use yii default one
                ],
                // // use bootstrap js from CDN
                // 'yii\bootstrap\BootstrapPluginAsset' => [
                //     'sourcePath' => null,   // do not use file from our server
                //     'js' => [
                //         'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js']
                // ],
                // // use jquery from CDN
                // 'yii\web\JqueryAsset' => [
                //     'sourcePath' => null,   // do not use file from our server
                //     'js' => [
                //         'ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js',
                //     ]
                // ],
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,	
		],			
        'session' => [
            'class' => 'yii\web\DbSession',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/translations',
                    'sourceLanguage' => 'en',
                ],
                'yii' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/translations',
                    'sourceLanguage' => 'en'
                ],
            ],
        ],

    ], // components
	'modules' => [
		'redactor' => [
            'class' => 'yii\redactor\RedactorModule',
            'uploadDir' => '@webroot/uploads/images',
            'uploadUrl' => '@web/uploads/images',
            'imageAllowExtensions'=>['jpg','png','gif']
        ],		
	],
    // set allias for our uploads folder so it can be shared by both frontend and backend applications
    // @appRoot alias is definded in common/config/bootstrap.php file
    'aliases' => [
        '@uploads' => '@appRoot/uploads'
    ],
];
