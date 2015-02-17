<?php

namespace tests\codeception\common\fixtures;

use yii\test\ActiveFixture;

/**
 * Skill fixture
 */
class SkillFixture extends ActiveFixture
{
    public $modelClass = 'common\models\Skill';
    public $depends    = [
        'tests\codeception\common\fixtures\CategoryFixture',
        'tests\codeception\common\fixtures\SkillLevelFixture',
    ];
    public $dataFile = '@tests/codeception/common/fixtures/data/skill.php';

    public function unload()
    {
        $this->resetTable();
    }
}