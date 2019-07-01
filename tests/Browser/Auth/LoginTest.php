<?php

namespace Tests\Browser\Auth;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use App\Domain\UserManagement\Entities\User;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testNegativeOfLogin()
    {
        $user      = User::first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->maximize()
                    ->visit('/')
                    ->type('email', $user->email)
                    ->type('password', 'passwordSalah')
                    ->press('SIGN IN')
                    ->assertSee('These credentials do not match our records.');
        });
    }

    public function testPositiveOfLogin()
    {
        $user      = User::first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->maximize()
                    ->visit('/')
                    ->type('email', $user->email)
                    ->type('password', 'rahasia')
                    ->press('SIGN IN')
                    ->assertPathIs('/home')
                    ->pause(1000)
                    ->click('#clickName')
                    ->clickLink('Signout')
                    ->pause(2000)
                    ->assertPathIs('/');
        });
    }
}
