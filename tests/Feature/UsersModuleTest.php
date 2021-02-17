<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

class UsersModuleTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * @test
     */
    
    function it_shows_the_users_list()
    {
        
        factory(User::class)->create([
            'name' => 'Albert',
            'website' => 'coldwar.cat'
        ]);
        
        factory(User::class)->create([  
            'name' => 'Laia'
        ]);
        
        
        $this->get('/usuarios')
                ->assertStatus(200)
                ->assertSee('Listado de usuarios')
                ->assertSee('Albert')
                ->assertSee('Laia');
    }
    
    /**
     * @test
     */
    
    function it_shows_a_default_message_if_there_are_no_users()
    {
        $this->get('/usuarios')
                ->assertStatus(200)
                ->assertSee('No hay usuarios registrados.');
    }
    
    /**
     * @test
     */
    
    function it_loads_the_users_details_page()
    {
        $this->get('/usuarios/5')
                ->assertStatus(200)
                ->assertSee('Mostrando detalle del usuario: 5');
    }
    
    /**
     * @test
     */
    
    function it_loads_the_new_users_page()
    {
        $this->get('/usuarios/nuevo')
                ->assertStatus(200)
                ->assertSee('Crear nuevo usuario');
    }
    
    /**
     * @test
     */
    
    function it_loads_the_edit_users_details_page()
    {
        $this->get('/usuarios/5/edit')
                ->assertStatus(200)
                ->assertSee('Editar usuario 5');
    }
    
    /**
     * @test
     */
    
    function it_loads_no_edit_users_details_page()
    {
        $this->get('/usuarios/texto/edit')
                ->assertStatus(404);
    }
    
    /**
     * @test
     */
    
    function it_shows_the_menu_webpage()
    {
        $this->get('/menu')
                ->assertStatus(200)
                ->assertSee('Menu')
                ->assertSee('Mostrar usuarios')
                ->assertSee('Crear usuarios');
    }
}
