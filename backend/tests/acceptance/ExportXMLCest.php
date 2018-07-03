<?php
namespace backend\tests;
use backend\tests\AcceptanceTester;
use Codeception\Step\Argument\PasswordArgument;

class ExportXMLCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        $I->amOnPage('crud/drug/index');
        $I->fillField('Email', 'ahmedgdoma@gmail.com');
        $I->fillField('Password', new PasswordArgument('123456'));
        $I->clickWithLeftButton('button[type=submit]');
        $I->see('Products');
        $I->clickWithLeftButton(['css'=>'table tbody tr:last-child .glyphicon-eye-open']);
        $I->clickWithLeftButton(['css'=>'ul#relation-tabs li:nth-of-type(2) a']);
        $I->clickWithLeftButton(['css'=>'table tbody tr:last-child .glyphicon-eye-open']);
        $I->clickWithLeftButton(['css'=>'#exportXml']);
        $I->wait(20);
        $I->see('Download File');
    }
}
