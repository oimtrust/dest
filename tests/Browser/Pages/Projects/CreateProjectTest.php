<?php

namespace Tests\Browser\Pages\Projects;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use App\Domain\UserManagement\Entities\User;
use Illuminate\Foundation\Testing\WithFaker;

class CreateProjectTest extends DuskTestCase
{
    use WithFaker;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $user   = User::all()->last();
            $browser->maximize()
                    ->loginAs(User::first())
                    ->visit('/projects')
                    ->pause(2000)
                    ->clickLink('Create Project')
                    ->pause(2000)
                    ->type('title', $this->faker->jobTitle)
                    ->assertSelectHasOptions('#assigned_to', [$user->id])
                    ->type('owner', $this->faker->company)
                    ->type('description', $this->faker->text($maxNbChars = 100))
                    ->attach('logo', __DIR__.'/dest-v1.png')
                    ->radio('#draft', 'DRAFT')
                    ->press('Save')
                    ->pause(3000)
                    ->assertSee('Project successfully created!');
        });
    }
}
