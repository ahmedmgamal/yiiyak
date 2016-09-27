<?php
namespace backend\modules\crud\traits;
use yii\helpers\StringHelper;
use yii\helpers\Url;
use backend\modules\crud\models\Icsr;

trait checkIcsrExported {

    public function beforeAction($action){
        $currentControllerClassPath = get_class(\Yii::$app->controller);
        $controllerClassName = StringHelper::basename($currentControllerClassPath);
        $pureNameWithoutController = str_replace("Controller","",$controllerClassName);
        $parameters = \yii::$app->getRequest()->getQueryParams();

        $icsrModel = new Icsr();

        if ($action->id == 'create' )
        {

            $icsrId = $parameters[$pureNameWithoutController]['icsr_id'];

            if ($icsrModel->isIcsrExported($icsrId))
            {
                return  \Yii::$app->response->redirect(Url::to(['/crud/icsr/view', 'id' => $icsrId]));
            }
        }

        if ($action->id == 'update')
        {

            $modelName = 'backend\modules\crud\models\\' . $pureNameWithoutController;
            $modelObj = new $modelName();

            $modelObj = $modelObj::findOne(['id' => $parameters['id']]);

            if ($icsrModel->isIcsrExported($modelObj->icsr_id))
            {
                return  \Yii::$app->response->redirect(Url::to(['/crud/icsr/view', 'id' => $modelObj->icsr_id]));

            }
        }

        return true;
    }

}