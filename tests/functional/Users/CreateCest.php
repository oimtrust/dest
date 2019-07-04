<?php namespace Users;

use FunctionalTester;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class CreateCest
{

    private $userAttributes;

    public function _before(FunctionalTester $I)
    {
        $this->userAttributes = [
            'name'              => 'Fathur Rohim',
            'email'             => 'rohim@gmail.com',
            'password'          => Hash::make('rahasia'),
            'remember_token'    => Str::random(10),
            'address'           => 'Malang City',
            'phone'             => '08987867564',
            'status'            => 'ACTIVE',
            'created_by'        => 1,
        ];
    }

    // tests
    public function tryToCreateNewUserWithPositiveTest(FunctionalTester $I)
    {
        $I->haveRecord('users', $this->userAttributes);
        $I->amLoggedAs(['email' => 'admin@gmail.com', 'password' => 'rahasia']);
        $I->amOnPage('/users/create');
        $I->fillField('name', "Nama");
        $I->fillField('email', 'email@email.com');
        $I->fillField('phone', '089786867544');
        $I->attachFile('avatar', 'face-test.jpg');
        $I->fillField('address', 'Malang');
        $I->click('button[type=submit]');
    }
}
