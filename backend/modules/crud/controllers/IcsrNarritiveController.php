<?php

namespace backend\modules\crud\controllers;
use backend\modules\crud\models\IcsrNarritive;
use yii\filters\AccessControl;

/**
* This is the class for controller "IcsrNarritiveController".
*/
class IcsrNarritiveController extends \backend\modules\crud\controllers\base\IcsrNarritiveController
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => false,
                        'actions' => ['update','delete'],
                        'matchCallback' => function ($rule,$action){
                            $icsrNarritive_id = \Yii::$app->request->getQueryParam('id');
                            return IcsrNarritive::checkObjIcsrNullExported($icsrNarritive_id);

                        }
                    ],
                    [
                        'allow' => true,
                    ]
                    ]
                ]
            ];
    }

}
