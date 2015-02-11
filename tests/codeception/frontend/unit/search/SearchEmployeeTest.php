<?php

namespace tests\codeception\frontend\unit\search;

use tests\codeception\frontend\fixtures\EmployeeFixture;
use tests\codeception\frontend\fixtures\LocationFixture;
use tests\codeception\frontend\fixtures\SkillCategoryFixture;
use tests\codeception\frontend\fixtures\UserFixture;
use tests\codeception\frontend\unit\DbTestCase;

/**
 * Description of SearchEmployeeTest
 *
 * @author ksawery.skowron
 */
class SearchEmployeeTest extends DbTestCase {

    public function setUp() {
        parent::setUp();
    }

    public function tearDown() {
        parent::tearDown();
    }

    public function fixtures() {
        $fixtures = ['location'   => ['class' => LocationFixture::className(),
                                      'dataFile' => '@tests/codeception/frontend/fixtures/data/locations.php'],
                     'user'       => ['class' => UserFixture::className(),
                                      'dataFile' => '@tests/codeception/frontend/fixtures/data/users.php'],
                     'employee'   => ['class' => EmployeeFixture::className(),
                                      'dataFile' => '@tests/codeception/frontend/fixtures/data/employees.php'],
                     'categories' => ['class' => SkillCategoryFixture::className(),
                                      'dataFile' => '@tests/codeception/frontend/fixtures/data/skills_categories.php']];
        return $fixtures;
    }

    public function testSpr() {
        
    }

}
