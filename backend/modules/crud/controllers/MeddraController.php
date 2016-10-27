<?php

namespace backend\modules\crud\controllers;

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
                                 'SMQ_Content' => 'SMQ_Content.asc',
                                 'SMQ_List' => 'SMQ_List.asc',
                                 'soc' => 'soc.asc',
                                 'soc_hlgt' =>'soc_hlgt.asc'];

    public function actionCreate()
    {


            if (Yii::$app->request->isPost)
            {
                $message = $this->checkFiles($_FILES['Meddra']);
                if ($message['status'] == 'failed')
                {
                    \Yii::$app->getSession()->setFlash('error', \Yii::t('app',$message['message']));
                    return $this->redirect(['create']);
                }

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
}
