<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\lib\mail;

use common\models\Employee;
use common\models\SkillSearch;
use Exception;
use Swift_RfcComplianceException;
use yii\base\Object;
use yii\log\Logger;

/**
 * Class for sending emails to employees who have not provided full information
 * about available skills
 *
 * @author Jarosław Kozak <jaroslaw.kozak68@gmail.com>
 */
class UnassignedSkillsNotice extends Object
{
    public $textonly    = false;
    public $employee_id = null;
    protected $employee = null;
    protected $skills   = [];

    public function init()
    {
        parent::init();
        $this->employee = Employee::findOne($this->employee_id);
        if ($this->employee !== null) {
            $skills       = new SkillSearch();
            $this->skills = $skills->getUnassignedSkillsQuery($this->employee->id)->all();
        }
    }

    function getEmployee()
    {
        return $this->employee;
    }

    function getSkills()
    {
        return $this->skills;
    }

    /**
     * Gets number of unassigned skills
     *
     * @return int
     */
    public function getCountUnassignedSkills()
    {
        return count($this->skills);
    }

    /**
     * Sends an email with a link, for adding missing skills info.
     *
     * @return boolean whether the email was send
     */
    public function sendMail()
    {
        if (!($this->getCountUnassignedSkills() > 0)) {
            return FALSE;
        }

        $ret = FALSE;
        try {
            $template = [];
            if (!$this->textonly) {
                $template['html'] = 'unassignedSkills-html';
            }
            $template['text'] = 'unassignedSkills-text';

            $ret = \Yii::$app->mailer->compose($template,
                    ['employee' => $this->employee, 'skills' => $this->skills])
                ->setFrom([\Yii::$app->params['supportEmail'] => \Yii::$app->name.' robot'])
                ->setTo($this->employee->user->email)
                ->setSubject('You have unassigned skills')
                ->send();
        } catch (Exception $exc) {
            \Yii::$app->log->logger->log($exc->getMessage(), Logger::LEVEL_ERROR);
        } catch (Swift_RfcComplianceException $exc) {
            \Yii::$app->log->logger->log($exc->getMessage(), Logger::LEVEL_ERROR);
        }

        if ($ret == FALSE) {
            //Log error in case of error
            \Yii::$app->log->logger->log('Unassignet skills notice has not been sent to:'.$this->employee->id.'-'.$this->employee->fullName,
                Logger::LEVEL_ERROR);
        };
        return $ret;
    }
}