<?php

namespace Tests\Browser\Pages\Users;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use App\Domain\UserManagement\Entities\User;
use Illuminate\Foundation\Testing\WithFaker;

class EditUserTest extends DuskTestCase
{
    use WithFaker;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testPositiveOfUpdateUser()
    {
        $this->browse(function (Browser $browser) {
            $user   = User::all()->last();
            $browser->maximize()
                    ->loginAs(User::first())
                    ->visit('/users')
                    ->pause(2000)
                    ->click('.update'. $user->id)
                    ->pause(2000)
                    ->type('name', $this->faker->name)
                    ->type('email', $this->faker->email)
                    ->radio('status', 'INACTIVE')
                    ->type('phone', '089786757564')
                    ->attach('avatar', __DIR__.'/face-test.jpg')
                    ->type('address', $this->faker->address)
                    ->press('Update')
                    ->pause(3000)
                    ->assertSee('User successfully updated');
        });
    }

    public function testIfNameIsEmptyOnUpdateUser()
    {
        $this->browse(function (Browser $browser) {
            $user   = User::all()->last();
            $browser->maximize()
                    ->loginAs(User::first())
                    ->visit('/users')
                    ->pause(2000)
                    ->click('.update'. $user->id)
                    ->pause(2000)
                    ->type('name', '')
                    ->type('email', $this->faker->email)
                    ->radio('status', 'INACTIVE')
                    ->type('phone', '089786757564')
                    ->attach('avatar', __DIR__.'/face-test.jpg')
                    ->type('address', $this->faker->address)
                    ->press('Update')
                    ->pause(3000)
                    ->assertSee('The name field is required.');
        });
    }
}
