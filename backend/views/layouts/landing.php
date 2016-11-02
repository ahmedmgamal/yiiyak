<?php
/* @var $content string */

use backend\assets\LandingAsset;
use yii\helpers\Html;
LandingAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content=" pharmcoviglance (pv radar) or اليقظة الدوائية  is a website to take care of your drugs and icsr ">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,600,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', <?= \Yii::$app->params['gaId']?>, 'auto');
        ga('send', 'pageview');

    </script>
</head>

<body>

<?php $this->beginBody() ?>

<?= $content ?>
<?php if (file_exists(Yii::getAlias('@webroot').'/test-check.txt'))
{
    echo "<p>".file_get_contents(Yii::getAlias('@webroot').'/test-check.txt')."</p>";
}?>

<?php $this->endBody() ?>
<script>
    // Layer Slider
    jQuery("#layerslider").layerSlider({
        pauseOnHover: true,
        autoPlayVideos: false,
        skinsPath: 'assets/layerslider/skins/',
        responsive: false,
        responsiveUnder: 1280,
        layersContainer: 1280,
        skin: 'borderlessdark3d',
        hoverPrevNext: true,
    });

    // Parallax background
    $('.parallax-1').parallax({
        speed : 0.15
    });
</script>


</body>
</html>
<?php $this->endPage() ?>

