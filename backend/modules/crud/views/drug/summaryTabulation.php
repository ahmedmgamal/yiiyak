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

    <div class="giiant-crud drug-index">

        <?php //             echo $this->render('_search', ['model' =>$searchModel]);
        ?>
        <div>
            <h2 class="text-center">
                <?php echo Yii::t('app','Numbers of adverse drug reactions by term from post-marketing sources including counts in bracket') ?>
            </h2>
            <h3 >
                <?php
                if($drug != null){
                    echo Yii::t('app','Drug') . ' ' . $drug->generic_name;
                }
                ?>
            </h3>

        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th colspan="2"></th>
                    <th colspan="6">Spontaneous, Including regularity Authority and Literature </th>
                    <th colspan="6">Non-interventional post-marketing study </th>
                    <th colspan="2">Total</th>
                </tr>
                <tr>
                    <th colspan="2"></th>
                    <th colspan="2">Serious</th>
                    <th colspan="2">non-Serious</th>
                    <th colspan="2">not-assessed</th>

                    <th colspan="2">Serious</th>
                    <th colspan="2">non-Serious</th>
                    <th colspan="2">not-assessed</th>

                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>
                <tr>
                    <th>SOC <br/> (abbr)</th>
                    <th class="text-center">Preferred Item</th>

                    <th class="text-center">Interval</th>
                    <th class="text-center">Cum.</th>

                    <th class="text-center">Interval</th>
                    <th class="text-center">Cum.</th>

                    <th class="text-center">Interval</th>
                    <th class="text-center">Cum.</th>

                    <th class="text-center">Interval</th>
                    <th class="text-center">Cum.</th>

                    <th class="text-center">Interval</th>
                    <th class="text-center">Cum.</th>

                    <th class="text-center">Interval</th>
                    <th class="text-center">Cum.</th>

                    <th class="text-center">Interval all</th>
                    <th class="text-center">Cum. all</th>
                </tr>
            </thead>
            <tbody>
                <?php if(count($summary) > 0){ ?>
                        <?php foreach ($summary as $key=>$item){ ?>
                        <tr>
                            <td></td>
                            <td class="text-center"><?php echo $key; ?></td>

                            <td class="text-center"><?php  echo $item['Serious']?></td>
                            <td class="text-center">0</td>

                            <td class="text-center"><?php  echo $item['notSerious']?></td>
                            <td class="text-center">0</td>

                            <td class="text-center">0</td>
                            <td class="text-center">0</td>

                            <td class="text-center">0</td>
                            <td class="text-center">0</td>

                            <td class="text-center">0</td>
                            <td class="text-center">0</td>

                            <td class="text-center">0</td>
                            <td class="text-center">0</td>

                            <td class="text-center"><?php  echo ($item['Serious'] + $item['notSerious']);?></td>
                            <td class="text-center">0</td>
                        </tr>

                        <?php } // End Foreach?>

                    <?php }else{
                        echo "<tr> <td class='text-center' colspan='16'>No data to Display</td></tr>";
                    } ?>
            </tbody>
        </table>
    </div>






<?php $this->registerCssFile('@web/crud/global/global.css');?>