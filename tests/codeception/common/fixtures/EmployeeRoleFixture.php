<?php

namespace tests\codeception\common\fixtures;

use yii\test\ActiveFixture;

/**
 * User fixture
 */
class EmployeeRoleFixture extends ActiveFixture
{
    public $modelClass = 'common\models\EmployeeRole';
    public $dataFile = '@tests/codeception/common/fixtures/data/employee_role.php';
    public $depends    = [
        'tests\codeception\common\fixtures\EmployeeFixture',
    ];

    public function unload()
    {
        $this->resetTable();
    }
}
