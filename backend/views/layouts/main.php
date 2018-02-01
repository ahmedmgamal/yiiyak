<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

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
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = array();
    $adminSubMenus = [];

    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {

        if (\Yii::$app->user->can('/crud/company/index')) {
            $menuItems [] =  ['label' => 'Companies', 'url' => ['/crud/company/index']];
        }

        if (\Yii::$app->user->can('/crud/user/index')) {
            $adminSubMenus [] =  ['label' => Yii::t('app', 'Users'), 'url' => ['/crud/user/index']];
        }

        if (\Yii::$app->user->can('/crud/lkp-plan/index')){
            $menuItems[] = ['label' => 'Plans' , 'url' => ['/crud/lkp-plan/index']];
        }

        $userRole = \Yii::$app->authManager->getRolesByUser(\Yii::$app->user->id);
        if (\Yii::$app->user->can('/crud/company/statistics') && !isset($userRole['admin'])){
            $menuItems [] = ['label' => Yii::t('app','Statistics') , 'url' => ['/crud/company/statistics']];
        }

        if (\Yii::$app->user->can('/crud/psmf/index') && !isset($userRole['admin'])){
            $menuItems [] =  ['label' => 'PSMF', 'url' => ['/crud/psmf/index']];
        }

        if (\Yii::$app->user->can('/crud/drug/index') && !isset($userRole['admin'])){
            $menuItems [] =  ['label' => 'Products', 'url' => ['/crud/drug/index']];
        }
        if (\Yii::$app->user->can('/crud/reports/summary-tabulation') && !isset($userRole['admin'])){
            $menuItems [] =  [
                'label' => 'Reports',
                'items' => [
                    ['label' => 'Summary Tabulation', 'url' => '/crud/drug/summary-tabulation'],
                ]
            ];
        }

        if(!empty($adminSubMenus))
        {
            $menuItems [] = [
                'label' => Yii::t('app','admin'),
                'items' => $adminSubMenus

            ];
        }


        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link']
            )
            . Html::endForm()
            . '</li>';

        $menuItems[] = ['label' =>  Yii::$app->user->identity->getCompany()->one()->name . " (". Yii::$app->user->identity->company->plan->name . ")"];
    }
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
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; PV-RADAR <?= date('Y') ?></p>
        <?php if (file_exists(Yii::getAlias('@webroot').'/test-check.txt'))
        {
            echo "<br><p>".file_get_contents(Yii::getAlias('@webroot').'/test-check.txt')."</p>";
        }
        ?>
    </div>
</footer>

<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
