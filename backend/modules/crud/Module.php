<?php

namespace backend\modules\crud;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'backend\modules\crud\controllers';

    public function init()
    {
        parent::init();

           \Yii::configure($this, require(__DIR__ . '/main.php'));

    }
}
