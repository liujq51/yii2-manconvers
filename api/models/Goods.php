<?php

namespace api\models;

use Yii;
use yii\web\Link;
use yii\web\Linkable;
use yii\helpers\Url;
/**
 * This is the model class for table "goods".
 *
 * @property integer $id
 * @property string $name
 */
class Goods extends \yii\db\ActiveRecord // implements Linkable
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }
    public function getLinks()
    {
       /* return [
            Link::REL_SELF => Url::to(['Goods/view', 'id' => $this->id], true),
        ];*/
    }
}
