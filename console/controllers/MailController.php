<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace console\controllers;

use common\models\Employee;
use common\models\SkillSearch;
use yii\base\Exception;
use yii\console\Controller;
use yii\log\Logger;

/**
 * Description of MailController
 *
 * @author jarek
 */
class MailController extends Controller
{
    /**
     * @var string
     * First parameter to be set
     */
    public $textonly = false;

    public function options($actionID)
    {
        $out = parent::options($actionID);
        if ($actionID == 'unassigned-skills') {
            $out[] = 'textonly';
        }
        return $out;
    }

    /**
     *
     * @param string $params  default null
     * Parametr to be set before start action
     * @return int
     */
    public function actionUnassignedSkills($id = null)
    {
        $this->stdout("Start sendig notice to employees with gap of skills:".$id);
        if ($id !== null) {
            $employeeQuery = Employee::find()->where(['id' => (int) $id]);
        } else {
            $employeeQuery = Employee::find();
        }

        $count = 0;
        /* @var $employee Employee */
        foreach ($employeeQuery->each() as $employee) {
            $notice = new \common\lib\mail\UnassignedSkillsNotice(['employee_id' => $employee->id,
                "textonly" => $this->textonly]);
            if ($notice->getCountUnassignedSkills() > 0) {
                // Send email to employee
                if ($notice->sendMail() == TRUE) {
                    $this->stdout("Send to:".$employee->fullName);
                    $count++;
                }
            }
        }
        $this->stdout("End of sending notice to employees. Sent:".$count);
        return 0;
    }

    public function stdout($string)
    {
        return parent::stdout($string."\n");
    }
}