<?php

namespace tests\codeception\frontend\unit;

/**
 * @inheritdoc
 */
//class TestCase extends \yii\codeception\TestCase
class TestCase extends \tests\codeception\common\_support\TestCaseWorkaround
{
    public $appConfig = '@tests/codeception/config/frontend/unit.php';
}
