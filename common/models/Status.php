<?php
namespace common\models;

use Yii;

class Status
{
    const STATUS_DISABLED = -1;
    const STATUS_ENABLED =  1;
    const STATUS_DELETED = -2;

    public $id;
    public $label;

    public function __construct($id = null)
    {
        if ($id !== null) {
            $this->id = $id;
            $this->label = $this->getLabel($id);
        }
    }

    public static function labels($id = null)
    {
        $data = [
            self::STATUS_DISABLED => Yii::t('app', 'Disabled'),
            self::STATUS_ENABLED => Yii::t('app', 'Enabled'),
        ];

        if ($id !== null && isset($data[$id])) {
            return $data[$id];
        } else {
            return $data;
        }
    }

    public function getLabel($id)
    {
        $labels = self::labels();
        return isset($labels[$id]) ? $labels[$id] : null;
    }
}