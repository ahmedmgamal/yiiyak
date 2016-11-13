<?php

namespace backend\modules\crud\controllers\api;

/**
* This is the class for REST controller "PsmfController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class PsmfController extends \yii\rest\ActiveController
{
public $modelClass = 'backend\modules\crud\models\Psmf';
}
