<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\Admin;
use yii\filters\VerbFilter;
/**
 * Admin controller
 */
class AdminController extends Controller
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
                ],
            ],
        ];
    }

    public function actionProfile()
    {
        $model = Admin::findIdentity(Yii::$app->user->identity->id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['profile']);
        } else {
            return $this->render('profile', [
                'model' => $model,
            ]);
        }
        return false;
    }
    public function actionSaveProfile(){
        
    }
}
