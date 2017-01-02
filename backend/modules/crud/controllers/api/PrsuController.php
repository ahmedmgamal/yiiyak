<?php

namespace backend\modules\crud\controllers\api;

/**
* This is the class for REST controller "PrsuController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class PrsuController extends \yii\rest\ActiveController
{
public $modelClass = 'backend\modules\crud\models\Prsu';
}
