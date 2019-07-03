<?php

class LoginCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        $I->amOnPage('/login');
        $I->fillField('email', 'admin@gmail.com');
        $I->fillField('password', 'dfdfd');
        $I->click('SIGN IN');
    }
}
