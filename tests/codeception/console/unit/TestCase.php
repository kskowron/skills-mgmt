<?php

namespace tests\codeception\console\unit;

/**
 * @inheritdoc
 */
//class TestCase extends \yii\codeception\TestCase
class TestCase extends \tests\codeception\common\_support\TestCaseWorkaround
{
    public $appConfig = '@tests/codeception/config/console/unit.php';
}
