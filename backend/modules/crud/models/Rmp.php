<?php

namespace backend\modules\crud\models;

use Yii;
use \backend\modules\crud\models\base\Rmp as BaseRmp;

/**
 * This is the model class for table "rmp".
 */
class Rmp extends BaseRmp
{

    /**
     * @var UploadedFile
     */
    public $rmpFile;

    public function rules()
    {
        return array_merge(parent::rules(), [
            [['rmpFile'], 'file', 'skipOnEmpty' => false,'extensions' => 'doc,docx,pdf'],
        ]);
    }

    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(),[
            'rmpFile' => Yii::t('app',' upload RMP version')
        ]);
    }

    public function uploadRmp()
    {

        $fileContent = file_get_contents($this->rmpFile->tempName);

        $bucket = \Yii::$app->fileStorage->getBucket('rmp');

        $fileName = 'DrugId_'.$this->drug_id.'_'.strtotime("now").'.'.$this->rmpFile->extension;

        try{

            $bucket->saveFileContent($fileName, $fileContent);
        }
        catch(Exception $e)
        {
            return 0;
        }


        $fileUrl = $bucket->getFileUrl($fileName);

        $this->rmp_file_url = $fileUrl;

        return 1;
    }

    public function getRmpUserName() {

        return $this->rmpUser->username;
    }
}
