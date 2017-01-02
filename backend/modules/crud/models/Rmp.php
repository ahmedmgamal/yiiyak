<?php

namespace backend\modules\crud\models;

use Yii;
use \backend\modules\crud\models\base\Rmp as BaseRmp;
use \backend\modules\crud\traits\RmpPrsuFunctions;


/**
 * This is the model class for table "rmp".
 */
class Rmp extends BaseRmp
{
    use RmpPrsuFunctions;

    /**
     * @var UploadedFile
     */
    public $rmpFile;
    public $rmpAck;

    public function rules()
    {
        return array_merge(parent::rules(), [
            [['rmpFile',],'required','on'=>['create']],

            [['rmpFile'], 'file' ,'extensions' => 'doc,docx,pdf','maxSize' => 1024 * 1024 * 16 ],
            [['rmpAck'], 'file', 'skipOnEmpty' => true,'extensions' => 'doc,docx,pdf'],
        ]);
    }

    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(),[
            'rmpFile' => Yii::t('app',' upload RMP version')
        ]);
    }



}
