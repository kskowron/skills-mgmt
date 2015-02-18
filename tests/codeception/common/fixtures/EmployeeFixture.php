<?php

namespace tests\codeception\common\fixtures;

use yii\test\ActiveFixture;

/**
 * User fixture
 */
class EmployeeFixture extends ActiveFixture
{
    public $modelClass = 'common\models\Employee';
    public $depends = [
        'tests\codeception\common\fixtures\UserFixture',
        'tests\codeception\common\fixtures\LocationFixture',
        ];

    public $dataFile = '@tests/codeception/common/fixtures/data/employee.php';

    public function unload()
    {
        $this->resetTable();
    }
}
