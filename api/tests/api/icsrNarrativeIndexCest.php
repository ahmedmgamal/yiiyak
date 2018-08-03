<?php
namespace api;
use api\ApiTester;

class icsrNarrativeIndexCest extends ApiTestParent
{

    // tests
    public function tryToTest(ApiTester $I)
    {
        $I->sendGET('icsr-narritives/232');
    }
}
