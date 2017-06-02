<?php

namespace api\models;

use Yii;

/**
 * This is the model class for table "rbox_city".
 *
 * @property integer $id
 * @property integer $city_id
 * @property string $city
 * @property integer $father_id
 */
class Citys extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rbox_city';
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
    public function extraFields()
    {
        return ['city_id'];
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
