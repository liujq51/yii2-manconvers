<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mc_region_area".
 *
 * @property integer $id
 * @property integer $area_id
 * @property string $area
 * @property integer $father_id
 */
class RegionArea extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mc_region_area';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['area_id', 'area', 'father_id'], 'required'],
            [['area_id', 'father_id'], 'integer'],
            [['area'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'area_id' => 'Area ID',
            'area' => 'Area',
            'father_id' => 'Father ID',
        ];
    }
}
