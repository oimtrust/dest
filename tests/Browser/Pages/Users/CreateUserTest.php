<?php

namespace Tests\Browser\Pages\Users;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use App\Domain\UserManagement\Entities\User;
use Illuminate\Foundation\Testing\WithFaker;

class CreateUserTest extends DuskTestCase
{
    use WithFaker;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testPositiveOfCreateUser()
    {
        $this->browse(function (Browser $browser) {
            $name   = $this->faker->name;
            $browser->maximize()
                    ->loginAs(User::first())
                    ->visit('/users')
                    ->pause(2000)
                    ->clickLink('Create User')
                    ->pause(2000)
                    ->type('name', $name)
                    ->type('email', $this->faker->email)
                    ->type('password', 'mejikuhibiniuQwerty')
                    ->type('phone', '089786757564')
                    ->attach('avatar', __DIR__.'/face-test.jpg')
                    ->type('address', $this->faker->address)
                    ->press('Save')
                    ->pause(3000)
                    ->assertSee('User successfully created');
        });
    }

    public function testIfNameIsEmpty()
    {
        $this->browse(function (Browser $browser) {
            $browser->maximize()
                    ->loginAs(User::first())
                    ->visit('/users')
                    ->pause(2000)
                    ->clickLink('Create User')
                    ->pause(2000)
                    ->type('name', '')
                    ->type('email', $this->faker->email)
                    ->type('password', 'mejikuhibiniuQwerty')
                    ->type('phone', '089786757564')
                    ->attach('avatar', __DIR__.'/face-test.jpg')
                    ->type('address', $this->faker->address)
                    ->press('Save')
                    ->pause(3000)
                    ->assertSee('The name field is required.');
        });
    }

    public function testIfEmailIsEmpty()
    {
        $this->browse(function (Browser $browser) {
            $browser->maximize()
                    ->loginAs(User::first())
                    ->visit('/users')
                    ->pause(2000)
                    ->clickLink('Create User')
                    ->pause(2000)
                    ->type('name', $this->faker->name)
                    ->type('email', '')
                    ->type('password', 'mejikuhibiniuQwerty')
                    ->type('phone', '089786757564')
                    ->attach('avatar', __DIR__.'/face-test.jpg')
                    ->type('address', $this->faker->address)
                    ->press('Save')
                    ->pause(3000)
                    ->assertSee('The email field is required.');
        });
    }

    public function testIfPasswordIsEmpty()
    {
        $this->browse(function (Browser $browser) {
            $browser->maximize()
                    ->loginAs(User::first())
                    ->visit('/users')
                    ->pause(2000)
                    ->clickLink('Create User')
                    ->pause(2000)
                    ->type('name', $this->faker->name)
                    ->type('email', $this->faker->email)
                    ->type('password', '')
                    ->type('phone', '089786757564')
                    ->attach('avatar', __DIR__.'/face-test.jpg')
                    ->type('address', $this->faker->address)
                    ->press('Save')
                    ->pause(3000)
                    ->assertSee('The password field is required.');
        });
    }

    public function testIfPhoneIsEmpty()
    {
        $this->browse(function (Browser $browser) {
            $browser->maximize()
                    ->loginAs(User::first())
                    ->visit('/users')
                    ->pause(2000)
                    ->clickLink('Create User')
                    ->pause(2000)
                    ->type('name', $this->faker->name)
                    ->type('email', $this->faker->email)
                    ->type('password', 'mejikuhibiuqwerty')
                    ->type('phone', '')
                    ->attach('avatar', __DIR__.'/face-test.jpg')
                    ->type('address', $this->faker->address)
                    ->pause(2000)
                    ->press('#pressSave')
                    ->pause(3000)
                    ->assertSee('The phone field is required.');
        });
    }

    public function testIfAvatarIsEmpty()
    {
        $this->browse(function (Browser $browser) {
            $browser->maximize()
                    ->loginAs(User::first())
                    ->visit('/users')
                    ->pause(2000)
                    ->clickLink('Create User')
                    ->pause(2000)
                    ->type('name', $this->faker->name)
                    ->type('email', $this->faker->email)
                    ->type('password', 'mejikuhibiuqwerty')
                    ->type('phone', '089786757564')
                    ->type('address', $this->faker->address)
                    ->pause(2000)
                    ->press('#pressSave')
                    ->pause(3000)
                    ->assertSee('The avatar field is required.');
        });
    }

    public function testIfAddressIsEmpty()
    {
        $this->browse(function (Browser $browser) {
            $browser->maximize()
                    ->loginAs(User::first())
                    ->visit('/users')
                    ->pause(2000)
                    ->clickLink('Create User')
                    ->pause(2000)
                    ->type('name', $this->faker->name)
                    ->type('email', $this->faker->email)
                    ->type('password', 'mejikuhibiuqwerty')
                    ->type('phone', '089786757564')
                    ->attach('avatar', __DIR__.'/face-test.jpg')
                    ->type('address', '')
                    ->pause(2000)
                    ->press('#pressSave')
                    ->pause(3000)
                    ->assertSee('The address field is required.');
        });
    }
}
