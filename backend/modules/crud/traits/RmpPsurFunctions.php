<?php
namespace backend\modules\crud\traits;

use yii\helpers\StringHelper;

// to use this trait you must define the following

/*
 *  two properties of upload files Ex ( $rmpFile, $rmpAck)
 *
 *  two buckets with this name for Ex (rmp , rmp-ack)
 *
 * also make sure that the name of upload fields are the same like for Ex (ack_file_url , rmp_file_url)
 *
 * one more thing define the relations of each Base Model to each related user (getRmpUser,getRmpAckUser)
 */



trait RmpPsurFunctions {


    public function uploadReport()
    {

        $modelName = strtoLower(StringHelper::basename(get_class($this)));

        $modelFileProperty = $modelName.'File';

        $modelFileUrl = $modelName.'_file_url';

        $fileContent = file_get_contents($this->$modelFileProperty->tempName);

        $bucket = \Yii::$app->fileStorage->getBucket($modelName);

        $fileName = 'DrugId_'.$this->drug_id.'_'.strtotime("now").'.'.$this->$modelFileProperty->extension;

        try{

            $bucket->saveFileContent($fileName, $fileContent);
        }
        catch(Exception $e)
        {
            return 0;
        }


        $fileUrl = $bucket->getFileUrl($fileName);

        $this->$modelFileUrl = $fileUrl;

        return 1;
    }



    public function uploadAck()

    {

        $modelName = strtoLower(StringHelper::basename(get_class($this)));

        $modelFileProperty = $modelName.'Ack';



        if (!isset($this->$modelFileProperty->extension) || empty($this->$modelFileProperty->extension))
        {
            return ['type' => 'fail' , 'message' => 'Please Upload File'];
        }


        if (!in_array($this->$modelFileProperty->extension,['pdf','doc','docx']))
        {
            return ['type' => 'fail' , 'message' => 'Allowed Extensions pdf,doc,docx'];
        }



        $fileContent = file_get_contents($this->$modelFileProperty->tempName);

        $bucket = \Yii::$app->fileStorage->getBucket($modelName.'-ack');

        $fileName = 'DrugId_'.$this->drug_id.'_'.strtotime("now").'.'.$this->$modelFileProperty->extension;

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



    public function getReportUserName() {
        $modelName = strtoLower(StringHelper::basename(get_class($this)));
        $modelName .= 'User';
        return $this->$modelName->username;
    }


    public function getAckUserName() {
        $modelName = strtoLower(StringHelper::basename(get_class($this)));
        $modelName .= 'AckUser';
        return $this->$modelName->username;
    }

}