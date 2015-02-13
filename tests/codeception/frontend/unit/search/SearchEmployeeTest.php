<?php

namespace tests\codeception\frontend\unit\search;

use Codeception\Util\Debug;
use frontend\models\EmployeeSearchExt;
use tests\codeception\frontend\fixtures\EmployeeFixture;
use tests\codeception\frontend\fixtures\EmployeeSkillFixture;
use tests\codeception\frontend\fixtures\LocationFixture;
use tests\codeception\frontend\fixtures\SkillCategoryFixture;
use tests\codeception\frontend\fixtures\SkillFixture;
use tests\codeception\frontend\fixtures\SkillLevelFixture;
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
                                      'dataFile' => '@tests/codeception/frontend/fixtures/data/skills_categories.php'],
                     'skills'     => ['class' => SkillFixture::className(),
                                      'dataFile' => '@tests/codeception/frontend/fixtures/data/skills.php'],
                     'levels'     => ['class' => SkillLevelFixture::className(),
                                      'dataFile' => '@tests/codeception/frontend/fixtures/data/skill_levels.php'],
                     'emp_skills' => ['class' => EmployeeSkillFixture::className(),
                                      'dataFile' => '@tests/codeception/frontend/fixtures/data/employee_skills.php']];
        return $fixtures;
    }

    /**
     * Everybody should have at least one skill
     */
    public function testEveryHasASkill() {
        $params = [
            'skills_list' => [10000],
            'skill_level' => 10001
        ];
        $employeeSearch = new EmployeeSearchExt();
        $employees = $employeeSearch->searchBySkills($params);
        $numberOfEmployees = $employees->getCount();        
        $this->assertEquals(5, $numberOfEmployees, "5 people expected to know Java, $numberOfEmployees found");
        }


        /**
         * Nobody whould be find when passed skill id not assigned to any employee.
         */
    public function testNobodyHasASkill() {
        $params = [
            'skills_list' => [10009],
            'skill_level' => 10001
        ];        
        $employeeSearch = new EmployeeSearchExt();
        $employees = $employeeSearch->searchBySkills($params);
        $numberOfEmployees = $employees->getCount();
        $this->assertEquals(0, $numberOfEmployees, "Too many employees found. 0 expected, $numberOfEmployees found.");
    }
    
    /**
     * Nobody should be find when no skills level id passed as a parameter to search method.
     */
    public function testNobodyFoundWhenSkillLevelNotPassed() {
        $params = ['skills_list' => [10000]];
        $employeeSearch = new EmployeeSearchExt();
        $employees = $employeeSearch->searchBySkills($params);
        $numberOfEmployees = $employees->getCount();
        $this->assertEquals(0, $numberOfEmployees, "No employees should be found. Instead $numberOfEmployees found.");
    }

    /**
     * Nobody should be found when no skills list passed as a parameter to search method.
     */
    public function testNobodyFoundWhenSkillsNotPassed() {
        $params = ['skill_level' => 10001];
        $employeeSearch = new EmployeeSearchExt();
        $employees = $employeeSearch->searchBySkills($params);
        $numberOfEmployees = $employees->getCount();
        $this->assertEquals(0, $numberOfEmployees, "No employees should be found. Instead $numberOfEmployees found.");
    }
    
    /**
     * Nobody found when search params array has no elements.
     */
    public function testNobodyFoundWhenNoSearchCriteriaPassed() {
        $params = [];
        $employeeSearch = new EmployeeSearchExt();
        $employees = $employeeSearch->searchBySkills($params);
        $numberOfEmployees = $employees->getCount();
        $this->assertEquals(0, $numberOfEmployees, "No employees should be found. Instead $numberOfEmployees found.");        
    }

    /**
     * Nobody should be find when instead of search params array NULL is passed.
     */
    public function testNobodyFoundWhenSearchCriteriaIsNull() {
        $employeeSearch = new EmployeeSearchExt();
        $employees = $employeeSearch->searchBySkills(NULL);
        $numberOfEmployees = $employees->getCount();
        $this->assertEquals(0, $numberOfEmployees, "No employees should be found. Instead $numberOfEmployees found.");        
    }    

    /**
     * Looking for people working with SQL, JavaScript and PHP - they can be newbies.
     * Everybody knows SQL, but only 2 persons know PHP and Javascript.
     * In the skills list I pass Java, JavaScript and PHP ids.
     * I expect to get only 2 rows as search results.
     */
    public function testEmployeesLimitedBySkillNumber() {
        $params = [
            'skills_list' => [10001, 10002, 10003],
            'skill_level' => 10001
        ];
        $employeeSearch = new EmployeeSearchExt();
        $employees = $employeeSearch->searchBySkills($params);        
        $numberOfEmployees = $employees->getCount();
        $this->assertEquals(2, $numberOfEmployees, "2 employees expected. Instead $numberOfEmployees found.");                
    }

    /**
     * Looking for experts in business analysis and team building.
     * Two people knows business analysis and team building.
     * One of them knows both on expert level.
     * The other knows team building only on senior level.
     * I expect to get only one row as search result.
     */
    public function testEmployeesLimitedBySkillNumberAndLevel() {
        $params = [
            'skills_list' => [10006, 10010],
            'skill_level' => 10005
        ];
        $employeeSearch = new EmployeeSearchExt();
        $employees = $employeeSearch->searchBySkills($params);        
        $numberOfEmployees = $employees->getCount();
        $this->assertEquals(1, $numberOfEmployees, "1 employee expected. Instead $numberOfEmployees found.");                
    }

}
