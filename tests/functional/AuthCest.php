<?php

use Illuminate\Support\Facades\Hash;
use App\Domain\UserManagement\Entities\User;

class AuthCest
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
    public function loginUsingUserRecord(FunctionalTester $I)
    {
        $I->amLoggedAs(User::create($this->userAttributes));
        $I->amOnPage('/home');
        $I->seeCurrentUrlEquals('/home');
        $I->seeAuthentication();

        //Login should persist between request
        $I->amOnPage('/home');
        $I->seeAuthentication();
    }

    public function loginUsingCredentials(FunctionalTester $I)
    {
        $I->haveRecord('users', $this->userAttributes);
        $I->amLoggedAs(['email' => 'admin@gmail.com', 'password' => 'rahasia']);
        $I->amOnPage('/home');
        $I->seeCurrentUrlEquals('/home');
        $I->seeAuthentication();
        // Login should persist between requests
        $I->amOnPage('/home');
        $I->seeAuthentication();
    }

    public function secureRouteWithoutAuthenticatedUser(FunctionalTester $I)
    {
        $I->amOnPage('/home');
        $I->seeCurrentUrlEquals('/login');
    }

    public function secureRouteWithAuthenticatedUser(FunctionalTester $I)
    {
        $I->amLoggedAs(User::create($this->userAttributes));
        $I->amOnPage('/home');
        $I->see('Dashboard');
    }
}
