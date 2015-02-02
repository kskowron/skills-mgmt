<?php

namespace common\models;

/**
 * User model
 *
 * @property integer $outlookLogin
 * 
 */
class UserOutlook extends User
{
    public $outlookLogin = true;

    public function rules()
    {
        return \yii\helpers\ArrayHelper::merge(parent::rules(),
                [
                ['outlookLogin', 'safe']
        ]);
    }

    public function validatePassword($password)
    {
        if ($this->outlookLogin) {
            try {
                /* @var $outlook jk\outlook\Outlook */
                $outlook = \Yii::$container->get('jk\outlook\Outlook');
                $outlook->setPassword($password);
                $outlook->setUsername($this->email);
                return $outlook->authenticate();
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
            }
        }
        return parent::validatePassword($password);
    }

    public function checkPasswordPolicy($password)
    {
        return $this->validatePassword($password);
    }

    public static function findByUsername($username)
    {
        //If email is provided find by email
        if (strpos($username, '@')) {
            return static::findOne(['email' => $username, 'status' => self::STATUS_ACTIVE]);
        }
        return parent::findByUsername($username);
    }

}