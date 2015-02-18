<?php

namespace frontend\controllers;

use common\models\BusinessProfile;
use common\models\BusinessProfileSearch;
use frontend\models\EmployeeSearchExt;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class BusinessProfileController extends Controller {

    public function actionIndex() {
        $businessProfileSearch = new BusinessProfileSearch();
        $dataProvider = $businessProfileSearch->search(NULL);
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionView() {
        $params = Yii::$app->request->getQueryParams();
        if (ArrayHelper::getValue($params, 'id', NULL) == NULL) {
            $this->redirect(['business-profile/index']);
        } else {
            $businessProfile = BusinessProfile::findOne($params['id']);
            if ($businessProfile == NULL) {
                throw new NotFoundHttpException(Yii::t('skills', Yii::t('skills', 'The requested business profile does not exist.')));
            }
            $employeesSearch = new EmployeeSearchExt();
            $dataProvider = $employeesSearch->searchByBusinessProfile($params);
        }

        return $this->render('view', ['businessProfile' => $businessProfile, 'dataProvider' => $dataProvider, 'searchModel' => $employeesSearch]);
    }

}
