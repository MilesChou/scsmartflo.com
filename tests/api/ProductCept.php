<?php
$I = new ApiTester($scenario);
$I->wantTo('see product');

$I->sendGET('/api/v1/get-product');
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->seeResponseContains('[]');
