<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('see admin page');

$I->amOnPage('/admin');
$I->see('Password');
$I->fillField('password', '0000');
$I->click('登入');
$I->see('Logout');
