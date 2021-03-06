<?php

namespace common\lib\mail;

use tests\codeception\common\fixtures\CategoryFixture;
use tests\codeception\common\fixtures\EmployeeFixture;
use tests\codeception\common\fixtures\EmployeeSkillFixture;
use tests\codeception\common\fixtures\SkillFixture;
use tests\codeception\common\fixtures\SkillLevelFixture;
use tests\codeception\common\fixtures\UserFixture;
use tests\codeception\common\unit\DbTestCase;
use Yii;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2015-02-17 at 09:19:33.
 */
class UnassignedSkillsNoticeTest extends DbTestCase
{
    /**
     * @inheritdoc
     */
    public function fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => '@tests/codeception/common/fixtures/data/user.php'
            ],
            'employee' => [
                'class' => EmployeeFixture::className(),
                'dataFile' => '@tests/codeception/common/fixtures/data/employee.php'
            ],
            'category' => [
                'class' => CategoryFixture::className(),
                'dataFile' => '@tests/codeception/common/fixtures/data/category.php'
            ],
            'level' => [
                'class' => SkillLevelFixture::className(),
                'dataFile' => '@tests/codeception/common/fixtures/data/skill_level.php'
            ],
            'skill' => [
                'class' => SkillFixture::className(),
                'dataFile' => '@tests/codeception/common/fixtures/data/skill.php'
            ],
            'employee_skill' => [
                'class' => EmployeeSkillFixture::className(),
                'dataFile' => '@tests/codeception/common/fixtures/data/employee_skill.php'
            ],
            'employee_businessprofile' => [
                'class' => \tests\codeception\common\fixtures\EmployeeBusinessProfileFixture::className(),
                'dataFile' => '@tests/codeception/common/fixtures/data/employee_business_profile.php'
            ],
        ];
    }

    private function getMessageFile()
    {
        return Yii::getAlias(Yii::$app->mailer->fileTransportPath) . '/testing_message.eml';
    }

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        parent::setUp();
        Yii::$app->mailer->fileTransportCallback = function ($mailer, $message) {
            return 'testing_message.eml';
        };

    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        parent::tearDown();
        @unlink($this->getMessageFile());
    }

    /**
     * @covers common\lib\mail\UnassignedSkillsNotice::getCountUnassignedSkills()
     */
    public function testNoticeEmployee1()
    {
        $object = new UnassignedSkillsNotice(['employee_id'=>1]);
        $this->assertNotNull($object->employee);
        $this->assertEquals(0,$object->getCountUnassignedSkills());
        
    }

    /**
     * @covers common\lib\mail\UnassignedSkillsNotice::getCountUnassignedSkills()
     */
    public function testNoticeEmployeeX()
    {
        $object = new UnassignedSkillsNotice(['employee_id'=>null]);
        $this->assertNull($object->employee);
        $this->assertEquals(0,$object->getCountUnassignedSkills());

        $object = new UnassignedSkillsNotice(['employee_id'=>999999]);
        $this->assertNull($object->employee);
        $this->assertEquals(0,$object->getCountUnassignedSkills());

    }
    
    /**
     * @covers common\lib\mail\UnassignedSkillsNotice::getCountUnassignedSkills()
     */
    public function testNoticeEmployee2()
    {
        $object = new UnassignedSkillsNotice(['employee_id'=>2]);
        $this->assertNotNull($object->employee);
        $this->assertEquals(5,$object->getCountUnassignedSkills());

        $this->assertTrue($object->sendMail());

        $this->assertTrue(file_exists($this->getMessageFile()));

        $message = file_get_contents($this->getMessageFile());
        
        $this->assertContains(Yii::$app->params['supportEmail'], $message);
        $this->assertContains($object->employee->user->email, $message);
        $this->assertContains($object->employee->user->email, $message);

        $needle = "CATEGORY4/SKILL411";
        $this->assertContains($needle, $message);
        $needle = "CATEGORY5/SKILL515";
        $this->assertContains($needle, $message);
        
        $needle = "<p> - CATEGORY4/SKILL411";
        $this->assertContains($needle, $message);

        $needle ="<!DOCTYPE html PUBLIC";
        $this->assertContains($needle, $message);
    }
    /**
     * @covers common\lib\mail\UnassignedSkillsNotice::getCountUnassignedSkills()
     */
    public function testNoticeEmployee2TextOnly()
    {
        $object = new UnassignedSkillsNotice(['employee_id'=>2,'textonly'=>true]);
        $this->assertNotNull($object->employee);
        $this->assertEquals(5,$object->getCountUnassignedSkills());

        $this->assertTrue($object->sendMail());

        $this->assertTrue(file_exists($this->getMessageFile()));

        $message = file_get_contents($this->getMessageFile());

        $this->assertContains(Yii::$app->params['supportEmail'], $message);
        $this->assertContains($object->employee->user->email, $message);
        $this->assertContains($object->employee->user->email, $message);

        $needle = "CATEGORY4/SKILL412";
        $this->assertContains($needle, $message);
        $needle = "CATEGORY5/SKILL513";
        $this->assertContains($needle, $message);

        $needle = "<p> - CATEGORY4/SKILL411</p>";
        $this->assertNotContains($needle, $message);

        $needle ="<!DOCTYPE html PUBLIC";
        $this->assertNotContains($needle, $message);
    }


}