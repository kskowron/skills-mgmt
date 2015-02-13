<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace console\controllers;

use yii\console\Controller;
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
    public $first;

    public function options($actionID)
    {
        $out = parent::options($actionID);
        if($actionID == 'unassigned-skills'){
            $out[] = 'first';
        }
        return $out;
    }

    /**
     *
     * @param string $params  default null
     * Parametr to be set before start action
     * @return int
     */
    public function actionUnassignedSkills($params = null){

        echo "Employees with gap of skills\n";

        $employee = \common\models\Employee::find();
        /* @var $value common\models\Employee */
        foreach ($employee->batch() as $key => $value) {
            //echo $value->fullName . "\n";
        }
        return 0;
    }

    public function actionSecond(){
        return 0;
    }

}