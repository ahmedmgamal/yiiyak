<?php

namespace backend\modules\crud\controllers;
use Yii;
use yii\web\UploadedFile;
use \backend\modules\crud\traits\DownloadFile;


/**
* This is the class for controller "RmpController".
*/
class RmpController extends \backend\modules\crud\controllers\base\RmpController
{

    use DownloadFile;

    public function actionUploadLetterHeader($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isPost)
        {
            $model->rmpAck =  UploadedFile::getInstance($model, 'rmpAck');
            $model->ack_created_by = \Yii::$app->user->identity->id;
            $model->ack_created_at = date('Y-m-d H:i:s',strtotime('now'));
            $model->rmpFile = UploadedFile::getInstance($model, 'rmpAck');

            $uploadResult = $model->uploadAck();
            if ($uploadResult['type'] == 'fail')
            {
                \Yii::$app->getSession()->setFlash('error', Yii::t('app',$uploadResult['message']));
                return $this->redirect(\Yii::$app->request->referrer);
            }
            else {

                $model->save();
                return $this->redirect(['drug/view', 'id' => $model->drug_id]);
            }
        }


         else {
            return $this->render('upload-letter-header', [
                'model' => $model,
            ]);
        }
    }

}
