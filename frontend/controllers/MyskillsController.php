<?php

namespace frontend\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;

class MyskillsController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'list'],
                'rules' => [
                    [
                        'actions' => ['index', 'list'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionList()
    {
        /* @var $user \common\models\User */
        $user = \Yii::$app->user;
        $employee = \common\models\Employee::findOne(['user_id'=>$user->id]);

        $searchModel = new \frontend\models\MySkillsSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->getQueryParams());

        return $this->render('list',[
            'employee'=>$employee,
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }
}