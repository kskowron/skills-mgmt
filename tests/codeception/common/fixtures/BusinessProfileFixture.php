<?php

namespace tests\codeception\common\fixtures;

use yii\test\ActiveFixture;

/**
 * User fixture
 */
class BusinessProfileFixture extends ActiveFixture
{
    public $modelClass = 'common\models\BusinessProfile';
    public $dataFile = '@tests/codeception/common/fixtures/data/business_profile.php';


    public function unload()
    {
        $this->resetTable();
    }
}
