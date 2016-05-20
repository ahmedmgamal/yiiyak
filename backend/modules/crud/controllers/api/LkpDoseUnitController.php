<?php

namespace backend\modules\crud\controllers\api;

/**
* This is the class for REST controller "LkpDoseUnitController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class LkpDoseUnitController extends \yii\rest\ActiveController
{
public $modelClass = 'backend\modules\crud\models\LkpDoseUnit';
}
