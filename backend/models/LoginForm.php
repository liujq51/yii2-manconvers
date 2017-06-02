<?php
namespace backend\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $email;
	 public $captcha;
    public $rememberMe = true;

    private $_user;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required','on'=>['login']],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean','on'=>['login']],
			   ['captcha', 'captcha','on'=>['login']],
            // password is validated by validatePassword()
            ['password', 'validatePassword','on'=>['login']],
            ['email', 'required','on'=>['reset']],
            ['email', 'validateEmail','on'=>['reset']],
        ];
    }
    
    /**
     * @inheritdoc
     */
	public function attributeLabels(){
		return [
			//'captcha'=>'验证码',
		];
	}
	public function scenarios(){
		return [
			'login'=>['username','password','rememberMe','captcha'],
			'reg'=>['email'],
		];
	}
    public function validateEmail(){
		header('Location:http://www.baidu.com');
	}
    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getAdminUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
		  $this->setScenario('login');
        if ($this->validate()) {
            return Yii::$app->user->login($this->getAdminUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getAdminUser()
    {
        if ($this->_user === null) {
            $this->_user = Admin::findByUsername($this->username);
        }

        return $this->_user;
    }
}
