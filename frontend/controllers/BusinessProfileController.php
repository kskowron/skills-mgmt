<?php

namespace frontend\controllers;

use common\models\BusinessProfile;
use common\models\BusinessProfileSearch;
use frontend\models\EmployeeSearchExt;
use frontend\models\SearchBusinessProfileForm;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class BusinessProfileController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['view'],
                'rules' => [
                    [
                        'actions' => ['view'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionView() {
        Yii::$app->session->set('profileBackUrl', Yii::$app->request->getAbsoluteUrl());
        $params = Yii::$app->request->getQueryParams();
        $form = new SearchBusinessProfileForm();
        
        if(ArrayHelper::keyExists($form->formName(), $params)) {
            $form->load($params);
            $form->validate();
            $formParams = ArrayHelper::remove($params, $form->formName());
            $searchParams = ArrayHelper::merge($params, $formParams);
        } else {
            $searchParams = $params;
            $form->id = ArrayHelper::getValue($searchParams, 'id', NULL);
        }
        
        $profileSearch = new BusinessProfileSearch();
        $profiles = ArrayHelper::map($profileSearch->search($searchParams)->getModels(), 'id', 'name');

        $businessProfile = BusinessProfile::findOne($searchParams['id']);
        if ($businessProfile == NULL) {
            throw new NotFoundHttpException(Yii::t('skills', 'The requested business profile does not exist.'));
        }

        $employeesSearch = new EmployeeSearchExt();
        $dataProvider = $employeesSearch->searchByBusinessProfile($searchParams);
        
        return $this->render('view', ['businessProfile' => $businessProfile, 
                                       'profiles' => $profiles, 
                                       'model' => $form,
                                       'dataProvider' => $dataProvider
                                      ]);
    }

}
