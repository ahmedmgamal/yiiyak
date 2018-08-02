<?php
namespace api;
use api\ApiTester;

class icsrReporterIndexCest extends ApiTestParent
{

    // tests
    public function tryToTest(ApiTester $I)
    {
        $I->sendGET('icsr-reporters/232');
    }
}
