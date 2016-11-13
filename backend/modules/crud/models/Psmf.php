<?php

namespace backend\modules\crud\models;

use Exception;
use Yii;
use \backend\modules\crud\models\base\Psmf as BasePsmf;
use yii\web\UploadedFile;
/**
 * This is the model class for table "psmf".
 */
class Psmf extends BasePsmf
{

    /**
     * @var UploadedFile
     */
    public $psmfFile;

    public function rules()
    {
        return array_merge(parent::rules(), [
            [['psmfFile'], 'file', 'skipOnEmpty' => false],
        ]);
    }

    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(),[
            'psmfFile' => Yii::t('app',' upload new PSMF version')
        ]);
    }




    public function upload()
    {

        $fileContent = file_get_contents($this->psmfFile->tempName);

        $bucket = \Yii::$app->fileStorage->getBucket('psmfFile');

        $fileName = 'CompanyId_'.$this->company_id.'_'.strtotime("now").'.'.$this->psmfFile->extension;

        try{

            $bucket->saveFileContent($fileName, $fileContent);
        }
        catch(Exception $e)
        {
            return 0;
        }


        $fileUrl = $bucket->getFileUrl($fileName);

        $this->file_url = $fileUrl;

        return 1;
    }

    public function getNewVersion()
    {
        return count(self::find()->where(['company_id' => $this->company_id])->all())+1;
    }
}
