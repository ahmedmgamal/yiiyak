<?php
/**
 * /var/www/html/yiiyak/console/runtime/giiant/fccccf4deb34aed738291a9c38e87215
 *
 * @package default
 */


use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/**
 *
 * @var yii\web\View $this
 * @var backend\modules\crud\models\Drug $model
 */
$this->title = Yii::t('app', 'Create');
$this->params['breadcrumbs'][] = ['label' => $model->getAliasModel(true), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="giiant-crud drug-create">

    <h1>
        <?php echo $model->getAliasModel() ?>        <small>
                    <?php echo $model->id ?>        </small>
    </h1>

    <div class="clearfix crud-navigation">
        <div class="pull-left">
            <?php echo             Html::a(
	Yii::t('app', 'Cancel'),
	\yii\helpers\Url::previous(),
	['class' => 'btn btn-default']) ?>
        </div>
    </div>

    <div class="drug-form">

        <p>Please Download this sample Excel <a href="<?php echo Url::toRoute("drug/excel-download") ?>" class="btn btn-warning glyphicon glyphicon-save"></a> file , Fill it with drugs date and upload it.</p>
<?php
echo Html::beginForm([Url::toRoute("drug/excel-upload")], 'post', ['enctype' => 'multipart/form-data']);
?>
        <div class="form-group">
            <?php echo Html::fileInput("excel",null,['accept'=>'.xls ,.xlsx']);?>
        </div>
<?php
echo Html::submitButton(
    '<span class="glyphicon glyphicon-open"></span> ' .
    Yii::t('app', 'Save'),
    [
        'id' => 'uploadFile',
        'class' => 'btn btn-success'
    ]
);

echo Html::endForm();
?>

    </div>
