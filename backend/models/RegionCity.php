<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mc_region_city".
 *
 * @property integer $id
 * @property integer $city_id
 * @property string $city
 * @property integer $father_id
 */
class RegionCity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mc_region_city';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['city_id', 'city', 'father_id'], 'required'],
            [['city_id', 'father_id'], 'integer'],
            [['city'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'city_id' => 'City ID',
            'city' => 'City',
            'father_id' => 'Father ID',
        ];
    }
}
