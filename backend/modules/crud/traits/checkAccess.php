<?php
namespace backend\modules\crud\traits;

trait checkAccess {

    // you must define getCompany method before using the trait

    public static function checkAccess($user_id,$obj_id)
    {


        if (!isset($user_id) || empty($user_id))
        {
            return false;
        }

        $userRole = \Yii::$app->authManager->getRolesByUser(\Yii::$app->user->id);



        if (isset($userRole['admin']))
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

        if (isset($obj_id) && !empty($obj_id))
        {
            $company = self::findOne($obj_id)->company;

            if (!$company->getUser($user_id))
            {
                return false;
            }

        }
        return true;
    }
}