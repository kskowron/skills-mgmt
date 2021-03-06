<?php

namespace tests\codeception\common\fixtures;

use yii\test\ActiveFixture;

/**
 * User fixture
 */
class UserFixture extends ActiveFixture
{
    public $modelClass = 'common\models\User';
    public $dataFile = '@tests/codeception/common/fixtures/data/user.php';

    public function unload()
    {
        $this->resetTable();
    }

}
