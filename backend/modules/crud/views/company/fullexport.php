<?php
/**
 * /var/www/html/yiiyak/console/runtime/giiant/a0a12d1bd32eaeeb8b2cff56d511aa22
 *
 * @package default
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/**
 *
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var backend\modules\crud\models\search\Drug $searchModel
 * @var $signaledDrugs
 */

?>
    <div>
        <h2>
            <?php echo Yii::t('app','Generate Full Export'); ?> <a href="export-history" class="btn btn-success"><span class="glyphicon glyphicon-export"></span></a>
        </h2>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading"><?php echo Yii::t('app','Exports History'); ?></div>
        <div class="panel-body">
            <div class="table-responsive">
                <?php echo GridView::widget([
                    'layout' => '{summary}{pager}{items}{pager}',
                    'dataProvider' => $provider,
                    'pager' => [
                        'class' => yii\widgets\LinkPager::className(),
                        'firstPageLabel' => Yii::t('app', 'First'),
                        'lastPageLabel' => Yii::t('app', 'Last')        ],
                    'tableOptions' => ['class' => 'table table-striped table-bordered table-hover'],
                    'headerRowOptions' => ['class'=>'x'],
                    'columns' => [
                        'username',
                        'creation_date',
                        'file_size',
                        'drugs_number',
                        'icsrs_number',
                        [
                            'label'=>"File Download",
                            'format'=>'html',
                            'value'=>function($data){
                                return "<a href='{$data['file_path']}' download='{$data['file_path']}' class='btn btn-warning'><span class='glyphicon glyphicon-save'></span></a>";
                            }
                        ]
                    ],
                ]); ?>
            </div>
        </div>
    </div>


<?php $this->registerCssFile('@web/crud/global/global.css');?>