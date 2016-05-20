<?php

namespace backend\modules\crud\controllers\api;

/**
* This is the class for REST controller "LkpDrugActionController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class LkpDrugActionController extends \yii\rest\ActiveController
{
public $modelClass = 'backend\modules\crud\models\LkpDrugAction';
}
