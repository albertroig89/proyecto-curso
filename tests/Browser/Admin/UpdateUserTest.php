<?php

namespace Tests\Browser\Admin;

use App\Profession;
use App\Skill;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UpdateUserTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    function a_user_can_be_updated()
    {
        $profession = factory(Profession::class)->create();
        $skillA = factory(Skill::class)->create();
        $skillB = factory(Skill::class)->create();


        $this->browse(function (Browser $browser, $browser2) use ($profession, $skillA, $skillB){
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

            $browser2->visit('/usuarios/1/editar')
                ->type('name', 'Albertito')
                ->type('email', 'albertroiglg@gmail.es')
                ->press('Editar usuario')
                ->assertPathIs('/usuarios/1')
                ->assertSee('Albertito')
                ->assertSee('albertroiglg@gmail.es');
        });

    }
}
