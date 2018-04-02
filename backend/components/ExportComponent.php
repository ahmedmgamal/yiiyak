<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 4/2/2018
 * Time: 1:09 AM
 */

namespace backend\components;
use Yii;
use yii\base\Component;
use yii\helpers\VarDumper;

class ExportComponent extends Component
{
        public function export($id){
            Yii::$app->getModule('crud')
                ->runAction('icsr/export', ['id'=>$id, 'case'=>'normal', 'api'=>1]);
        }
}