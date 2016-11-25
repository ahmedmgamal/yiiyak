<?php

use yii\db\Migration;

class m161125_193507_meddra_pt_seeds extends Migration
{
    public function up()
    {
        $this->execute("INSERT INTO `meddra_pt` (`id`, `term`, `null_field`, `soc_id`, `who_art_code`, `harts_code`, `costart_sym`, `icd9`, `icd9_cm`, `icd10`, `jart_code`) VALUES
(10001477, 'Aged parent', '', 10041244, '', NULL, '', '', '', '', ''),
(10023636, 'Lacrimal punctum agenesis', '', 10010331, '', NULL, '', '', '', '', ''),
(10004089, 'Bankruptcy', '', 10041244, '', NULL, '', '', '', '', ''),
(10036465, 'Poverty', '', 10041244, '', NULL, '', '', '', '', ''),
(10024861, 'Loss of employment', '', 10041244, '', NULL, '', '', '', '', ''),
(10038942, 'Retirement', '', 10041244, '', NULL, '', '', '', '', ''),
(10040637, 'Sick relative', '', 10041244, '', NULL, '', '', '', '', ''),
(10045520, 'Unemployment', '', 10041244, '', NULL, '', 'V 62.0', 'V62.0', '', ''),
(10023193, 'Job dissatisfaction', '', 10041244, '', NULL, '', '', '', '', ''),
(10015721, 'Extended radical mastectomy', '', 10042613, '', NULL, '', '', '', '', ''),
(10040700, 'Simple mastectomy', '', 10042613, '', NULL, '', '', '', '', ''),
(10037773, 'Radical mastectomy', '', 10042613, '', NULL, '', '', '', '', ''),
(10004242, 'Benign breast lump removal', '', 10042613, '', NULL, '', '', '', '', ''),
(10025540, 'Malignant breast lump removal', '', 10042613, '', NULL, '', '', '', '', ''),
(10016615, 'Fibroadenoma removal', '', 10042613, '', NULL, '', '', '', '', ''),
(10033308, 'Overwork', '', 10041244, '', NULL, '', '', '', '', ''),
(10034071, 'Partial mastectomy', '', 10042613, '', NULL, '', '', '', '', ''),
(10018333, 'Glaucomatocyclitic crises', '', 10015919, '', NULL, '', '', '', '', ''),
(10018324, 'Glaucoma congenital', '', 10010331, '', NULL, '', '', '', '', ''),
(10007587, 'Cardiac murmur functional', '', 10022891, '', NULL, '', '', '', '', ''),
(10043502, 'Threat of redundancy', '', 10041244, '', NULL, '', '', '', '', ''),
(10023192, 'Job change', '', 10041244, '', NULL, '', '', '', '', ''),
(10024931, 'Low tension glaucoma', '', 10015919, '', NULL, '', '', '', '', ''),
(10034798, 'Phacolytic glaucoma', '', 10015919, '', NULL, '', '', '', '', ''),
(10001635, 'Alcoholic relative', '', 10041244, '', NULL, '', '', '', '', ''),
(10012265, 'Demented relative', '', 10041244, '', NULL, '', '', '', '', ''),
(10012686, 'Diabetic relative', '', 10041244, '', NULL, '', '', '', '', ''),
(10013053, 'Disabled relative', '', 10041244, '', NULL, '', '', '', '', ''),
(10039645, 'Schizophrenic relative', '', 10041244, '', NULL, '', '', '', '', ''),
(10014055, 'Early retirement', '', 10041244, '', NULL, '', '', '', '', ''),
(10024916, 'Low income', '', 10041244, '', NULL, '', '', '', '', ''),
(10047695, 'Voluntary redundancy', '', 10041244, '', NULL, '', '', '', '', ''),
(10035015, 'Pigmentary glaucoma', '', 10015919, '', NULL, '', '', '', '', ''),
(10019311, 'Heart sounds abnormal', '', 10022891, '', NULL, '', '', '', '', ''),
(10030043, 'Ocular hypertension', '', 10015919, '', NULL, '', '', '', '', ''),
(10006027, 'Borderline glaucoma', '', 10015919, '', NULL, '', '365.0', '', '', ''),
(10002500, 'Angle closure glaucoma', '', 10015919, '', NULL, '', '', '', '', ''),
(10019312, 'Heart sounds normal', '', 10022891, '', NULL, '', '', '', '', ''),
(10037255, 'Psychotic family member', '', 10041244, '', NULL, '', '', '', '', ''),
(10051409, 'Biopsy artery', '', 10022891, '', NULL, '', '', '', '', ''),
(10052169, 'Breast cyst excision', '', 10042613, '', NULL, '', '', '', '', ''),
(10052562, 'High income', '', 10041244, '', NULL, '', '', '', '', ''),
(10052663, 'Biopsy blood vessel', '', 10022891, '', NULL, '', '', '', '', ''),
(10052864, 'Brachytherapy to blood', '', 10042613, '', NULL, '', '', '', '', ''),
(10052866, 'Gamma radiation therapy to blood', '', 10042613, '', NULL, '', '', '', '', ''),
(10052867, 'Photon radiation therapy to blood', '', 10042613, '', NULL, '', '', '', '', ''),
(10052869, 'X-ray therapy to blood', '', 10042613, '', NULL, '', '', '', '', ''),
(10053202, 'Posterior segment of eye anomaly congenital', '', 10010331, '', NULL, '', '', '', '', ''),
(10011850, 'Dacryostenosis congenital', '', 10010331, '', NULL, '', '', '', '', ''),
(10057935, 'Glaucomatous optic disc atrophy', '', 10015919, '', NULL, '', '', '', '', ''),
(10058364, 'Biopsy artery abnormal', '', 10022891, '', NULL, '', '', '', '', ''),
(10058393, 'Biopsy artery normal', '', 10022891, '', NULL, '', '', '', '', ''),
(10058409, 'Biopsy blood vessel normal', '', 10022891, '', NULL, '', '', '', '', ''),
(10058410, 'Biopsy blood vessel abnormal', '', 10022891, '', NULL, '', '', '', '', ''),
(10059199, 'Anterior chamber cleavage syndrome', '', 10010331, '', NULL, '', '', '', '', ''),
(10007586, 'Cardiac murmur', '', 10022891, '', NULL, '', '', '', '', ''),
(10018304, 'Glaucoma', '', 10015919, '227001', 2115, 'GLAUCOMA', '365', '365', '', '906'),
(10026878, 'Mastectomy', '', 10042613, '', NULL, '', '', '85.4', '', ''),
(10030348, 'Open angle glaucoma', '', 10015919, '', NULL, '', '', '', '', ''),
(10010523, 'Congenital lacrimal gland anomaly', '', 10010331, '', NULL, '', '', '', '', ''),
(10061051, 'Eye anterior chamber congenital anomaly', '', 10010331, '', NULL, '', '', '', '', ''),
(10061085, 'Congenital vitreous anomaly', '', 10010331, '', NULL, '', '', '', '', ''),
(10061114, 'Economic problem', '', 10041244, '', NULL, '', '', '', '', ''),
(10061733, 'Breast lump removal', '', 10042613, '', NULL, '', '', '', '', ''),
(10007664, 'Caregiver', '', 10041244, '', NULL, '', '', '', '', ''),
(10062088, 'Radiotherapy to blood', '', 10042613, '', NULL, '', '', '', '', ''),
(10062338, 'Congenital lacrimal passage anomaly', '', 10010331, '', NULL, '', '', '', '', ''),
(10001477, 'Aged parent', NULL, 10041244, NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
    }

    public function down()
    {
       $this->execute('truncate table meddra_pt');
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
