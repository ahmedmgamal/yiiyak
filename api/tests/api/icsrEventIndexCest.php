<?php
namespace api;
use api\ApiTester;

class icsrEventIndexCest extends ApiTestParent
{

    // tests
    public function tryToTest(ApiTester $I)
    {
        $I->sendGET('icsr-events/232');
    }
}
