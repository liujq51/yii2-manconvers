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
class Manholecover extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%manhole_covers}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status','province_id','city_id','area_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['cover_id'], 'required'],
            [['cover_id'], 'string', 'max' => 100],
            [['cover_name'], 'string', 'max' => 100],
            [['poi'], 'string', 'max' => 100],
            [['remark'], 'string', 'max' => 255],
        ];
    }
    public function extraFields()
    {
        // ['city_id'];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cover_id' => Yii::t('app', 'Manhole Cover Id'),
            'cover_name' => Yii::t('app', 'Manhole Cover Name'),
            'construction_time' => Yii::t('app', 'Construction Time'),
            'remark' => Yii::t('app', 'Remark'),
            'status' => Yii::t('app', 'Status'),
            'province' => Yii::t('app', 'Province'),
            'city' => Yii::t('app', 'City'),
            'area' => Yii::t('app', 'Area'),
        ];
    }
}
