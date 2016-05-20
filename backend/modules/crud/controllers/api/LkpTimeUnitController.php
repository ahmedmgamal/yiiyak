<?php

namespace backend\modules\crud\controllers\api;

/**
* This is the class for REST controller "LkpTimeUnitController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class LkpTimeUnitController extends \yii\rest\ActiveController
{
public $modelClass = 'backend\modules\crud\models\LkpTimeUnit';
}
