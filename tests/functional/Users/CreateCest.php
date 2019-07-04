<?php namespace Users;

use FunctionalTester;
use App\Domain\UserManagement\Entities\User;


class CreateCest
{
    public function _before(FunctionalTester $I)
    {

    }

    // tests
    public function tryToCreateNewUserWithPositiveTest(FunctionalTester $I)
    {
        // $I->amLoggedAs(new User());
        // $I->amOnPage('/users/create');
        // $I->fillField(['name' => 'name'], "Nama");
        // $I->fillField(['name' => 'email'], 'email@email.com');
        // $I->fillField(['name' => 'phone'], '089786867544');
        // $I->attachFile('input[@type="file"]', __DIR__ . '/face-test.jpg');
        // $I->fillField(['name' => 'address'], 'Malang');
        // $I->click('Save');
    }
}
