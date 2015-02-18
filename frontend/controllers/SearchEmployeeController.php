<?php

namespace frontend\controllers;

use frontend\models\EmployeeSearchExt;
use frontend\models\SearchBySkillsForm;
use frontend\models\SkillSearchExt;
use jk\util\SkillsHelper;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class SearchEmployeeController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['by-skill','all-employees'],
                'rules' => [
                    [
                        'actions' => ['by-skill','all-employees'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionBySkill() {
        Yii::$app->session->set('profileBackUrl', Yii::$app->request->getAbsoluteUrl());
        
        $form = new SearchBySkillsForm();
        $skillSearch = new SkillSearchExt();
        $categories = $skillSearch->allWithCategories();
        
        if( $form->load(Yii::$app->request->getQueryParams()) && $form->validate()) {
            $employeeSearch = new EmployeeSearchExt();
            // Preparing search params array. Some processing required to enable Pjax features.
            $params = Yii::$app->request->getQueryParams();
            $formParams = ArrayHelper::remove($params, $form->formName());
            $searchParams = ArrayHelper::merge($params, $formParams);
            
            $dataProvider = $employeeSearch->searchBySkills($searchParams);
        } else {
            $dataProvider = NULL;
        }
        
        return $this->render('by-skill', [
                                            'model' => $form, 
                                            'data' => $categories,
                                            'levels' => SkillsHelper::getLevels(),
                                            'dataProvider' => $dataProvider
                                          ]);
    }

    public function actionAllEmployees() {
        Yii::$app->session->set('profileBackUrl', Yii::$app->request->getAbsoluteUrl());

        $searchModel = new EmployeeSearchExt();
        $dataProvider = $searchModel->searchAll(Yii::$app->request->getQueryParams());

        return $this->render('all-employees', ['searchModel' => $searchModel,
                    'dataProvider' => $dataProvider]);
    }
    


}
