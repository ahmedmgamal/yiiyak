<?php
/**
 * /var/www/html/yiiyak/console/runtime/giiant/4b7e79a8340461fe629a6ac612644d03
 *
 * @package default
 */


use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \dmstr\bootstrap\Tabs;

/**
 *
 * @var yii\web\View $this
 * @var backend\modules\crud\models\Drug $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="meddra-form">

    <?php $form = ActiveForm::begin([
            'id' => 'Meddra',
            'layout' => 'horizontal',
            'enableClientValidation' => true,
            'errorSummaryCssClass' => 'error-summary alert alert-error',
            'options' => ['enctype' => 'multipart/form-data']
        ]
    );
    ?>

    <div class="">
        <?php $this->beginBlock('main'); ?>

        <p>

        <div class="form-group">
            <label class="control-label col-sm-3" for="meddra-hlgt">hlgt.asc</label>
            <div class="col-sm-6">
               <input type="file" id="meddra-hlgt" name="Meddra[hlgt]" >
            </div>
            <div class="help-block col-sm-3"><?= Yii::t('app','High Level Group Term ')?></div>

        </div>
        <hr>
        <div class="form-group">
            <label class="control-label col-sm-3" for="meddra-hlgt_hlt">hlgt_hlt.asc</label>
            <div class="col-sm-6">
                <input type="file" id="meddra-hlgt_hlt" name="Meddra[hlgt_hlt]" >
            </div>
            <div class="help-block col-sm-3"><?= Yii::t('app','High Level Group Term _ High Level Term ')?></div>

        </div>
        <hr>

        <div class="form-group">
            <label class="control-label col-sm-3" for="meddra-hlt">hlt.asc</label>
            <div class="col-sm-6">
                <input type="file" id="meddra-hlt" name="Meddra[hlt]" >
            </div>
            <div class="help-block col-sm-3"><?= Yii::t('app','High Level Term ')?></div>

        </div>

        <hr>

        <div class="form-group">
            <label class="control-label col-sm-3" for="meddra-hlt_pt">hlt_pt.asc</label>
            <div class="col-sm-6">
                <input type="file" id="meddra-hlt_pt" name="Meddra[hlt_pt]" >
            </div>
            <div class="help-block col-sm-3"><?= Yii::t('app','High Level Term _ Preferred Term ')?></div>

        </div>

        <hr>

        <div class="form-group">
            <label class="control-label col-sm-3" for="meddra-intl_ord">intl_ord.asc</label>
            <div class="col-sm-6">
                <input type="file" id="meddra-intl_ord" name="Meddra[intl_ord]" >
            </div>
            <div class="help-block col-sm-3"><?= Yii::t('app','Intl Order ')?></div>

        </div>

        <hr>

        <div class="form-group">
            <label class="control-label col-sm-3" for="meddra-llt">llt.asc</label>
            <div class="col-sm-6">
                <input type="file" id="meddra-llt" name="Meddra[llt]" >
            </div>
            <div class="help-block col-sm-3"><?= Yii::t('app','Lowest Level Term')?></div>

        </div>

        <hr>

        <div class="form-group">
            <label class="control-label col-sm-3" for="meddra-mdhier">mdhier.asc</label>
            <div class="col-sm-6">
                <input type="file" id="meddra-mdhier" name="Meddra[mdhier]" >
            </div>
            <div class="help-block col-sm-3"><?= Yii::t('app','Meddra Hierarchy')?></div>

        </div>

        <hr>

        <div class="form-group">
            <label class="control-label col-sm-3" for="meddra-pt">pt.asc</label>
            <div class="col-sm-6">
                <input type="file" id="meddra-pt" name="Meddra[pt]" >
            </div>
            <div class="help-block col-sm-3"><?= Yii::t('app','Prefered Term')?></div>

        </div>

        <hr>

        <div class="form-group">
            <label class="control-label col-sm-3" for="meddra-SMQ_Content">smq_content.asc</label>
            <div class="col-sm-6">
                <input type="file" id="meddra-SMQ_Content" name="Meddra[SMQ_Content]" >
            </div>
            <div class="help-block col-sm-3"><?= Yii::t('app','Standard Media Query Content')?></div>

        </div>

        <hr>

        <div class="form-group">
            <label class="control-label col-sm-3" for="meddra-SMQ_List">smq_list.asc</label>
            <div class="col-sm-6">
                <input type="file" id="meddra-SMQ_List" name="Meddra[SMQ_List]" >
            </div>
            <div class="help-block col-sm-3"><?= Yii::t('app','Standard Media Query List')?></div>

        </div>

        <hr>

        <div class="form-group">
            <label class="control-label col-sm-3" for="meddra-soc">soc.asc</label>
            <div class="col-sm-6">
                <input type="file" id="meddra-soc" name="Meddra[soc]" >
            </div>
            <div class="help-block col-sm-3"><?= Yii::t('app','System Organ Class')?></div>

        </div>

        <hr>

        <div class="form-group">
            <label class="control-label col-sm-3" for="meddra-soc_hlgt">soc_hlgt.asc</label>
            <div class="col-sm-6">
                <input type="file" id="meddra-soc_hlgt" name="Meddra[soc_hlgt]" >
            </div>
            <div class="help-block col-sm-3"><?= Yii::t('app','System Organ Class _ High Level Group')?></div>

        </div>
        </p>
        <?php $this->endBlock(); ?>

        <?php echo
        Tabs::widget(
            [
                'encodeLabels' => false,
                'items' => [ [
                    'label'   => Yii::t('app','Upload Meddra'),
                    'content' => $this->blocks['main'],
                    'active'  => true,
                ], ]
            ]
        );
        ?>
        <hr/>



        <?php echo Html::submitButton(
            '<span class="glyphicon glyphicon-check"></span> ' .
             Yii::t('app', 'Upload All')  ,
            [

                'class' => 'btn btn-success'
            ]
        );
        ?>

        <?php ActiveForm::end(); ?>

    </div>

</div>
