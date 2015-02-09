<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\models;

use common\models\Employee;
use common\models\EmployeeSkill;
use common\models\SkillLevel;
use Yii;

/**
 * Class for searching skills of logged employee
 *
 * @author jaroslaw.koza68@gmail.com
 */
class MySkillsSearch extends EmployeeSkillsExtSearch
{
    public $loggedEmployee;

    /**
     * Search is limited only to current logged employee
     * @param type $params
     * @return type
     */
    public function search($params)
    {
        $this->employee_ids = $this->loggedEmployee->id;
        return parent::search($params);
    }

    public function init()
    {
        parent::init();
        $this->loggedEmployee = Employee::findOne(['user_id' => Yii::$app->user->id]);
    }

    public function updateMySkill()
    {
        $model = EmployeeSkill::findOne($this->id);

        if ($model->employee_id != $this->loggedEmployee->id) {
            return false;
        }

        if ($this->skill_level_id) {
            $model->skill_level_id = $this->skill_level_id;
        }

        if ($this->years_of_experience) {
            $model->years_of_experience = $this->years_of_experience;
        }

        if ($this->last_activity) {
            $model->last_activity = $this->last_activity;
        }

        if ($model->save()) {
            return $this->refresh();
        }
        return FALSE;
    }

    /**
     * Delete
     * @param type $id
     * @return boolean
     */
    public function deleteSkill()
    {
        $model = EmployeeSkill::findOne($this->id);
        if ($model->employee_id == $this->loggedEmployee->id) {
            return $model->delete();
        }
        return FALSE;
    }

    /**
     *
     * @param \common\models\base\EmployeeSkill $model
     * @return boolean
     */
    public function addNewSkill(\common\models\base\EmployeeSkill $model)
    {
        if ($this->employee_ids > 0) {
            $model->employee_id = $this->loggedEmployee->id;
            return $model->save();
        }
        return FALSE;
    }

    /**
     * Method save is disabled for search
     * @return boolean
     */
    public function save($runValidation = true, $attributeNames = null)
    {
        return FALSE;
    }
}