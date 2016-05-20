<?php

namespace backend\modules\crud\controllers\api;

/**
* This is the class for REST controller "LkpDrugRoleController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class LkpDrugRoleController extends \yii\rest\ActiveController
{
public $modelClass = 'backend\modules\crud\models\LkpDrugRole';
}
