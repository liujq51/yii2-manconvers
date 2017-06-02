<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mc_region_province".
 *
 * @property integer $id
 * @property integer $province_id
 * @property string $province
 */
class RegionProvince extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mc_region_province';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['province_id', 'province'], 'required'],
            [['province_id'], 'integer'],
            [['province'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'province_id' => 'Province ID',
            'province' => 'Province',
        ];
    }
}
