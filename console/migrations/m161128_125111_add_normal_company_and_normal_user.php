<?php

use backend\modules\crud\models\Company;
use yii\db\Migration;

class m161128_125111_add_normal_company_and_normal_user extends Migration
{
    public function up()
    {
        $this->execute("INSERT INTO company (name,end_date,plan_id,short_name,enable_meddra_search) VALUES ('normal','2018-06-30',1,'nn',1)");
        $companyId= Company::findOne(['name' => 'normal'])->id;
        $hashedPassword = \Yii::$app->security->generatePasswordHash('opensource1234');
        $this->execute("INSERT INTO user (username,auth_key,email,password_hash,created_at,updated_at,company_id) VALUES ('ahmed1234','_47thfas','ahmed1234@yahoo.com','{$hashedPassword}',123123,2341234,{$companyId})");
    }

    public function down()
    {

    }


}
