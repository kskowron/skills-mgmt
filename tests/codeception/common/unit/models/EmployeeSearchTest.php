<?php

namespace common\models;

use tests\codeception\common\fixtures\EmployeeFixture;
use tests\codeception\common\unit\DbTestCase;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2015-02-11 at 15:14:53.
 */
class EmployeeSearchTest extends DbTestCase
{
    /**
     * @var EmployeeSearch
     */
    protected $object;

    /**
     * @inheritdoc
     */
    public function fixtures()
    {
        return [
            'user' => [
                'class' => EmployeeFixture::className(),
                'dataFile' => '@tests/codeception/common/fixtures/data/employee.php'
            ],
        ];
    }

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->mockApplication();
        $this->unloadFixtures();
        $this->loadFixtures();
        $this->object = new EmployeeSearch;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        $this->destroyApplication();
    }

    /**
     * @covers common\models\EmployeeSearch::rules
     * @todo   Implement testRules().
     */
    public function testRules()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers common\models\EmployeeSearch::scenarios
     * @todo   Implement testScenarios().
     */
    public function testScenarios()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers common\models\EmployeeSearch::search
     * @todo   Implement testSearch().
     */
    public function testSearch()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers common\models\EmployeeSearch::getEmployeeList
     */
    public function testGetEmployeeList()
    {
        $search = new EmployeeSearch();
        $this->assertEquals('{"more":false,"results":{"id":1,"text":"user1 AABBCC"}}',
            $search->getEmployeeList(null, 1));
        $this->assertEquals('{"more":false,"results":[{"id":"1","text":"user1 AABBCC"},{"id":"2","text":"user2 BBAACC"},{"id":"5","text":"user5 TTAAYY"},{"id":"3","text":"user3AA XXYYZZ"}]}',
            $search->getEmployeeList('AA'));


        $out = [
            "more" => false,
            "results" => [
                "id" => 1,
                "text" => "user1 AABBCC"
            ]
        ];
        $this->assertEquals($out, $search->getEmployeeList(null, 1, false));
    }

    /**
     * @covers common\models\EmployeeSearch::getEmployeWithSkillsGap
     * @todo   Implement testGetEmployeWithSkillsGap().
     */
    public function testGetEmployeWithSkillsGap()
    {
        
    }
}