<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\widgets\Pjax;
?>
<div class="login-container">
			<div class="center">
                <h1> <i class="ace-icon fa fa-leaf green"></i><span class="red" style="font-size:26px;"><?= Html::encode($this->title) ?></span></h1>
        		<h4 class="blue" id="id-company-text">&copy; Rbox</h4>
			</div>
            <div class="space-6"></div>
            <div class="position-relative">
				<div id="login-box" class="login-box visible widget-box no-border">
					<div class="widget-body">
						<div class="widget-main">
							<h4 class="header blue lighter bigger"><i class="ace-icon fa fa-coffee green"></i>请输入您的信息</h4>
							<div class="space-6"></div>
							<?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
							<?= $form->field($model, 'username')->label('')->textInput(['autofocus' => true,'placeholder'=>Yii::t('app','Username')]) ?>
							<?= $form->field($model, 'password')->label('')->passwordInput(['placeholder'=>Yii::t('app','Password')]) ?>
							<?= $form->field($model, 'captcha')->label(Yii::t('app', 'Captcha'))->widget(Captcha::className(),
								[
									'captchaAction' => 'site/captcha',
									'imageOptions' => ['alt'=>'点击换图','title'=>'点击换图','style'=>'cursor:pointer'],
								]
							); ?>
							<?= $form->field($model, 'rememberMe')->label('记住我')->checkbox() ?>
							<div class="form-group">
								<?= Html::resetButton('重置', ['class' => 'btn', 'name' => 'reset-button']) ?>
								&nbsp;&nbsp;
								<?= Html::submitButton('登录', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
							</div>
							<?php ActiveForm::end(); ?>
						</div>
						<div class="toolbar clearfix">
							<div>
								<a href="#" data-target="#forgot-box" class="forgot-password-link">
									<i class="ace-icon fa fa-arrow-left"></i>忘记密码</a>
							</div>
						</div>
					</div>
              </div>
			
<?php Pjax::begin();?>
              <div id="forgot-box" class="forgot-box widget-box no-border">
                 <div class="widget-body">
                 	<div class="widget-main">
                 		<h4 class="header red lighter bigger">
                 			<i class="ace-icon fa fa-key"></i>
                 			找回密码
                 		</h4>
                 
                 		<div class="space-6"></div>
                 		<p>
							Enter your email and to receive instructions
                 		</p>
                        <?php $form = ActiveForm::begin(
                            [
                                'id' => 'reset_password',
                                'action' =>'/site/request-password-reset',
                        ]
                               ); ?>
                            <?= $form->field($modelResetPassword, 'email')->label('')->textInput(['placeholder'=>'Email'])?>
                            <div class="form-group">
                                <?= Html::resetButton('重置', ['class' => 'btn', 'name' => 'reset-button']) ?>
                                &nbsp;&nbsp;
                                <?= Html::submitButton('提交', ['class' => 'btn btn-primary', 'name' => 'reg-button']) ?>
                            </div>
                        <?php ActiveForm::end(); ?> 
                 	</div><!-- /.widget-main -->
<?php Pjax::end();?>
                 	<div class="toolbar center">
                 		<a href="#" data-target="#login-box" class="back-to-login-link">
                 		    Back to login	
                 			<i class="ace-icon fa fa-arrow-right"></i>
                 		</a>
                 	</div>
                 </div><!-- /.widget-body -->
               </div><!-- /.forgot-box -->



          </div>
      </div>