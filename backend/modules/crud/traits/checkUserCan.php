<?php
namespace backend\modules\crud\traits;


trait checkUserCan {

    public static function checkUserCan ($user_id)
    {
        if (!isset($user_id) || empty($user_id))
        {
            return false;
        }

        $currentModule = \Yii::$app->controller->module->id;
        $currentController = \Yii::$app->controller->id;
        $currentAction  = \Yii::$app->controller->action->id;


        if (!\Yii::$app->user->can('/'.$currentModule.'/'.$currentController.'/'.$currentAction))
        {
            return false;
        }

        return true;


    }

}