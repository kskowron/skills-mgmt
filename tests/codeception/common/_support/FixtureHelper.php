<?php

namespace tests\codeception\common\_support;

use Codeception\Module;
use tests\codeception\common\fixtures\CategoryFixture;
use tests\codeception\common\fixtures\EmployeeFixture;
use tests\codeception\common\fixtures\EmployeeSkillFixture;
use tests\codeception\common\fixtures\SkillFixture;
use tests\codeception\common\fixtures\SkillLevelFixture;
use tests\codeception\common\fixtures\UserFixture;
use yii\test\FixtureTrait;

/**
 * This helper is used to populate database with needed fixtures before any tests should be run.
 * For example - populate database with demo login user that should be used in acceptance and functional tests.
 * All fixtures will be loaded before suite will be starded and unloaded after it.
 */
class FixtureHelper extends Module
{

    /**
     * Redeclare visibility because codeception includes all public methods that not starts from "_"
     * and not excluded by module settings, in actor class.
     */
    use FixtureTrait {
        loadFixtures as protected;
        fixtures as protected;
        globalFixtures as protected;
        unloadFixtures as protected;
        getFixtures as protected;
        getFixture as protected;
    }

    /**
     * Method called before any suite tests run. Loads User fixture login user
     * to use in acceptance and functional tests.
     * @param array $settings
     */
    public function _beforeSuite($settings = [])
    {
        $this->unloadFixtures();
        $this->loadFixtures();
    }

    /**
     * Method is called after all suite tests run
     */
    public function _afterSuite()
    {
        $this->unloadFixtures();
    }

    /**
     * @inheritdoc
     */
    public function fixtures()
    {
        return \tests\codeception\common\fixtures\FixturesMapHelper::getFixtures();
//
//        [
//            'employee' => [
//                'class' => EmployeeFixture::className(),
//            ],
//            'category' => [
//                'class' => CategoryFixture::className(),
//            ],
//            'level' => [
//                'class' => SkillLevelFixture::className(),
//            ],
//            'skill' => [
//                'class' => SkillFixture::className(),
//                'dataFile' => '@tests/codeception/common/fixtures/data/skill.php',
//                //'dataFile' => FALSE,
//            ],
//            'employee_skill' => [
//                'class' => EmployeeSkillFixture::className(),
//                'dataFile' => '@tests/codeception/common/fixtures/data/employee_skill.php',
//                //'dataFile' => FALSE,
//
//            ],
//            'location' => [
//                'class' => \tests\codeception\common\fixtures\LocationFixture::className(),
//                //'dataFile' => FALSE,
//
//            ],
//            'user' => [
//                'class' => UserFixture::className(),
//                'dataFile' => '@tests/codeception/common/fixtures/data/user.php',
//                //'dataFile' => FALSE,
//            ],
//
//        ];
    }
}
