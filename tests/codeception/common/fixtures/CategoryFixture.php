<?php

namespace tests\codeception\common\fixtures;

use yii\test\ActiveFixture;

/**
 * User fixture
 */
class CategoryFixture extends ActiveFixture
{
    public $modelClass = 'common\models\Category';
    public $dataFile = '@tests/codeception/common/fixtures/data/category.php';


    public function unload()
    {
        $this->resetTable();
    }
}
