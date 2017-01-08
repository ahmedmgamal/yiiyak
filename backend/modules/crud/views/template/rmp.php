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
        <div>
            <p>
                Please Download Risk Management Plan (RMP) Template from <a href="<?php echo Url::toRoute("template/rmp-download") ?>" class="btn btn-warning glyphicon glyphicon-save"></a>
            </p>
        </div>
    </div>






<?php $this->registerCssFile('@web/crud/global/global.css');?>