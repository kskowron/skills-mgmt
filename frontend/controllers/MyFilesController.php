<?php

namespace frontend\controllers;

use common\models\EmployeeFile;
use common\models\EmployeeFileSearch;
use jk\helpers\FlashHelper;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class MyFilesController extends Controller {

    public function actionGet($fileId) {

        //Due to unknown reason findOne() method does not work on Windows. Workaround used.
        // $file = $this->findModel($fileId);
        $files = EmployeeFile::findAll(['_id' => $fileId, 'owner' => Yii::$app->user->id]);
        $file = ArrayHelper::getValue($files, (int) 0, NULL);
        if ($file !== NULL) {
            Yii::$app->response->setDownloadHeaders($file->filename, $file->contentType, false, $file->length)->send();
            echo $file->file->getBytes();
        } else {
            throw new NotFoundHttpException(Yii::t('skills', 'File not found or you are not the owner.'));
        }
    }

    public function actionDelete($fileId) {
        $deletedFiles = EmployeeFile::deleteAll(['_id' => $fileId, 'owner' => Yii::$app->user->id]);
        if ($deletedFiles > 0) {
            FlashHelper::setFlashSuccess(Yii::t('skills', 'File deleted.'));
            $this->redirect(['view']);
        } else {
            throw new NotFoundHttpException(Yii::t('skills', 'File not found or you are not the owner.'));
        }
    }

    protected function findModel($id) {
        $model = EmployeeFile::findOne($id);
        if ($model !== null) {
            return $model;
        }
        throw new NotFoundHttpException();
    }

    public function actionView() {
        $model = new EmployeeFile();

        $fileSearch = new EmployeeFileSearch();
        $files = $fileSearch->searchByEmployee(['owner' => Yii::$app->user->id]);
        $uploadDisabled = ($files->getCount() < 3) ? false : true;

        $imageTypes = ['image/png', 'image/jpeg', 'image/jpg'];
        $docTypes = ['application/msword', 
                     'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
        $presentationTypes = ['application/vnd.ms-powerpoint', 
                              'application/vnd.openxmlformats-officedocument.presentationml.slideshow', 
                              'application/vnd.openxmlformats-officedocument.presentationml.presentation'];
        $acceptableFileTypes = ArrayHelper::merge($imageTypes, $presentationTypes, $docTypes);

        return $this->render('view', ['dataProvider' => $files, 
                                      'model' => $model, 
                                      'uploadDisabled' => $uploadDisabled, 
                                      'acceptableFileTypes' => $acceptableFileTypes]);
    }

    public function actionUpload() {
        $model = new EmployeeFile();

        if ($model->load(Yii::$app->request->post())) {
            $file = UploadedFile::getInstance($model, 'file');
            $model->filename = $file->name;
            $model->contentType = $file->type;
            $model->description = 'This is my description';
            $model->owner = Yii::$app->user->id;
            $model->file = $file;

            if ($model->save()) {
                FlashHelper::setFlashSuccess(Yii::t('skills', 'File uploaded.'));
            } else {
                FlashHelper::setFlashError(Yii::t('skills', 'Error happened when uploading. Please contact administrator.'));
            }
        }

        $this->redirect(['view']);
    }

}
