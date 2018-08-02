<?php
namespace api;
use api\ApiTester;

class drugIndexCest extends ApiTestParent
{

    // tests
    public function tryToTest(ApiTester $I)
    {
        $I->sendGET('icsr-drug-prescriptions/232');
    }
}
