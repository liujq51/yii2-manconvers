<?php

namespace backend\models;

use Yii;
use backend\models\RegionProvince;
use backend\models\RegionCity;
use backend\models\RegionArea;

/**
 * This is the model class for table "{{%app}}".
 *
 * @property integer $cover_id
 * @property string $cover_name
 * @property string $remark
 * @property integer $status
 * @property string $createat
 * @property string $updateat
 */
class Manholecover extends \yii\db\ActiveRecord
{
    const STATUS_DISABLED = -1;
    const STATUS_ENABLED =  1;
    const STATUS_DELETED = -2;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%manhole_cover}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status','province_id','city_id','area_id'], 'integer'],
            [['createat', 'updateat'], 'safe'],
            [['cover_name'], 'required'],
            [['cover_name'], 'string', 'max' => 100],
            [['cover_id'], 'string', 'max' => 100],
            [['poi'], 'string', 'max' => 100],
            [['remark'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cover_id' => Yii::t('cover', 'Manhole Covers ID'),
            'cover_name' => Yii::t('cover', 'Manhole Covers Name'),
            'construction_time' => Yii::t('cover', 'Construction Time'),
            'remark' => Yii::t('cover', 'Remark'),
            'status' => Yii::t('cover', 'Status'),
            'province' => Yii::t('cover', 'Province'),
            'city' => Yii::t('cover', 'City'),
            'area' => Yii::t('cover', 'Area'),
        ];
    }
    
    public function getprovince(){
        return $this->hasOne(RegionProvince::className(), ['province_id' => 'province_id']);
    }
    public function getcity(){
        return $this->hasOne(RegionCity::className(), ['city_id' => 'city_id']);
    }
    public function getarea(){
        return $this->hasOne(RegionArea::className(), ['area_id' => 'area_id']);
    }
    
    /**
     *
     * @param string $id
     * @return string|string[]
     */
    public static function getStatusLabels($id = null)
    {
        $data = [
            self::STATUS_DISABLED => Yii::t('cover', 'Disabled'),
            self::STATUS_ENABLED => Yii::t('cover', 'Enabled'),
        ];
    
        if ($id !== null && isset($data[$id])) {
            return $data[$id];
        } else {
            return $data;
        }
    }
    
}
