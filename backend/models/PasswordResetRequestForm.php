<?php
namespace backend\models;

use yii\base\Model;
use Yii;
use rbac\admin\models\User as Admin;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $email;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
            'targetClass' => '\admin\models\Admin',
            'filter' => ['status' => Admin::STATUS_ENABLED],
            'message' => Yii::t('app', 'There is no user with such email.')
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'password' => Yii::t('app', 'Password'),
            'repassword' => Yii::t('app', 'Repassword'),
            'email' => Yii::t('app', 'Email'),
            'role' => Yii::t('app', 'Role'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'create_user_id' => Yii::t('app', 'Create User Id'),
            'update_user_id' => Yii::t('app', 'Update User Id'),
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return boolean whether the email was send
     */
    public function sendEmail()
    {
        /* @var $user User */
        $admin = Admin::findOne([
            'status' => Admin::STATUS_ENABLED,
            'email' => $this->email,
        ]);

        if ($admin) {
            if (!Admin::isPasswordResetTokenValid($admin->password_reset_token)) {
                $admin->generatePasswordResetToken();
            }

            if ($admin->save()) {
                return \Yii::$app->mailer->compose('passwordResetToken', ['user' => $admin])
                    ->setFrom([\Yii::$app->params['supportEmail'] => \Yii::$app->name . ' robot'])
                    ->setTo($this->email)
                    ->setSubject('Password reset for ' . \Yii::$app->name)
                    ->send();
            }
        }

        return false;
    }
}
