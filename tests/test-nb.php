<?php
/**
 * Codeception PHP script runner
 * http://stackoverflow.com/questions/18606807/debugging-codeception-tests-with-xdebug
 *
 * In order to run please setup run script configuration with "run" argument
 *
 */

require_once dirname(__FILE__).'/../vendor/codeception/codeception/autoload.php';

use Symfony\Component\Console\Application;

$app = new Application('Codeception', Codeception\Codecept::VERSION);
$app->add(new Codeception\Command\Run('run'));

$app->run();