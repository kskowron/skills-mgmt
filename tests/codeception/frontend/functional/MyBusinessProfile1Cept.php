<?php

use tests\codeception\common\_pages\LoginPage;
use tests\codeception\frontend\FunctionalTester;

$I = new FunctionalTester($scenario);
$I->wantTo('ensure that my business profile works - emp1');

$loginPage = LoginPage::openBy($I);
$loginPage->login('emp1', 'test123');
$I->seeLink('Logout (emp1)');

$profilePage = tests\codeception\frontend\_pages\MyProfilePage::openBy($I);

$I->see('Edit Business Profile', 'a');
$I->click('Edit Business Profile');

$I->see('BPROFILE1', 'td');
$I->see('BPROFILE2', 'td');
$I->see('BPROFILE3', 'td');

$I->dontSee('BPROFILE4', 'td');
$I->dontSee('BPROFILE5', 'td');
