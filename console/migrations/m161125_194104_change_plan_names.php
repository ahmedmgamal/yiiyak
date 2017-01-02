<?php

use yii\db\Migration;

class m161125_194104_change_plan_names extends Migration
{
    public function up()
    {
        $this->execute("UPDATE  lkp_plan set name='I' where name = 'gold' ");
        $this->execute("UPDATE  lkp_plan set name='II' where name = 'silver' ");
        $this->execute("UPDATE  lkp_plan set name='III' where name = 'platinum' ");
        $this->execute("INSERT INTO lkp_plan (`name`) VALUES ('IV')");
        $this->execute("UPDATE  plan_limits set `plan_limits`.limit = 10 where plan_id =
                        (SELECT id from lkp_plan where name ='I' ) 
                        AND
                         limit_id = 
                         (SELECT id from lkp_limits where name = 'drug')
                         ");

        $this->execute("UPDATE  plan_limits set `plan_limits`.limit = 1 where plan_id =
                        (SELECT id from lkp_plan where name ='I' ) 
                        AND
                         limit_id = 
                         (SELECT id from lkp_limits where name = 'user')
                         ");


        $this->execute("UPDATE  plan_limits set `plan_limits`.limit = 50 where plan_id =
                        (SELECT id from lkp_plan where name ='II' ) 
                        AND
                         limit_id = 
                         (SELECT id from lkp_limits where name = 'drug')
                         ");

        $this->execute("UPDATE  plan_limits set `plan_limits`.limit = 2 where plan_id =
                        (SELECT id from lkp_plan where name ='II' ) 
                        AND
                         limit_id = 
                         (SELECT id from lkp_limits where name = 'user')
                         ");

        $this->execute("UPDATE  plan_limits set `plan_limits`.limit = 150 where plan_id =
                        (SELECT id from lkp_plan where name ='III' ) 
                        AND
                         limit_id = 
                         (SELECT id from lkp_limits where name = 'drug')
                         ");

        $this->execute("UPDATE  plan_limits set `plan_limits`.limit = 3 where plan_id =
                        (SELECT id from lkp_plan where name ='III' ) 
                        AND
                         limit_id = 
                         (SELECT id from lkp_limits where name = 'user')
                         ");

        $this->execute("INSERT INTO plan_limits (`plan_id`,`limit_id`,`limit`) VALUES 
                        ((SELECT id from lkp_plan where name = 'IV')
                          ,(SELECT id from lkp_limits where name = 'drug')
                          ,1000)");

        $this->execute("INSERT INTO plan_limits (`plan_id`,`limit_id`,`limit`) VALUES 
                        ((SELECT id from lkp_plan where name = 'IV')
                          ,(SELECT id from lkp_limits where name = 'user')
                          ,5)");


    }

    public function down()
    {

    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
