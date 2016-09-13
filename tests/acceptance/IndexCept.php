<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('see index');

$I->amOnPage('/');
$I->see('Scsmartflo');
$I->see('Products');
$I->see('Download');
