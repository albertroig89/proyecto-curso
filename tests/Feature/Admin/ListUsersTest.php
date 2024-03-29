<?php

namespace Tests\Feature\Admin;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListUsersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_shows_the_users_list()
    {

        factory(User::class)->create([
            'name' => 'Albert Roig',
            'website' => 'coldwar.cat'
        ]);

        factory(User::class)->create([
            'name' => 'Bonica Nica'
        ]);


        $this->get('/usuarios')
            ->assertStatus(200)
            ->assertSee('Listado de usuarios')
            ->assertSee('Albert')
            ->assertSee('Bonica');
    }

    /** @test */
    function it_shows_a_default_message_if_the_users_list_is_empty()
    {
        $this->get('/usuarios')
            ->assertStatus(200)
            ->assertSee('No hay usuarios registrados.');
    }


    /** @test */
    function it_shows_the_deleted_users()
    {

        factory(User::class)->create([
            'name' => 'Albert Roig',
            'deleted_at' => now(),
        ]);

        factory(User::class)->create([
            'name' => 'Bonica Nica'
        ]);


        $this->get('/usuarios/papelera')
            ->assertStatus(200)
            ->assertSee('Usuarios en papelera')
            ->assertSee('Albert')
            ->assertDontSee('Bonica');
    }

}
