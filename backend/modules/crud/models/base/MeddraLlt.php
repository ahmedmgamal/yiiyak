<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace backend\modules\crud\models\base;

use Yii;

/**
 * This is the base-model class for table "meddra_llt".
 *
 * @property string $id
 * @property string $term
 * @property string $pt_id
 * @property string $who_art_code
 * @property string $harts_code
 * @property string $costart_sym
 * @property string $icd9
 * @property string $icd9_cm
 * @property string $icd10
 * @property string $currenct
 * @property string $jart_code
 * @property string $aliasModel
 */
abstract class MeddraLlt extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'meddra_llt';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'pt_id', 'harts_code'], 'integer'],
            [['term'], 'required'],
            [['term'], 'string', 'max' => 100],
            [['who_art_code'], 'string', 'max' => 7],
            [['costart_sym'], 'string', 'max' => 21],
            [['icd9', 'icd9_cm', 'icd10'], 'string', 'max' => 8],
            [['currenct'], 'string', 'max' => 1],
            [['jart_code'], 'string', 'max' => 6]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'term' => 'Term',
            'pt_id' => 'Pt ID',
            'who_art_code' => 'Who Art Code',
            'harts_code' => 'Harts Code',
            'costart_sym' => 'Costart Sym',
            'icd9' => 'Icd9',
            'icd9_cm' => 'Icd9 Cm',
            'icd10' => 'Icd10',
            'currenct' => 'Currenct',
            'jart_code' => 'Jart Code',
        ];
    }




}