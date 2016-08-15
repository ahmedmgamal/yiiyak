<?php
namespace backend\assets;

use yii\web\AssetBundle;

class LandingAsset extends AssetBundle {


    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/site.css',
        'css/animate.min.css',
        'css/font-awesome.min.css',
        'css/ionicons.min.css',
        'css/global-style-blue.min.css',
        'css/custom-style.css',
        'css/owl.carousel.css',
        'css/owl.theme.css',
        'css/jquery.fancybox.css?v=2.1.5',
        'css/layerslider.css',
        'css/layerslider/skins/borderlessdark3d/skin.css'
    ];


    public $js = [

        'js/yak.js',
        'js/jquery-ui.min.js',
        'js/bootstrap.min.js',
        'js/tooltip.js',
        'js/bootstrap-dropdownhover.min.js',
        'js/bootstrap.slide-menu.js',
        'js/bootstrap-validator.js',
        'js/modernizr.custom.js',
        'js/jquery.mousewheel-3.0.6.pack.js',
        'js/jquery.easing.js',
        'js/classie.js',
        'js/parallax.min.js',
        'js/jquery.ui.totop.min.js',
        'js/waypoints.min.js',
        'js/sidebar-transitions.js',
        'js/jquery.smoothscroll.js',
        'js/jquery.fancybox.pack.js?v=2.1.5',
        'js/jquery.countTo.js',
        'js/jquery.easypiechart.js',
        'js/owl.carousel.min.js',
        'js/dvs.ga.js',
        'js/wow.min.js',
        'js/greensock.js',
        'js/layerslider.transitions.js',
        'js/layerslider.kreaturamedia.jquery.js',
        'js/google-maps-custom.js',
        'js/dvs.app.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}