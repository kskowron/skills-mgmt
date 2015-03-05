<?php

use tests\codeception\common\_pages\LoginPage;
use tests\codeception\frontend\FunctionalTester;

$I = new FunctionalTester($scenario);
$I->wantTo('ensure that my business profile works - emp2');

$loginPage = LoginPage::openBy($I);
$loginPage->login('emp2', 'test123');
$I->seeLink('Logout (emp2)');

$I->see('Edit Business Profile', 'a');
$I->click('Edit Business Profile');

$I->dontSee('BPROFILE1', 'td');
$I->dontSee('BPROFILE2', 'td');
$I->dontSee('BPROFILE3', 'td');

$I->see('BPROFILE4', 'td');
$I->see('BPROFILE5', 'td');

