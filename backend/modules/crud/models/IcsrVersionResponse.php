<?php

namespace backend\modules\crud\models;

use Exception;
use Yii;
use \backend\modules\crud\models\base\IcsrVersionResponse as BaseIcsrVersionResponse;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\web\UploadedFile;
/**
 * This is the model class for table "icsr_version_response".
 */
class IcsrVersionResponse extends BaseIcsrVersionResponse
{

    /**
     * @var UploadedFile
     */
    public $xmlFile;

    public function rules()
    {
        return array_merge(parent::rules(), [
            [['xmlFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'xml'],
        ]);
    }

    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(),[
            'xmlFile' => 'Response'
        ]);
    }


    public function behaviors()
    {

        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'response_date',
                'updatedAtAttribute' => false,
                'value' => new Expression('NOW()'),
            ],
        ];
    }


    public function upload()
    {

        $fileContent = file_get_contents($this->xmlFile->tempName);

        $bucket = \Yii::$app->fileStorage->getBucket('icsrVersionsResponse');

        $fileName = 'IcsrResponse_IcsrVersionId'.$this->icsr_version_id.'_'.strtotime("now").'.xml';

        try{

            $bucket->saveFileContent($fileName, $fileContent);
        }
        catch(Exception $e)
        {
            return 0;
        }


        $fileUrl = $bucket->getFileUrl($fileName);

        $this->response = $fileUrl;
        $this->xmlFile = '';
        return 1;


    }
}
