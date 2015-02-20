<?php

namespace frontend\controllers;

use common\models\Employee;
use common\models\EmployeeSkill;
use common\models\Skill;
use common\models\SkillLevelSearch;
use common\models\User;
use frontend\models\AvailableSkillsSearch;
use frontend\models\MySkillsSearch;
use jarekkozak\helpers\FlashHelper;
use common\lib\util\SkillsHelper;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;

class MySkillsController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['list','add-skill','delete-skill','gap-list','update-skill'],
                'rules' => [
                    [
                        'actions' => ['list','add-skill','delete-skill','gap-list','update-skill'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'deleteSkill' => ['post'],
                ],
            ],
        ];
    }

    /**
     * List of all skills possesed by logged employee
     * @return string
     */
    public function actionList()
    {
        $searchModel  = new MySkillsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        $searchLevelsModel = new SkillLevelSearch();
        $levels            = ArrayHelper::map($searchLevelsModel->getLevelList()->all(),
                'id', 'name');

        // validate if there is a editable input saved via AJAX
        if (Yii::$app->request->post('hasEditable') && Yii::$app->request->post('editableKey')) {

            // instantiate EmployeeSkillsSearch model for saving
            $model = MySkillsSearch::findOne(Yii::$app->request->post('editableKey'));

            // store a default json response as desired by editable
            $out = Json::encode(['output' => '', 'message' => '']);

            // fetch the first entry in posted data (there should 
            // only be one entry anyway in this array for an 
            // editable submission)
            // - $posted is the posted data for Book without any indexes
            // - $post is the converted array for single model validation

            $forname        = $model->formName();
            $post           = [];
            $posted         = current(Yii::$app->request->post($forname));
            $post[$forname] = $posted;

            // load model like any single model validation
            if ($model->load($post)) {

                $output = '';
                // can save model or do something before saving model
                if (isset($posted['level_name'])) {
                    $output = ArrayHelper::getValue($levels,
                            $posted['level_name'], NULL);
                    if ($output !== NULL) {
                        $model->skill_level_id = $posted['level_name'];
                    }
                }
                $model->updateMySkill();
                $out = Json::encode(['output' => $output, 'message' => '']);
            }
            // return ajax json encoded response and exit
            echo $out;
            return;
        }

        return $this->render('list',
                [
                'employee' => $searchModel->loggedEmployee,
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
                'levels' => $levels,
                'years' => SkillsHelper::getYearsList(),
                'duration' => SkillsHelper::getDurationList()
        ]);
    }

    public function actionAddSkill($id)
    {

        if (($skill = Skill::findOne($id)) == NULL) {
            throw new NotFoundHttpException();
        };

        $searchModel = new MySkillsSearch();
        $employee    = $searchModel->loggedEmployee;

        $model = new EmployeeSkill();

        if ($model->load(Yii::$app->request->post())) {
            $model->employee_id = $employee->id;
            $model->skill_id    = $skill->id;
            if ($model->save()) {
                FlashHelper::setFlashSuccess(Yii::t('skills',
                        'Your new skill has been created'));
                return $this->redirect(['gap-list']);
            } else {
                FlashHelper::setFlashError(Yii::t('skills',
                        'Skill has not been created - error!'));
            }
        }

        return $this->render('create',
                [
                'model' => $model,
                'skill' => $skill,
                'employee' => $employee,
                'levels' => SkillsHelper::getLevels(),
                'last_activity' => SkillsHelper::getYearsList(),
                'years_of_experience' => SkillsHelper::getDurationList()
        ]);
    }

    public function actionUpdateSkill($id)
    {

        if (($model = \common\models\base\EmployeeSkill::findOne($id)) == NULL) {
            throw new NotFoundHttpException();
        };

        $searchModel = new MySkillsSearch();
        $employee    = $searchModel->loggedEmployee;

        if ($model->load(Yii::$app->request->post())) {
            $model->employee_id = $employee->id;
            if ($model->save()) {
                FlashHelper::setFlashSuccess(Yii::t('skills',
                        'Your new skill has been updated'));
                return $this->redirect(['list']);
            } else {
                FlashHelper::setFlashError(Yii::t('skills',
                        'Skill has not been updated - error!'));
            }
        }

        return $this->render('update',
                [
                'model' => $model,
                'skill' => $model->skill,
                'employee' => $employee,
                'levels' => SkillsHelper::getLevels(),
                'last_activity' => SkillsHelper::getYearsList(),
                'years_of_experience' => SkillsHelper::getDurationList()
        ]);
    }

    /**
     * List of all skills not possesed by logged employee
     * @return string
     */
    public function actionGapList()
    {
        /* @var $user User */
        $user         = Yii::$app->user;
        $searchModel  = new AvailableSkillsSearch();
        $employee     = Employee::findOne(['user_id' => $user->id]);
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('gap-list',
                [
                'employee' => $employee,
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
        ]);
    }

    public function actionDeleteSkill($id)
    {
        if (!Yii::$app->request->isPost) {
            throw new HttpException(400);
        }
        if (($model = MySkillsSearch::findOne($id)) == NULL) {
            throw new NotFoundHttpException();
        }
        if ($model->deleteSkill()) {
            FlashHelper::setFlashSuccess(Yii::t('skills',
                    'You skill has been removed'));
        } else {

        }
        return $this->redirect(['list']);
    }
}