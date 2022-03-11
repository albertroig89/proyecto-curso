<?php

namespace Tests\Browser\Admin;

use App\Profession;
use App\Skill;
use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateUserTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    function a_user_can_be_created()
    {
        $profession = factory(Profession::class)->create();
        $skillA = factory(Skill::class)->create();
        $skillB = factory(Skill::class)->create();


        $this->browse(function (Browser $browser) use ($profession, $skillA, $skillB){
            $browser->visit('usuarios/nuevo')
                ->type('name', 'Albert')
                ->type('email', 'albertroiglg@gmail.com')
                ->type('password', '123456')
                ->type('bio', 'Programador de Laravel y Vue.js')
                ->select('profession_id', $profession->id)
                ->type('twitter', 'https://twitter.com/bertito')
                ->check("skills[$skillA->id]")
                ->check("skills[$skillB->id]")
                ->radio('role', 'user')
                ->press('Crear usuario')
                ->assertPathIs('/usuarios')
                ->assertSee('Albert')
                ->assertSee('albertroiglg@gmail.com');
        });

        $this->assertCredentials([
            'name' => 'Albert',
            'email' => 'albertroiglg@gmail.com',
            'password' => '123456',
            'role' => 'user',
        ]);

        $user = User::findByEmail('albertroiglg@gmail.com');

        $this->assertDatabaseHas('user_profiles', [
            'bio' => 'Programador de Laravel y Vue.js',
            'twitter' => 'https://twitter.com/bertito',
            'user_id' => $user->id,
            'profession_id' => $profession->id,
        ]);
        $this->assertDatabaseHas('user_skill', [
            'user_id' => $user->id,
            'skill_id' => $skillA->id,
        ]);
        $this->assertDatabaseHas('user_skill', [
            'user_id' => $user->id,
            'skill_id' => $skillB->id,
        ]);
    }
}
