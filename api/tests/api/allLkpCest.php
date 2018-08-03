<?php
namespace api;
use api\ApiTester;
use api\ApiTestParent;
use Codeception\Util\HttpCode;

class allLkpCest extends ApiTestParent
{





    // tests
    public function tryToTest(ApiTester $I)
    {
        $I->sendGET('find-all-lkp');
    }
}
