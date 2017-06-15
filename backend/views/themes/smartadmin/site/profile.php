<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = Yii::t('app', 'Update ') . Yii::t('app', 'User') . ' ' . $model->username;
$this->params['breadcrumbs'][] = Yii::t('app', 'Profile');
?>
<div class="user-update">

    <?= $this->render('_profile_form', [
        'model' => $model,
        'avatarPath' => $avatarPath,
    ]) ?>

</div>
