<?php

namespace rbac\admin\models;

use Yii;
use rbac\admin\components\Configs;
use yii\db\Query;


class Assignments extends \yii\db\ActiveRecord
{
    public $parent_name;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%auth_assignment}}';
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
}
