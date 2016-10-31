<?php

use yii\db\Migration;

class m161031_082151_add_full_text_index_to_meddra_llt_meddra_pt_tables extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE meddra_llt ADD FULLTEXT (term)");
        $this->execute("ALTER TABLE meddra_pt ADD FULLTEXT (term)");
        $this->execute("ALTER TABLE meddra_hlt ADD FULLTEXT (term)");
        $this->execute("ALTER TABLE meddra_hlgt ADD FULLTEXT (term)");
        $this->execute("ALTER TABLE meddra_soc ADD FULLTEXT (term)");


    }

    public function down()
    {

    }


}
