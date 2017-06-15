<?php

namespace backend\controllers;

use Yii;
use backend\models\Manholecovers;
use backend\models\ManholecoversSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ManholecoversController implements the CRUD actions for Manholecover model.
 */
class ManholecoversController extends Controller
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
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Manholecovers models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ManholecoversSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Manholecovers model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Manholecovers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Manholecovers();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Manholecovers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Update info success.'));
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Manholecovers model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    /**
     * Batch delete existing Manholecovers models.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param array $ids
     * @return mixed
     */
    public function actionBatchDelete()
    {
        //if(!Yii::$app->user->can('deleteYourAuth')) throw new ForbiddenHttpException(Yii::t('app', 'No Auth'));
    
        $ids = Yii::$app->request->post('ids');
        if (is_array($ids)) {
            foreach ($ids as $id) {
                /*$this->findModel($id)->delete();*/
                $model = $this->findModel($id);
                $model->status = Manholecovers::STATUS_DELETED;
                $model->save();
            }
        }
    
        return $this->redirect(['index']);
    }
    /**
     * Batch delete existing Manholecovers models.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param array $ids
     * @return mixed
     */
    public function actionBatchUpdateStatus()
    {
        //if(!Yii::$app->user->can('deleteYourAuth')) throw new ForbiddenHttpException(Yii::t('app', 'No Auth'));
        $ids = Yii::$app->request->post('ids');
        $statusType = Yii::$app->request->post('statusType');
        $status = constant('\backend\models\Manholecovers::'.$statusType);
        if (is_array($ids)) {
            foreach ($ids as $id) {
                /*$this->findModel($id)->delete();*/
                $model = $this->findModel($id);
                $model->status = $status;
                $model->save();
            }
        }
    
        return $this->redirect(Yii::$app->request->getReferrer());
    }
    
    /**
     * Finds the Manholecovers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Manholecover the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Manholecovers::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
