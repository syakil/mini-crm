<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CopmanyTest extends DuskTestCase
{
    /**
     * @tests
     */
    public function create_company_test()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->assertSee('Sign in')
                    ->type('email','admin@admin.com')
                    ->type('password','password')
                    ->press('Sign In')
                    ->assertPathIs('/home');
        });

        $this->browse(function (Browser $browser) {
            $browser->visit('/companies/index')
                    ->assertSee('Companies')
                    ->press('+')
                    ->type('name','company')
                    ->type('email','company@company.com')
                    ->type('website','company.com')
                    ->press('Submit');
        });
    }
}
