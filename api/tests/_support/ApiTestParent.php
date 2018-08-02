<?php

namespace api;
use api\ApiTester;
use Codeception\Util\HttpCode;

class ApiTestParent
{
    protected $token;
    public function _before(ApiTester $I)
    {
        if(!$this->token){
            $I->haveHttpHeader('Content-Type', 'application/json');
            $I->sendPOST('authorize', ['password' => '123456', 'email' => 'ahmedgdoma@gmail.com']);
            $this->token = $I->grabDataFromResponseByJsonPath('$.token');
        }
        $I->haveHttpHeader('X-Access-Token',$this->token[0]);
    }
    public function _after(ApiTester $I)
    {
        $I->seeResponseCodeIs(HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'status' => 1,
        ]);
    }

}