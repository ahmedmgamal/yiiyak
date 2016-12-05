<?php

namespace backend\modules\crud\controllers\api;

/**
* This is the class for REST controller "RmpController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class RmpController extends \yii\rest\ActiveController
{
public $modelClass = '\backend\modules\crud\models\Rmp';
}
