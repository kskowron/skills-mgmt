<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\db\Exception;

/**
 * This is the model class for table "employee_business_profile".
 */
class EmployeeBusinessProfile extends \common\models\base\EmployeeBusinessProfile
{

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['business_profile_id', 'employee_id'], 'required'],
            [['business_profile_id', 'employee_id', 'profile_order'], 'integer']
        ];
    }

    /**
     * Reorder employee business profiles
     *
     * @param array|null $profiles
     * @return boolean
     * @throws Exception2
     */
    protected function reorderProfiles($profiles = null)
    {
        if ($profiles == NULL) {
            $profiles = EmployeeBusinessProfile::findByCondition(['employee_id' => $this->employee_id])->orderBy('profile_order')->all();
        }
        $trans = $this->getDb()->beginTransaction();
        try {
            $i = 0;
            foreach ($profiles as $key => $value) {
                $i++;
                $value->profile_order = $i;
                if (!$value->save()) {
                    throw new Exception("Cannot save reordered business profile for id:".$value->id);
                }
            }
            $trans->commit();
            return TRUE;
        } catch (Exception $ex) {
            $trans->rollBack();
        }
        return FALSE;
    }

    /**
     * Moves employee business profile order down down
     *
     */
    public function moveUp()
    {
        $all  = base\EmployeeBusinessProfile::findByCondition(['employee_id' => $this->employee_id])->orderBy('profile_order')->all();
        $temp = NULL;
        foreach ($all as $key => $profile) {
            if ($profile->id == $this->id && $temp !== NULL) {
                $all[$key - 1] = $profile;
                $all[$key]     = $temp;
                return $this->reorderProfiles($all);
            }
            $temp = $profile;
        }
        return true;
    }

    /**
     * Moves business employee business profile order up
     *
     * @param int $id
     */
    public function moveDown()
    {
        $all  = EmployeeBusinessProfile::findByCondition(['employee_id' => $this->employee_id])->orderBy('profile_order')->all();
        $stop = count($all) - 1;
        foreach ($all as $key => $profile) {
            if ($profile->id == $this->id && $key < $stop) {
                $temp          = $all[$key + 1];
                $all[$key + 1] = $profile;
                $all[$key]     = $temp;
                return $this->reorderProfiles($all);
            }
        }
        return true;
    }

    /**
     * Delete employee business profile with profiles reordering
     */
    public function deleteProfile()
    {
        $trans = $this->getDb()->beginTransaction();
        try {
            if (!$this->delete()) {
                throw new \yii\base\Exception('Cannot delete this record');
            }
            if (!$this->reorderProfiles()) {
                throw new \yii\base\Exception('Cannot reorder business profiles');
            }
            $trans->commit();
            return TRUE;
        } catch (Exception $ex) {
            $trans->rollBack();
        }
        return FALSE;
    }

    public function beforeSave($insert)
    {
        if ($insert) {
            if (($employee = Employee::findOne($this->employee_id)) !== NULL) {
                $this->profile_order =
                    $employee->getEmployeeBusinessProfiles()->count() + 1;
            }else{
                $this->profile_order = 1;
            }
        }
        return parent::beforeSave($insert);
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        return parent::save($runValidation, $attributeNames);
    }
}