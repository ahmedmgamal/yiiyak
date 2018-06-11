<?php
namespace backend\tests;
use backend\tests\AcceptanceTester;

class ForgotPasswordCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }

    // tests
    public function addWrongMailTest(AcceptanceTester $I)
    {
        $I->amOnPage('site/login');
        $I->see('Forget Password');
        $I->clickWithLeftButton(['css'=>'#login-form div.form-group a.btn-default']);
        $I->see('Request password reset');
        $I->fillField('Email', 'ahmed');
        $I->clickWithLeftButton('button[type=submit]');
        $I->see('Email is not a valid email address.');
        $I->wait(10);
    }
    public function addTrueMailTest(AcceptanceTester $I)
    {
        $I->amOnPage('site/login');
        $I->see('Forget Password');
        $I->clickWithLeftButton(['css'=>'#login-form div.form-group a.btn-default']);
        $I->see('Request password reset');
        $I->fillField('Email', 'ahmedgdoma@gmail.com');
        $I->clickWithLeftButton('button[type=submit]');

        $I->wait(10);
    }
}
