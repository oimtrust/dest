<?php

namespace Tests\Browser\Pages\Users;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use App\Domain\UserManagement\Entities\User;
use Illuminate\Foundation\Testing\WithFaker;

class SearchUserTest extends DuskTestCase
{
    use WithFaker;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testSearchNameOfUser()
    {
        $this->browse(function (Browser $browser) {
            $user = User::orderBy('id', 'DESC')->first();
            $browser->maximize()
                    ->loginAs(User::first())
                    ->visit('/users')
                    ->pause(2000)
                    ->type('keyword', $user->name)
                    ->press('Search')
                    ->assertSee($user->name)
                    ->pause(3000);
        });
    }

    public function testSearchEmptyOfUser()
    {
        $this->browse(function (Browser $browser) {
            $browser->maximize()
                    ->loginAs(User::first())
                    ->visit('/users')
                    ->pause(2000)
                    ->type('keyword', 'whatyourname?')
                    ->press('Search')
                    ->assertDontSee('whatyourname?')
                    ->pause(3000);
        });
    }
}
