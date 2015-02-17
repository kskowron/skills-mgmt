<?php

namespace tests\codeception\common\fixtures;

use yii\test\ActiveFixture;

/**
 * Employee Skill fixture
 */
class EmployeeSkillFixture extends ActiveFixture
{
    public $modelClass = 'common\models\EmployeeSkill';
    public $depends    = [
        'tests\codeception\common\fixtures\SkillFixture',
        'tests\codeception\common\fixtures\EmployeeFixture',
        'tests\codeception\common\fixtures\SkillLevelFixture'
    ];
    public $dataFile = '@tests/codeception/common/fixtures/data/employee_skill.php';

    public function unload()
    {
        $this->resetTable();
    }

}