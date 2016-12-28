<?php

use yii\db\Migration;

class m161221_133036_add_statistics_role_to_auth_tables extends Migration
{
    public function up()
    {
        $this->execute("INSERT INTO `auth_item` (`name`,`type`) VALUES ('/crud/company/statistics','2')");
        $this->execute("INSERT INTO `auth_item_child` (`parent`,`child`) VALUES ('normalUser','/crud/company/statistics')");

    }

    public function down()
    {
        $this->execute("DELETE FROM `auth_item_child` WHERE `auth_item_child`.parent = 'normalUser' AND `auth_item_child`.child = '/crud/company/statistics'");

        $this->execute("DELETE FROM `auth_item` WHERE `auth_item`.name = '/crud/company/statistics' ");

    }


}
