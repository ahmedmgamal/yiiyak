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
    public $rmpAck;

    public function rules()
    {
        return array_merge(parent::rules(), [
            [['rmpFile'], 'file', 'skipOnEmpty' => false,'extensions' => 'doc,docx,pdf','maxSize' => 1024 * 1024 * 16],
            [['rmpAck'], 'file', 'skipOnEmpty' => true,'extensions' => 'doc,docx,pdf']
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

    public function getAckUserName() {
        return $this->rmpAckUser->username;
    }


    public function uploadAck(){


        if (!isset($this->rmpAck->extension) || empty($this->rmpAck->extension))
        {
            return ['type' => 'fail' , 'message' => 'Please Upload File'];
        }


        if (!in_array($this->rmpAck->extension,['pdf','doc','docx']))
        {
            return ['type' => 'fail' , 'message' => 'Allowed Extensions pdf,doc,docx'];
        }



        $fileContent = file_get_contents($this->rmpAck->tempName);

        $bucket = \Yii::$app->fileStorage->getBucket('rmp-ack');

        $fileName = 'DrugId_'.$this->drug_id.'_'.strtotime("now").'.'.$this->rmpAck->extension;

        try{

            $bucket->saveFileContent($fileName, $fileContent);
        }
        catch(Exception $e)
        {
            return ['type' => 'fail' , 'message' => 'Can\'t Upload File Right Now'];

        }


        $fileUrl = $bucket->getFileUrl($fileName);

        $this->ack_file_url = $fileUrl;

        return ['type' => 'success'];
    }
}
