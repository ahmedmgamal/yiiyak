<?php

namespace backend\modules\crud\controllers\api;

/**
* This is the class for REST controller "IcsrVersionResponseController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class IcsrVersionResponseController extends \yii\rest\ActiveController
{
public $modelClass = 'backend\modules\crud\models\IcsrVersionResponse';
}
