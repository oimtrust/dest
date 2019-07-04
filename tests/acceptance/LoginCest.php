<?php

class LoginCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToLogin(AcceptanceTester $I)
    {
        $I->amOnPage('/login');
        $I->fillField('email', 'admin@gmail.com');
        $I->fillField('password', 'dfdfd');
        $I->click('SIGN IN');
    }
}
