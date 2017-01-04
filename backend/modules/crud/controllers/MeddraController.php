<?php

namespace backend\modules\crud\controllers;

use Exception;
use Yii;

class MeddraController extends \yii\web\Controller
{
    private  $MEDDRA_FILES = [   'hlgt' => 'hlgt.asc',
                                 'hlgt_hlt' => 'hlgt_hlt.asc',
                                 'hlt' =>'hlt.asc',
                                 'hlt_pt' => 'hlt_pt.asc',
                                 'intl_ord' => 'intl_ord.asc',
                                 'llt' => 'llt.asc',
                                 'mdhier' => 'mdhier.asc',
                                 'pt' => 'pt.asc',
                                 'SMQ_Content' => 'smq_content.asc',
                                 'SMQ_List' => 'smq_list.asc',
                                 'soc' => 'soc.asc',
                                 'soc_hlgt' =>'soc_hlgt.asc'
                                ];

    private  $MEDDRA_MODELS = [   'hlgt' => 'MeddraHlgt',
                                 'hlgt_hlt' =>  'MeddraHlgtHlt',
                                 'hlt' =>'MeddraHlt',
                                 'hlt_pt' => 'MeddraHltPt',
                                 'intl_ord' => 'MeddraIntlOrd',
                                 'llt' => 'MeddraLlt',
                                 'mdhier' => 'MeddraMdhier',
                                 'pt' => 'MeddraPt',
                                 'SMQ_Content' => 'MeddraSmqContent',
                                 'SMQ_List' => 'MeddraSmqList',
                                 'soc' => 'MeddraSoc',
                                 'soc_hlgt' =>'MeddraSocHlgt'
                            ];




    public function actionCreate()
    {
        ini_set('max_execution_time', 2000);
        ini_set('memory_limit',-1);

        if (Yii::$app->request->isPost)
            {
                $message = $this->checkFiles($_FILES['Meddra']);
                if ($message['status'] == 'failed')
                {
                    \Yii::$app->getSession()->setFlash('error', \Yii::t('app',$message['message']));
                    return $this->redirect(['create']);
                }
                $connection = \Yii::$app->db;
                $transaction = $connection->beginTransaction();

                 $saveUploadedFiles =$this->saveUploadedFiles($_FILES['Meddra']);

                if ($saveUploadedFiles['status'] == 'failed')
                {
                    $transaction->rollBack();
                    \Yii::$app->getSession()->setFlash('error', \Yii::t('app',$saveUploadedFiles['message']));
                }

                if ($saveUploadedFiles['status'] == 'success')
                {
                    $transaction->commit();
                    \Yii::$app->getSession()->setFlash('success', \Yii::t('app',$saveUploadedFiles['message']));
                }

                return $this->redirect(['create']);
            }


        return $this->render('create');
    }

    private function checkFiles ($meddraFiles)
    {
        $message = [];
        foreach ($meddraFiles['name'] as $key => $value )
        {
            $fileExtension = pathinfo($value, PATHINFO_EXTENSION);
            if (!isset($value) || empty($value))
            {
                $message ['status'] = 'failed';
                $message ['message'] = Yii::t('app','Please Upload File With Name "'.$this->MEDDRA_FILES[$key].'" ');
                return $message;
            }
            if ($this->MEDDRA_FILES[$key] != $value)
            {
                $message ['status'] = 'failed';
                $message ['message'] = Yii::t('app','File "'.$value .'" Must Be Named "' . $this->MEDDRA_FILES[$key].'"');
                return $message;
            }
            if ($fileExtension != 'asc')
            {
                $message ['status'] = 'failed';
                $message ['message'] = Yii::t('app','File "'.$value.'" Must Have Extension .asc');
                return $message;
            }

        }
       return ['status' => 'success'];
    }


    private function saveUploadedFiles ($meddraFiles)
    {
        $bucket = Yii::$app->fileStorage->getBucket('meddra-files');

        foreach ($meddraFiles['tmp_name'] as $key => $value)
        {
            try {
                $fileName = $key . '_' . strtotime("now") . '.asci';
                $bucket->copyFileIn($value, $fileName) ;

                $modelClassName =  '\backend\modules\crud\models\\'.$this->MEDDRA_MODELS[$key];

                $handle = fopen(Yii::getAlias('@webroot')."/files/MeddrFiles/".$fileName, "r") or die("Couldn't get handle");
                $rows = [];
                $rowCount = 0;
                $model = new $modelClassName;
                Yii::$app->db->createCommand()->truncateTable($model->tableName())->execute();

                if ($handle) {
                    while (!feof($handle)) {
                        $rowCount ++;
                        if ($rowCount >= 600)
                        {
                            Yii::$app->db->createCommand()->batchInsert($model->tableName(), $model->attributes(), $rows)->execute();
                            $rowCount = 0;
                            $rows = [];
                        }
                        $buffer = fgets($handle);
                        $row = str_getcsv($buffer, '$');
                       //last key in the array is always empty so need to get poped out
                        array_pop($row);
                        $rows []= $row;
                     }
                    fclose($handle);
                }
                //last line in meddra files always empty so it needs to get poped
                array_pop($rows);

                $model = new $modelClassName;

                Yii::$app->db->createCommand()->batchInsert($model->tableName(),$model->attributes(),$rows)->execute();

            }

            catch (Exception $e)
            {
                return ['status' => 'failed' , 'message' => Yii::t('app','File with name "'.$key.'" Can`t be saved')];
            }
        }
        return ['status' => 'success' ,'message' => Yii::t('app','all files have been uploaded and saved')];
    }
}
