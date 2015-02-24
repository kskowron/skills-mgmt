<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "employee".
 *
 * @property string $locationName employee location
 * @property string $primaryBusinessProfile employee primary profile
 * @property string $secondaryBusinessProfiles employee secondary profiles
 * @property string $fullname Employee fullname, firstName lastNema
 *                            or use getFullname(true) to reverse order
 */
class Employee extends \common\models\base\Employee
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['location_id'], 'integer'],
            [['location_id', 'firstName', 'lastName'], 'required'],
            [['firstName', 'lastName'], 'string', 'max' => 60]
        ];
    }

    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(),
            [
                'primaryBusinessProfile'=>  \Yii::t('skills','Primary Profile'),
                'secondaryBusinessProfiles'=>  \Yii::t('skills','Secondary Profiles'),
                'locationName'=>  \Yii::t('skills','Location'),
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * Gets location name
     */
    public function getLocationName()
    {
        If (($model = parent::getLocation()->one()) == NULL) {
            return NULL;
        }
        return $model->name;
    }

    public function getFullname($lastFirst = false)
    {
        if ($lastFirst) {
            return $this->lastName.' '.$this->firstName;
        }
        return $this->firstName.' '.$this->lastName;
    }

    public function isAdministrator()
    {
        foreach ($this->employeeRoles as $key => $value) {
            if($value->role == EmployeeRole::ADMINISTRATOR){
                return TRUE;
            }
        }
        return FALSE;
    }

    /**
     * Gets primary busines profile
     * @return string
     */
    public function getPrimaryBusinessProfile(){
        if( ($profile = $this->getEmployeeBusinessProfiles()->orderBy('profile_order')->one())!=NULL){
            return $profile->businessProfile->name;
        }
        return null;
    }

    /**
     * Gets secondary business profiles
     *
     * @return string
     */
    public function getSecondaryBusinessProfiles(){
        if( count(($profiles = $this->getEmployeeBusinessProfiles()->orderBy('profile_order')->all()))>1){
            unset($profiles[0]);
            $out = '';
            foreach ($profiles as $key => $value) {
                $out .= $value->businessProfile->name . ',';
            }
            return $out;
        }
        return null;
    }

    /**
     * Gets set of employee's document - i.e. files but image type file
     * @return array 
     */
    public function getDocuments() {
        $notImage = new \MongoRegex('/^image/');
        return EmployeeFile::find()->where(['contentType' => ['$not' => $notImage]])->andWhere(['owner' => $this->user_id])->all();

    }

    /**
     * Gets full set of employee's files
     * @return array 
     */    
    public function getAllFiles() {
        return EmployeeFile::find()->where(['owner' => (int)$this->user_id])->all();
    }
    
    /**
     * Get employee's business photo
     * @return type
     */
    public function getPhoto() {
        $imageContentType = new \MongoRegex('/^image/');
        return ArrayHelper::getValue(EmployeeFile::find()->where(['contentType' => $imageContentType])->andWhere(['owner' => $this->user_id])->all(), (int) 0, NULL);
    }
            
}
