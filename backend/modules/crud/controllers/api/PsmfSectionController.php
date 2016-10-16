<?php

namespace backend\modules\crud\controllers\api;

/**
* This is the class for REST controller "PsmfSectionController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class PsmfSectionController extends \yii\rest\ActiveController
{
public $modelClass = 'backend\modules\crud\models\PsmfSection';
}
