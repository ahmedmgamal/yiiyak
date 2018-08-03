<?php
namespace api;
use api\ApiTester;

class icsrTestIndexCest extends ApiTestParent
{

    // tests
    public function tryToTest(ApiTester $I)
    {
        $I->sendGET('icsr-tests/232');
    }
}
