<?php

namespace tests\codeception\common\fixtures;

use yii\test\ActiveFixture;

/**
 * SkillLevel fixture
 */
class SkillLevelFixture extends ActiveFixture
{
    public $modelClass = 'common\models\SkillLevel';
    public $dataFile = '@tests/codeception/common/fixtures/data/skill_level.php';

    public function unload()
    {
        $this->resetTable();
    }

}
