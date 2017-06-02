<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\LoginForm;
use yii\filters\VerbFilter;
use backend\models\PasswordResetRequestForm;
use backend\models\ResetPasswordForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
         'error' => [
             'class' => 'yii\web\ErrorAction',
            ],
			'captcha' => [
				'class' => 'yii\captcha\CaptchaAction',
				'height' => 50,
				'width' => 80,
				'minLength' => 4,
				'maxLength' => 4
			]
        ];
    }
    public function actionIndex()
    {
      if (!\Yii::$app->user->isGuest) {
            //return $this->goHome();
            return $this->render('index');
      }else{
        $this->redirect(['/site/login']);
        }
    }
    public function actionIndex1()
    {
        if (!\Yii::$app->user->isGuest) {
            //return $this->goHome();
            return $this->render('index1');
        }else{
            echo 'index1';
            exit;
            $this->redirect('/site/login');
        }
    }
    public function actionMail(){
        return $this->renderAjax('notice_mail');
    }
    public function actionLogin()
    {
		$this->layout= 'single';
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

      $model = new LoginForm();
		$model->setScenario('login');
		$modelResetPassword = new PasswordResetRequestForm();
		$modelResetPassword->setScenario('reset');
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
				'modelResetPassword' => $modelResetPassword,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
    /**
     * Language Switch
     */
    public function actionLanguage()
    {
        
        $locale = Yii::$app->request->get('locale');
        if($locale){
            //$langCookie = new yii\web\Cookie(['name' =>'locale', 'value' => $locale, 'expire' => 3600*24*30]);
            //$langCookie->expire = time() + 3600*24*30;
            //Yii::$app->response->cookies->add($langCookie);
            Yii::$app->session['language']=$locale;
        }
        
        $this->goBack(Yii::$app->request->headers['Referer']);
    }
    public function actionEmail()
    {
        $mail= Yii::$app->mailer->compose();
        $mail->setFrom(['liujiaqiang@126.com'=>'Test User']);
        $mail->setTo('liujiaqiang@126.com');
        $mail->setSubject("邮件测试");
        //$mail->setTextBody('zheshisha ');   //发布纯文字文本
        $mail->setHtmlBody("<br>问我我我我我");    //发布可以带html标签的文本
        if($mail->send())
            echo "success";
            else
                echo "fail";
                exit;
    }
    public function actionRequestPasswordReset()
    {
        $this->layout= 'single';
        $this->enableCsrfValidation = false;
        $retMsg = '';
            $model = new PasswordResetRequestForm();
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                if ($model->sendEmail()) {
                    $retMsg = Yii::t('app', 'Check your email for further instructions.');
                    //return $this->goHome();
                } else {
                    $retMsg = Yii::t('app', 'Sorry, we are unable to reset password for email provided.');
                }
            }else{
                $retMsg = Yii::t('app', 'Sorry, we are unable to reset password for email provided.');
            }
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
           return [
               'data' => $retMsg,
               'code' => 200,
           ];
        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }
    public function actionResetPassword($token)
    {
        $this->layout = 'single'; 
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
    
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', Yii::t('app', 'New password was saved.'));
    
            return $this->goHome();
        }
    
        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
    public function actionHttp(){
        redirect("file:///job/HOME/liujq/www/yii/rbox/");
    }
}
