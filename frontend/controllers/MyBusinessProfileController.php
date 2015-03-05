<?php

namespace frontend\controllers;

use common\models\Employee;
use common\models\EmployeeBusinessProfile;
use common\models\EmployeeBusinessProfileSearch;
use jarekkozak\helpers\FlashHelper;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Controller for editing logged employee business profiles
 */
class MyBusinessProfileController extends Controller
{
    protected $employee_id;

    //trait
    use \common\lib\traits\action\TactionBusinessProfileList;

    public function init()
    {
        if (($employee = Employee::findOne(['user_id' => \Yii::$app->user->id]))
            == NULL) {
            throw new NotFoundHttpException('The requested page does not exist.');
        };
        $this->employee_id = $employee->id;
        return parent::init();
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all EmployeeBusinessProfile models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel  = new EmployeeBusinessProfileSearch;
        $dataProvider = $searchModel->search4employee($this->employee_id);

        return $this->render('index',
                [
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel
        ]);
    }

    /**
     * Displays a single EmployeeBusinessProfile model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('view', ['model' => $model]);
        }
    }

    /**
     * Creates a new EmployeeBusinessProfile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EmployeeBusinessProfile;
        if ($model->load(Yii::$app->request->post())) {
            $model->employee_id = $this->employee_id;
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }
        return $this->render('create', ['model' => $model]);
    }

    /**
     * Updates an existing EmployeeBusinessProfile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->employee_id = $this->employee_id;
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }
        return $this->render('update', ['model' => $model,]);
    }

    /**
     * Deletes an existing EmployeeBusinessProfile model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if ($this->findModel($id)->deleteProfile()) {
            FlashHelper::setFlashSuccess(\Yii::t('skills',
                    'Profile successyfully removed'));
        }
        return $this->redirect(['index']);
    }

    public function actionMoveUp($id)
    {
        if ($this->findModel($id)->moveUp()) {
            FlashHelper::setFlashSuccess(\Yii::t('skills',
                    'Profile successyfully moved up!'));
        }
        return $this->redirect(['index']);
    }

    public function actionMoveDown($id)
    {
        if ($this->findModel($id)->moveDown()) {
            FlashHelper::setFlashSuccess(\Yii::t('skills',
                    'Profile successyfully moved down!'));
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the EmployeeBusinessProfile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EmployeeBusinessProfile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EmployeeBusinessProfile::findOne(['id' => $id, 'employee_id' => $this->employee_id]))
            !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}