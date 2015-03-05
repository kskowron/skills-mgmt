<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace tests\codeception\common\_support;

/**
 * This is workaround to be able to run unit tests under
 * Netbeans
 *
 * @author jarosław Kozak <jaroslaw.kozak68@gmail.com>
 */
class TestCaseWorkaround extends \yii\codeception\TestCase
{

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        if ($this->actor != FALSE) {
            parent::setUp();
        } else {
            $this->mockApplication();
            $this->unloadFixtures();
            $this->loadFixtures();
        }
    }

    /**
     * @inheritdoc
     */
    protected function tearDown()
    {
        if ($this->actor != FALSE) {
            parent::tearDown();
        } else {
            $this->destroyApplication();
        }
    }
}