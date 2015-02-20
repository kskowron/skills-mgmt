<?php

namespace tests\codeception\common\unit;

/**
 * @inheritdoc
 */
//class DbTestCase extends \yii\codeception\DbTestCase
class DbTestCase extends \tests\codeception\common\_support\DbTestCaseWorkaround
{
    public $appConfig = '@tests/codeception/config/common/unit.php';
}
