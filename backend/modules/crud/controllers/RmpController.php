<?php

namespace backend\modules\crud\controllers;
use Yii;

/**
* This is the class for controller "RmpController".
*/
class RmpController extends \backend\modules\crud\controllers\base\RmpController
{


    public function actionDownloadFile($path)
    {
        $path =  Yii::getAlias('@webroot') . $path;
        if (file_exists($path))
        {
            return Yii::$app->response->sendFile($path);
        }

        else
        {
            Yii::$app->session->setFlash('error',Yii::t('app','File Doesn\'t Exist Any More'));

            return $this->redirect(Yii::$app->request->referrer);
        }

    }

}
