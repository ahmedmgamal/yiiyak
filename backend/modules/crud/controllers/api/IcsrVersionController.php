<?php

namespace backend\modules\crud\controllers\api;

/**
* This is the class for REST controller "IcsrVersionController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class IcsrVersionController extends \yii\rest\ActiveController
{
public $modelClass = 'backend\modules\crud\models\IcsrVersion';
}
