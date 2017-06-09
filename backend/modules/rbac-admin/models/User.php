<?php

namespace rbac\admin\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use rbac\admin\components\Configs;
use rbac\admin\models\Department;
use rbac\admin\models\Assignments;
use yii\helpers\ArrayHelper;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 *
 * @property UserProfile $profile
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DISABLED = -1;
    const STATUS_ENABLED =  1;
    const STATUS_DELETED = -2;

    public $password = '';
    public $repassword = '';
    public $oldpassword = '';
    public $imageUrl;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return Configs::instance()->userTable;
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ENABLED],
            ['status', 'in', 'range' => [self::STATUS_ENABLED, self::STATUS_DELETED,self::STATUS_DISABLED]],
            ['username','trim', 'on' => ['admin-profile']],
            [['username'],'required', 'on' => ['admin-profile']],
            ['username', 'match', 'pattern' => '/^[a-zA-Z0-9_-]+$/', 'on' => ['admin-profile']],
            [['username'], 'string', 'min'=>3,'max' => 100, 'on' => ['admin-profile']],
            [['username','email'],'unique', 'on' => ['admin-profile']],
            ['mobile','integer', 'on' => ['admin-profile']],
            ['email','email', 'on' => ['admin-profile']],
            [['password', 'repassword', 'oldpassword'], 'required', 'on' => ['admin-change-password']],
            [['password', 'repassword', 'oldpassword'], 'string', 'min' => 5, 'max' => 30, 'on' => ['admin-change-password']],
            
            ['oldpassword', 'validateOldPassword', 'on' => ['admin-change-password']],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ENABLED]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ENABLED]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
                'password_reset_token' => $token,
                'status' => self::STATUS_ENABLED,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public static function getDb()
    {
        return Configs::userDb();
    }
    public static function getArrayDepartment()
    {
        return ArrayHelper::map(Department::find()->all(), 'id', 'dep_name');
    }
    
    public function getDepartment(){
        return $this->hasOne(Department::className(), ['id' => 'department_id']);
    }
    public function getAssignment(){
        return $this->hasMany(Assignments::className(), ['user_id' => 'id']);
    }
    public static function getSavedEmployees()
    {
        $userTableName = User::tableName();
        $depTableName = Department::tableName();
        return (new \yii\db\Query())
        ->select(['u.username','u.english_name','d.tla_code'])
        ->from(['u' => $userTableName])
        ->leftJoin(['d'=>$depTableName], 'u.department_id=d.id')
        ->distinct()
        ->all(static::getDb());
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
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateOldPassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $admin = self::findOne(Yii::$app->user->identity->id);
            if (!$admin || !$admin->validatePassword($this->oldpassword)) {
                $this->addError($attribute, Yii::t('error', 'Incorrect old password.'));
            }
        }
    }
}
