<?php

namespace common\models;

use Yii;
use yii\helpers\Html;
use common\models\User;

/**
 * This is the model class for table "{{%post}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $tags
 * @property integer $status
 * @property integer $create_at
 * @property integer $update_at
 * @property integer $author_id
 */
class Post extends \yii\db\ActiveRecord
{
    const STATUS_DRAFT =  'draft';
    const STATUS_PUBLISHED = 'published';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%post}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content', 'status', 'author_id'], 'required'],
            [['content', 'tags'], 'string'],
            [['create_at', 'update_at', 'author_id'], 'integer'],
            
            [['title'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'content' => Yii::t('app', 'Content'),
            'tags' => Yii::t('app', 'Tags'),
            'status' => Yii::t('app', 'Status'),
            'create_at' => Yii::t('app', 'Create At'),
            'update_at' => Yii::t('app', 'Update At'),
            'author_id' => Yii::t('app', 'Author ID'),
        ];
    }
    /**
     *
     * @param string $id
     * @return string|string[]
     */
    public static function getStatusLabels($id = null)
    {
        $data = [
            self::STATUS_DRAFT => Yii::t('app', 'Draft'),
            self::STATUS_PUBLISHED => Yii::t('app', 'Published'),
        ];
    
        if ($id !== null && isset($data[$id])) {
            return $data[$id];
        } else {
            return $data;
        }
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }
    public function getUrl()
    {
        return Yii::$app->urlManager->createUrl(['cms/post/detail','id'=>$this->id,'title'=>$this->title]);
    }
    public function getBeginning($length=288)
    {
        $tmpStr = strip_tags($this->content);
        $tmpLen = mb_strlen($tmpStr);
    
        $tmpStr = mb_substr($tmpStr,0,$length,'utf-8');
        return $tmpStr.($tmpLen>$length?'...':'');
    }
    
    public function  getTagLinks()
    {
        $links=array();
        foreach(Tag::string2array($this->tags) as $tag)
        {
            $links[]=Html::a(Html::encode($tag),array('cms/post/index','PostSearch[tags]'=>$tag));
        }
        return $links;
    }
    public function getCommentCount()
    {
        return Comment::find()->where(['post_id'=>$this->id,'status'=>2])->count();
    }
}
