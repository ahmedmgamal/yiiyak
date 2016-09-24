<?php

namespace backend\modules\crud\controllers\api;

/**
* This is the class for REST controller "LkpPlanController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class LkpPlanController extends \yii\rest\ActiveController
{
public $modelClass = 'backend\modules\crud\models\LkpPlan';
}
