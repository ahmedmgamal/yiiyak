<?php

namespace backend\modules\crud\models;

use Yii;
use \backend\modules\crud\models\base\Prsu as BasePrsu;
use \backend\modules\crud\traits\RmpPrsuFunctions;


/**
 * This is the model class for table "prsu".
 */
class Prsu extends BasePrsu
{


    use RmpPrsuFunctions;

    /**
     * @var UploadedFile
     */
    public $prsuFile;
    public $prsuAck;

    public function rules()
    {
        return array_merge(parent::rules(), [
            [['prsuFile'], 'file', 'skipOnEmpty' => false,'extensions' => 'doc,docx,pdf','maxSize' => 1024 * 1024 * 16],
            [['prsuAck'], 'file', 'skipOnEmpty' => true,'extensions' => 'doc,docx,pdf']
        ]);
    }

    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(),[
            'prsuFile' => Yii::t('app',' upload PRSU version')
        ]);
    }

}
