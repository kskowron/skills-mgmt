<?php

namespace tests\codeception\frontend\unit\models;

use frontend\models\ResetPasswordForm;
use tests\codeception\common\fixtures\CategoryFixture;
use tests\codeception\common\fixtures\EmployeeFixture;
use tests\codeception\common\fixtures\EmployeeSkillFixture;
use tests\codeception\common\fixtures\SkillFixture;
use tests\codeception\common\fixtures\SkillLevelFixture;
use tests\codeception\common\fixtures\UserFixture;
use tests\codeception\frontend\unit\DbTestCase;

class ResetPasswordFormTest extends DbTestCase
{

    /**
     * @expectedException \yii\base\InvalidParamException
     */
    public function testResetWrongToken()
    {
        new ResetPasswordForm('notexistingtoken_1391882543');
    }

    /**
     * @expectedException \yii\base\InvalidParamException
     */
    public function testResetEmptyToken()
    {
        new ResetPasswordForm('');
    }

    public function testResetCorrectToken()
    {
        $form = new ResetPasswordForm($this->user[0]['password_reset_token']);
        expect('password should be resetted', $form->resetPassword())->true();
    }

    public function fixtures()
    {
        return \tests\codeception\common\fixtures\FixturesMapHelper::getFixturesReset([
                'user' => [
                    'class' => UserFixture::className(),
                    'dataFile' => '@tests/codeception/frontend/unit/fixtures/data/models/user.php'
                ],
        ]);
    }

}
