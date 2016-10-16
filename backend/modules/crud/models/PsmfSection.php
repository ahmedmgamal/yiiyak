<?php

namespace backend\modules\crud\models;

use Exception;
use Yii;
use \backend\modules\crud\models\base\PsmfSection as BasePsmfSection;
use yii\web\UploadedFile;

/**
 * This is the model class for table "psmf_section".
 */
class PsmfSection extends BasePsmfSection
{

    /**
     * @var UploadedFile[]
     */
    public $imageFiles;

    public function rules()
    {
        return array_merge(parent::rules(),[
            [['imageFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg,jpeg' , 'maxFiles' => 0 ],
        ]);

    }

    public function upload()
    {
        $imagesUrls = [];
        $bucket = \Yii::$app->fileStorage->getBucket('psmfImages');
        foreach ($this->imageFiles as $file)
        {
            $fileName = 'psmf_PsmfId'.$this->psmf_id.'_randTime'.strtotime("now").'_randNum_'.rand().'.'.$file->extension;
            try{

                $bucket->copyFileIn($file->tempName,$fileName);
                $imagesUrls[] = $bucket->getFileUrl($fileName);
            }
            catch(Exception $e)
            {
                return 0;
            }
        }
        $this->section_content = json_encode($imagesUrls);
        return 1;

    }
}
