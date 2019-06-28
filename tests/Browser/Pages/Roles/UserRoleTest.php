<?php

namespace Tests\Browser\Pages\Roles;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use App\Domain\UserManagement\Entities\Role;
use App\Domain\UserManagement\Entities\User;

class UserRoleTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testAttachRoleToUser()
    {
        $this->browse(function (Browser $browser) {
            $user   = User::all()->last();
            $role   = Role::all()->last();
            $browser->maximize()
                    ->loginAs(User::first())
                    ->visit('/userrole')
                    ->pause(2000)
                    ->click('#modal'. $user->id)
                    ->whenAvailable('.modal', function ($modal) use ($role){
                        $modal->assertSee('Choose Role to Attach User')
                                ->assertSelectHasOptions('#roles', [$role->id])
                                ->press('Attach')
                                ->pause(1000);
                    })
                    ->assertSee('The Role has been selected')
                    ->pause(2000);
        });
    }

    public function testAttachUnkownRoleToUser()
    {
        $this->browse(function (Browser $browser) {
            $user   = User::all()->last();
            $browser->maximize()
                    ->loginAs(User::first())
                    ->visit('/userrole')
                    ->pause(2000)
                    ->click('#modal'. $user->id)
                    ->whenAvailable('.modal', function ($modal){
                        $modal->assertSee('Choose Role to Attach User')
                                ->assertSelectMissingOptions('#roles', ['6', '7'])
                                ->press('Attach')
                                ->pause(1000);
                    })
                    ->assertSee('The Role has been selected')
                    ->pause(2000);
        });
    }
}
