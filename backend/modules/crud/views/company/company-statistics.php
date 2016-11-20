<?php
/**
 *
 * @var yii\web\View $this
 * @var backend\modules\crud\models\Company $model
 */

use yii\bootstrap\Tabs;
use yii\widgets\DetailView;

$this->title = $model->getAliasModel() . $model->name;

$this->params['breadcrumbs'][] = ['label' => $model->getAliasModel(true), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'View');
?>

<div class="giiant-crud company-statistics">
    <!-- flash message -->
    <?php if (\Yii::$app->session->getFlash('deleteError') !== null) : ?>
        <span class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <?php echo \Yii::$app->session->getFlash('deleteError') ?>
        </span>
    <?php endif; ?>

    <h1>
        <?php echo $model->getAliasModel() ?>        <small>
            <?php echo $model->name ?>        </small>
        <small class="subscriptionEnd"><?= Yii::t('app','subscription ends on ') . $model->end_date?></small>
    </h1>

    <div class="clearfix crud-navigation">
        </div>

    <?php $this->beginBlock('Users'); ?>

    <div class="tab-content"><div id="relation-tabs-tab0" class="tab-pane active">

            <table id="w0" class="table table-striped table-bordered detail-view">
                <tbody>
                <tr><th class="col-md-6"><?= Yii::t('app','Total Users')?></th><td class="col-md-6"><?= $totalUsers ?></td></tr>
                <tr><th><?= Yii::t('app','Used Users')?></th><td><?= $usedUsers?></td></tr>
                <tr><th><?= Yii::t('app','Remaining Users ')?></th><td><?= $remainingUsers?></td></tr>
                </tbody>
            </table>
        </div></div>

    <?php $this->endBlock(); ?>

    <hr/>

    <?php $this->beginBlock('Products'); ?>

    <div class="tab-content"><div id="relation-tabs-tab0" class="tab-pane active">

            <table id="w0" class="table table-striped table-bordered detail-view">
                <tbody>
                <tr><th class="col-md-6"><?= Yii::t('app','Total Products')?></th><td class="col-md-6"><?= $totalProducts ?></td></tr>
                <tr><th><?= Yii::t('app','Used Products')?></th><td><?= $usedProducts?></td></tr>
                <tr><th><?= Yii::t('app','Remaining Products ')?></th><td><?= $remainingProducts ?></td></tr>
                </tbody>
            </table>
        </div></div>

    <?php $this->endBlock(); ?>

    <?php echo Tabs::widget(
        [
            'id' => 'relation-tabs',
            'encodeLabels' => false,
            'items' => [ [
                'label'   => '<b class="">'.Yii::t('app','Users Statistics').' </b>',
                'content' => $this->blocks['Users'],
                'active'  => true,
            ] , [
                'label'   => '<b class="">'.Yii::t('app','Products Statistics').' </b>',
                'content' => $this->blocks['Products'],
                'active'  => false,
            ] ,  ]
        ]
    );
    ?>




</div>
<?php $this->registerCssFile('@web/crud/company/css/custom.css',['depends' => [\yii\bootstrap\BootstrapAsset::className()]])?>
