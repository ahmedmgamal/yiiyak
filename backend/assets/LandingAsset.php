<?php
namespace backend\assets;

use yii\web\AssetBundle;

class LandingAsset extends AssetBundle {


    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/font-awesome.min.css',
        'css/global-style-blue.min.css',
        'css/owl.carousel.css',
        'css/layerslider.css',
    ];


    public $js = [
       'js/jquery-ui.min.js',
        'js/bootstrap.min.js',
        'js/parallax.min.js',
       'js/jquery.ui.totop.min.js',
        'js/jquery.fancybox.pack.js?v=2.1.5',
        'js/jquery.countTo.js',
        'js/owl.carousel.min.js',
        'js/greensock.js',
        'js/layerslider.kreaturamedia.jquery.js',
        'js/google-maps-custom.js',
        'js/dvs.app.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}