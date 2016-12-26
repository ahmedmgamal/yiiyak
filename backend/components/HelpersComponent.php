<?php
namespace backend\components;

use yii\base\Component;

class HelpersComponent extends Component{


    public function init(){
        parent::init();
    }

    public function currentUserCan($route){

        if(!\Yii::$app->user->can($route))
        {
            return false;
        }

        return true;
    }



}