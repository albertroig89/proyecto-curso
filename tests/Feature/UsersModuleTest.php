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
            'name' => 'Albert Roig',
            'website' => 'coldwar.cat'
        ]);
        
        factory(User::class)->create([  
            'name' => 'Laia Barco'
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
    function it_displays_the_users_details()
    {
        $user = factory(User::class)->create([
            'name' => 'Albert Roig'
        ]);
        
        $this->get('/usuarios/'.$user->id)// usuarios/5
                ->assertStatus(200)
                ->assertSee('Albert Roig');
    }

    /**
     * @test
     */
    function it_displays_a_404_error_if_the_user_is_not_found()
    {
        $this->get('/usuarios/999')
            ->assertStatus(404)
            ->assertSee('Página no encontrada');
    }

    /**
     * @test
     */
    function it_loads_the_new_users_page()
    {
        $this->get('/usuarios/nuevo')
                ->assertStatus(200)
                ->assertSee('Creacion de usuarios');
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
    function it_creates_a_new_user()
    {
        $this->withoutExceptionHandling();

        $this->post('/usuarios', [
            'name' => 'Albert',
            'email' => 'albertroiglg@gmail.com',
            'password' => '123456'
        ])->assertRedirect('usuarios');
        //])->assertRedirect(route('users.index')); EL MATEIX QUE LA LINEA ANTERIOR

        $this->assertCredentials([
            'name' => 'Albert',
            'email' => 'albertroiglg@gmail.com',
            'password' => '123456'
        ]);
    }

    /**
     * @test
     */
    function the_name_is_required()
    {

        $this->from('usuarios/nuevo')
            ->post('/usuarios', [
                'name' => '',
                'email' => 'albertroiglg@gmail.com',
                'password' => '123456'
        ])
        ->assertRedirect('usuarios/nuevo')
        ->assertSessionHasErrors(['name' => 'El campo nombre es obligatorio']);

        $this->assertEquals(0, User::count());

//        $this->assertDatabaseMissing('users', [
//            'email' => 'albertroiglg@gmail.com',
//        ]);

    }
}
