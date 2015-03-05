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
                /* @var $outlook jarekkozak\outlook\Outlook */
                $outlook = \Yii::$container->get('jarekkozak\outlook\Outlook');
                $outlook->setPassword($password);
                $outlook->setUsername($this->email);
                if($outlook->authenticate()){
                    \Yii::$app->log->getLogger()->log($this->username . ' logged via '. $outlook->getServer(),  \yii\log\Logger::LEVEL_INFO);
                    return TRUE;
                }else{
                    \Yii::$app->log->getLogger()->log($this->username . ' failed login via '. $outlook->getServer(),  \yii\log\Logger::LEVEL_WARNING);
                    return FALSE;
                }
            } catch (Exception $exc) {
                \Yii::$app->log->getLogger()->log($exc,  \yii\log\Logger::LEVEL_ERROR);
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