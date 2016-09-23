<?php

namespace backend\modules\crud\models;

use Yii;
use \backend\modules\crud\models\base\Company as BaseCompany;

/**
 * This is the model class for table "company".
 */
class Company extends BaseCompany
{
        /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return array_merge(
            parent::attributeHints(),
            [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'A.3.1.2 Sender identifier : senderorganization'),
            'adderess' => Yii::t('app', 'Adderess'),
            'license_no' => Yii::t('app', 'License No'),
            'license_image_url' => Yii::t('app', 'License Image Url'),
            'end_date' => Yii::t('app','Subscription End Date'),
             'plan_id' => Yii::t('app','Plan')
            ]);
    }
    public function getUser($user_id){
        return $this->getUsers()->where(['id' => $user_id])->one();
    }

 public function getPlans ()
 {
    return LkpPlan::find()->all();
 }


}
