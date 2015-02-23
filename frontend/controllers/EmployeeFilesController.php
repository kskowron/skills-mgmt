<?php

namespace frontend\controllers;

use common\models\EmployeeFile;
use MongoRegex;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class EmployeeFilesController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['get'],
                'rules' => [
                    [
                        'actions' => ['get'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Gets a file connected with an employee. This method should be available only for managers allowed to download CV and onepager.
     * @param type $fileId
     * @throws NotFoundHttpException
     */
    public function actionGet($fileId) {
        $file = ArrayHelper::getValue(EmployeeFile::findAll(['_id' => $fileId]), (int) 0, NULL);
        if ($file == NULL) {
            throw new NotFoundHttpException(Yii::t('skills', 'File not found.'));
        } else {
            Yii::$app->response->setDownloadHeaders($file->filename, $file->contentType, false, $file->length)->send();
            echo $file->file->getBytes();
        }
    }

    /**
     * Gets business photo of an employee. Available to any logged-in user.
     * @param type $fileId
     * @throws NotFoundHttpException
     */
    public function actionGetImage($fileId) {
        $imageContentType = new MongoRegex('/^image/');
        $file = ArrayHelper::getValue(EmployeeFile::find()->where(['contentType' => $imageContentType])->andWhere(['_id' => $fileId])->all(), (int) 0, NULL);
        if ($file == NULL) {
            throw new NotFoundHttpException(Yii::t('skills', 'Photo not found.'));
        } else {
            Yii::$app->response->setDownloadHeaders($file->filename, $file->contentType, false, $file->length)->send();
            echo $file->file->getBytes();
        }
    }

}
