<?php

namespace tests\codeception\common\fixtures;

use yii\test\ActiveFixture;

/**
 * User fixture
 */
class EmployeeBusinessProfileFixture extends ActiveFixture
{
    public $modelClass = 'common\models\EmployeeBusinessProfile';
    public $dataFile = '@tests/codeception/common/fixtures/data/employee_business_profile.php';

    public $depends    = [
        'tests\codeception\common\fixtures\EmployeeFixture',
        'tests\codeception\common\fixtures\BusinessProfileFixture'
    ];

    public function unload()
    {
        $this->resetTable();
    }
}
