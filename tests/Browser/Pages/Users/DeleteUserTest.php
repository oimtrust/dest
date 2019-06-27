<?php

namespace Tests\Browser\Pages\Users;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use App\Domain\UserManagement\Entities\User;

class DeleteUserTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testDeletedUser()
    {
        $this->browse(function (Browser $browser) {
            $user = User::orderBy('id', 'DESC')->first();
            $browser->loginAs(User::first())
                    ->visit('/users')
                    ->press('#delete'. $user->id)
                    ->assertDialogOpened('Are you sure to move to trash?')
                    ->acceptDialog()
                    ->assertPathIs('/users')
                    ->assertSee('User moved to trash')
                    ->pause(1000)
                    ->assertDontSee($user->name)
                    ->pause(2000);
        });
    }
}
