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

    public function incorrectLogin(AcceptanceTester $I)
    {
        $I->amOnPage('site/login');
        $I->fillField('Email', 'admin');
        $I->fillField('Password', new PasswordArgument('123456'));
        $I->clickWithLeftButton('button[type=submit]');
        $I->see('Incorrect username or password.');
    }

    public function correctLogin(AcceptanceTester $I)
    {
        $I->amOnPage('site/login');
        $I->fillField('Email', 'ahmed@ahmed.com');
        $I->fillField('Password', new PasswordArgument('123456'));
        $I->clickWithLeftButton('button[type=submit]');
        $I->see('Logout');
    }
}
