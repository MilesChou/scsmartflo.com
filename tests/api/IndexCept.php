<?php
$I = new ApiTester($scenario);
$I->wantTo('see index');

$I->sendGET('/api/v1');
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->seeResponseContainsJson(['path' => '/api/v1']);
$I->seeResponseContainsJson(['available' => [
    'get-category',
    'get-product',
    'get-download',
    'send',
]]);
