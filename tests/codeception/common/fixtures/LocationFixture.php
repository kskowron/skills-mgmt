<?php

namespace tests\codeception\common\fixtures;

use yii\test\ActiveFixture;

/**
 * User fixture
 */
class LocationFixture extends ActiveFixture
{
    public $modelClass = 'common\models\Location';
    public $dataFile = '@tests/codeception/common/fixtures/data/location.php';

    public function unload()
    {
        $this->resetTable();
    }
}
