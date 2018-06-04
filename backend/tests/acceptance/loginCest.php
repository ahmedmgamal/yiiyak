<?php
namespace backend\tests;
use backend\tests\AcceptanceTester;
use Codeception\Step\Argument\PasswordArgument;

class loginCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }

    // tests
    public function checkss(AcceptanceTester $I)
    {
        $I->amOnPage('site/login');
        $I->see('Email');
        $I->see('Password');
        $I->see('Login');
    }
    public function tryToTest(AcceptanceTester $I)
    {
        $I->amOnPage('site/login');
        $I->fillField('Email', 'davert');
        $I->fillField('Password', new PasswordArgument('thisissecret'));
        $I->click('Login');
        $I->see('Login');
    }
}
