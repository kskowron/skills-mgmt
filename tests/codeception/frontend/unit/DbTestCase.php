<?php

namespace tests\codeception\frontend\unit;

/**
 * @inheritdoc
 */
//class DbTestCase extends \yii\codeception\DbTestCase
class DbTestCase extends \tests\codeception\common\_support\DbTestCaseWorkaround
{
    public $appConfig = '@tests/codeception/config/frontend/unit.php';
}
