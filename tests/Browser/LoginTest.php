<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;
use DB;

class LoginTest extends DuskTestCase
{

    /** @test */
    public function login_tests()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->assertSee('Sign in')
                    ->type('email','admin@admin.com')
                    ->type('password','password')
                    ->press('Sign In')
                    ->assertPathIs('/home');
        });
    }
}
