<?php

namespace backend\modules\crud\controllers\api;

/**
* This is the class for REST controller "LkpReactionOutcomeController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class LkpReactionOutcomeController extends \yii\rest\ActiveController
{
public $modelClass = 'backend\modules\crud\models\LkpReactionOutcome';
}
