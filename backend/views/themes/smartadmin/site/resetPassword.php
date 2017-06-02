<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

$this->title = Yii::t('app', 'Reset password');
$this->params['breadcrumbs'][] = $this->title;
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
                    <div class="site-reset-password">
                        <h4 class="header red lighter bigger">
                     			<i class="ace-icon fa fa-key"></i>
                     			<?= Html::encode($this->title) ?>
                     		</h4>
                        <p><?= Yii::t('app', 'Please choose your new password:') ?></p>
                        <div class="row">
                            <div class="col-lg-5">
                                <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>
                                    <?= $form->field($model, 'password')->label('')->passwordInput(['placeholder'=> 'password']) ?>
                                    <div class="form-group">
                                        <?= Html::submitButton( Yii::t('app', 'Save'), ['class' => 'btn btn-primary']) ?>
                                    </div>
                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                    </div>
                    </div>
              </div>
              </div>
      </div>
      </div>
