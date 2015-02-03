<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\models;

use common\models\Employee;
use Yii;

/**
 * Class for searching skills of logged employee
 *
 * @author jaroslaw.koza68@gmail.com
 */
class MySkillsSearch extends EmployeeSkillsExtSearch
{

    /**
     * Search is limited only to current logged employee
     * @param type $params
     * @return type
     */
    public function search($params)
    {
        if (($employee = Employee::findOne(['user_id' => Yii::$app->user->id])) !== NULL) {
            $this->employee_ids = $employee->id;
        }
        return parent::search($params);
    }

}