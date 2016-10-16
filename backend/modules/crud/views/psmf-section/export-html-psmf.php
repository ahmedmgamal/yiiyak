<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\widgets\DetailView;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
<title><?= Html::encode($this->title) ?></title>
<?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'PV-RADAR',
        'brandUrl' => null,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = array();

        $menuItems[] = ['label' =>  Yii::$app->user->identity->getCompany()->one()->name . " (". Yii::$app->user->identity->company->plan->name . ")"];

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>

        <h1>
            <?php echo $psmfCompanyModel->company->name;?>     <?= Yii::t('app', 'Psmf ') ?>      <small>
            </small>
        </h1>

        <hr>
        <?php foreach ($psmfCompanyModel->psmfSections as $key => $section){

            if ($section->section_name != 'images_url')
            {
         ?>
        <ul class="nav nav-tabs">
            <li role="presentation" class="active"><a href="#"># <?php echo ++$key;?></a></li>
        </ul>
        <?= DetailView::widget([
            'model' => $section,
            'attributes' => [
                'section_name',
                'section_content:ntext',
            ],
        ]); ?>
                <hr>
        <?php }
        else
            {
            $imageUrls = $section->section_content;
        }

                } ?>

        <ul class="nav nav-tabs">
            <li role="presentation" class="active"><a href="#"># <?php echo Yii::t('app','Company Images');?></a></li>
        </ul>
        <div class="row">
            <?php if (isset($imageUrls))
            {
                $imageUrls = json_decode($imageUrls);

                foreach ($imageUrls as $key => $url){
                ?>

            <div class=" col-md-12">
                <a href="#" class="thumbnail">
                    <img src="<?php echo $url; ?>" alt="company image">
                </a>
            </div>
            <?php }} ?>
        </div>

    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; PV-RADAR <?= date('Y') ?></p>

    </div>
</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
