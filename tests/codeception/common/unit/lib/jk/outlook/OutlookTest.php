<?php

namespace jk\outlook;

/**
 * Test class for outlook connection. In order to run test you have to define
 * property file in $HOME/.secret/skills-secret with attributes
 * server=xxxxxx
 * username=XXXXXXX
 * password=XXXXXX
 */
// \PHPUnit_Framework_TestCase
class OutlookTest extends \tests\codeception\common\unit\TestCase
{
    /**
     * @var Outlook
     */
    protected $property;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->property = new \jk\sys\PropertiesFile([
            'filename' => '$HOME/.secret/skills-secret'
        ]);

        if ($this->property->getProperty('exchangeServer') == NULL) {
            echo 'Property file does not exist:';
            echo 'With content:';
            echo 'exchangeServer=exchange_address';
            echo 'exchangeUsername=username or email';
            echo 'exchangePassword=password';
        }
        $this->mockApplication();
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
     * @covers common\lib\outlook\Outlook::authenticate
     */
    public function testAuthenticateSuccess()
    {
        $auth = new Outlook([
            'properties' => $this->property
            ]
        );
        $this->assertTrue($auth->authenticate());
    }

    /**
     * @covers common\lib\outlook\Outlook::authenticate
     */
    public function testAuthenticateContainerInjection()
    {
        \jk\sys\DependencyManager::register([
            'jk\sys\IProperties' => [
                'class' => 'jk\sys\PropertiesFile',
                'filename' => '$HOME/.secret/skills-secret'
            ],
            'jk\outlook\Outlook' => [
                'class' => 'jk\outlook\Outlook',
                'log' => 'jk\sys\LogConsole'
            ]
        ]);

        /* @var $auth Outlook */
        $auth = \Yii::$container->get('jk\outlook\Outlook');
        $this->assertTrue($auth->authenticate());
    }

    /**
     * @covers common\lib\outlook\Outlook::authenticate
     */
    public function testAuthenticateServiceLocator()
    {
        \Yii::$container->clear('jk\sys\IProperties');
        \Yii::$container->set('jk\sys\IProperties',
            [
            'class' => 'jk\sys\PropertiesFile',
            'filename' => '$HOME/.secret/skills-secret'
        ]);
        $app  = \Yii::$app;
        \Yii::$app->set('outlookAuth',
            [
            'class' => 'jk\outlook\Outlook'
        ]);
        /* @var $auth Outlook */
        $auth = \Yii::$app->outlookAuth;
        $this->assertTrue($auth->authenticate());
    }

    /**
     * @covers common\lib\outlook\Outlook::authenticate
     */
    public function testAuthenticateFailrue()
    {
        $this->property = new \jk\sys\PropertiesFile([
            'filename' => 'a.txt'
        ]);

        $auth = new Outlook([
                'properties' => $this->property
            ]
        );
        
        $this->assertFalse($auth->authenticate());
    }
}