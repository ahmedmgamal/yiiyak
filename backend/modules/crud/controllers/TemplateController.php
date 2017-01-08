<?php

namespace backend\modules\crud\controllers;

use yii\helpers\StringHelper;
use yii\web\Controller;

class TemplateController extends Controller
{

    public function actionRmp()
    {
        return $this->render('rmp');
    }
    public function actionRmpDownload()
    {
        $path = \Yii::getAlias('@webroot').'/sample_files/';
        $fileName = StringHelper::basename("RMP_template.docx");
        $path .= $fileName;
        \Yii::$app->response->sendFile($path);
    }
    public function actionPsur()
    {
        return $this->render('psur');
    }
    public function actionPsurDownload()
    {
        $path = \Yii::getAlias('@webroot').'/sample_files/';
        $fileName = StringHelper::basename("PSUR.docx");
        $path .= $fileName;
        \Yii::$app->response->sendFile($path);
    }
}
