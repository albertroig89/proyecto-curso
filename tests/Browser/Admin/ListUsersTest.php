<?php

namespace Tests\Browser\Admin;

use App\Profession;
use App\Skill;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ListUsersTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    function users_can_be_listed()
    {
        $profession = factory(Profession::class)->create();
        $profession2 = factory(Profession::class)->create();
        $skillA = factory(Skill::class)->create();
        $skillB = factory(Skill::class)->create();


        $this->browse(function (Browser $browser, $browser2) use ($profession, $profession2, $skillA, $skillB){
            $browser->visit('/usuarios/nuevo')
                ->type('name', 'Albert')
                ->type('email', 'albertroiglg@gmail.com')
                ->type('password', '123456')
                ->type('bio', 'Programador de Laravel y Vue.js')
                ->select('profession_id', $profession->id)
                ->type('twitter', 'https://twitter.com/bertito')
                ->check("skills[$skillA->id]")
                ->check("skills[$skillB->id]")
                ->radio('role', 'user')
                ->press('Crear usuario');

            $browser2->visit('/usuarios/nuevo')
                ->type('name', 'Laia')
                ->type('email', 'laiayniska@gmail.com')
                ->type('password', '123456')
                ->type('bio', 'Educadora infantil')
                ->select('profession_id', $profession2->id)
                ->type('twitter', 'https://twitter.com/bertito')
                ->check("skills[$skillB->id]")
                ->check("skills[$skillA->id]")
                ->radio('role', 'user')
                ->press('Crear usuario')
                ->assertPathIs('/usuarios')
                ->assertSee('Albert')
                ->assertSee('albertroiglg@gmail.com')
                ->assertSee('Laia')
                ->assertSee('laiayniska@gmail.com');
        });
    }
}
