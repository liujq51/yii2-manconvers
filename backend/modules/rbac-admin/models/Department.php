<?php

namespace rbac\admin\models;

use Yii;
use rbac\admin\components\Configs;
use yii\db\Query;

/**
 * This is the model class for table "menu".
 *
 * @property integer $id Menu id(autoincrement)
 * @property string $name Menu name
 * @property integer $parent Menu parent
 * @property string $route Route for this menu
 * @property integer $order Menu order
 * @property string $data Extra information for this menu
 *
 * @property Menu $menuParent Menu parent
 * @property Menu[] $menus Menu children
 *
 * @author Misbahul D Munir <misbahuldmunir@gmail.com>
 * @since 1.0
 */
class Department extends \yii\db\ActiveRecord
{
    const STATUS_DISABLED = -1;
    const STATUS_ENABLED =  1;
    const STATUS_DELETED = -2;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return Configs::instance()->departmentTable;
    }

    /**
     * @inheritdoc
     */
    public static function getDb()
    {
        if (Configs::instance()->db !== null) {
            return Configs::instance()->db;
        } else {
            return parent::getDb();
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['created_at', 'updateat'], 'safe'],
            [['id'], 'required'],
        ];
    }
    public function getparentDep(){
        return $this->hasOne(Department::className(), ['id' => 'parent_id']);
    }
    
    /**
     *
     * @param string $id
     * @return string|string[]
     */
    public static function getStatusLabels($id = null)
    {
        $data = [
            self::STATUS_DISABLED => Yii::t('app', 'Disabled'),
            self::STATUS_ENABLED => Yii::t('app', 'Enabled'),
        ];
    
        if ($id !== null) {
            return isset($data[$id])?$data[$id]:'';
        } else {
            return $data;
        }
    }
    /**
     * Get all catalog order by parent/child with the space before child label
     * Usage: ArrayHelper::map(Catalog::get(0, Catalog::find()->asArray()->all()), 'id', 'label')
     * @param int $parentId  parent catalog id
     * @param array $array  catalog array list
     * @param int $level  catalog level, will affect $repeat
     * @param int $add  times of $repeat
     * @param string $repeat  symbols or spaces to be added for sub catalog
     * @return array  catalog collections
     */
    static public function get($parentId = 0, $array = [], $level = 0, $add = 2, $repeat = '　')
    {
        $strRepeat = '';
        // add some spaces or symbols for non top level categories
        if ($level > 1) {
            for ($j = 0; $j < $level; $j++) {
                $strRepeat .= $repeat;
            }
        }
    
        $newArray = array ();
        //performance is not very good here
        foreach ((array)$array as $v) {
            if ($v['parent_id'] == $parentId) {
                $item = (array)$v;
                $item['label'] = $strRepeat . (isset($v['dep_name']) ? $v['dep_name'] : $v['id']);
                $newArray[] = $item;
    
                $tempArray = self::get($v['id'], $array, ($level + $add), $add, $repeat);
                if ($tempArray) {
                    $newArray = array_merge($newArray, $tempArray);
                }
            }
        }
        return $newArray;
    }
}
