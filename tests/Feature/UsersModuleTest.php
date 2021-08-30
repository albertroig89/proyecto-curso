<?php

namespace Tests\Feature;

use App\Profession;
use App\Skill;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

class UsersModuleTest extends TestCase
{
    use RefreshDatabase;

    protected $profession;
    












    /**
     * @test
     */
    function the_profession_id_is_absent_but_another_profession_is_passed()
    {
        $this->withoutExceptionHandling();

        $this->post('/usuarios/', $this->getValidData([
            'profession_id' => null,
            'other_profession' => 'new profession'
        ]))->assertRedirect(route('users.index'));
        //->assertRedirect('usuarios'); EL MATEIX QUE LA LINEA ANTERIOR

        //Obtenim la nova professió (other_profession) que s'incerta al no posar el (profession_id)
        $other_profession = Profession::where('title', 'new profession')->orderBy('id', 'DESC')->get()->last()->id;

        $this->assertCredentials([
            'name' => 'Albert',
            'email' => 'albertroiglg@gmail.com',
            'password' => '123456',
        ]);

        $this->assertDatabaseHas('user_profiles', [
            'bio' => 'Programador de Laravel y Vue.js',
            'user_id' => User::findByEmail('albertroiglg@gmail.com')->id,
            'profession_id' => $other_profession,
        ]);
    }

    /**
     * @test
     */
    function the_other_profession_is_absent_but_profession_id_is_passed()
    {
        $this->withoutExceptionHandling();

        $this->post('/usuarios/', $this->getValidData([
            'other_profession' => null
        ]))->assertRedirect(route('users.index'));

        $this->assertCredentials([
            'name' => 'Albert',
            'email' => 'albertroiglg@gmail.com',
            'password' => '123456',
        ]);

        $this->assertDatabaseHas('user_profiles', [
            'bio' => 'Programador de Laravel y Vue.js',
            'user_id' => User::findByEmail('albertroiglg@gmail.com')->id,
            'profession_id' => $this->profession->id,
        ]);
    }

    /**
     * @test
     */
    function the_name_is_required()
    {
        $this->from('usuarios/nuevo')
            ->post('/usuarios', $this->getValidData([
                'name' => '',
            ]))
        ->assertRedirect('usuarios/nuevo')
        ->assertSessionHasErrors(['name' => 'El campo nombre es obligatorio']);

        $this->assertDatabaseEmpty('users');
    }

    /**
     * @test
     */
    function the_email_is_required()
    {
        $this->from('usuarios/nuevo')
            ->post('/usuarios', $this->getValidData([
        'email' => '',
        ]))
        ->assertRedirect('usuarios/nuevo')
        ->assertSessionHasErrors(['email' => 'Introduce un correo electronico']);

        $this->assertEquals(0, User::count());
    }

    /**
     * @test
     */
    function the_email_must_be_valid()
    {
        $this->from('usuarios/nuevo')
            ->post('/usuarios', $this->getValidData([
                'email' => 'correo-no-valido',
            ]))
            ->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['email' => 'Introduce un correo electronico correcto']);

        $this->assertEquals(0, User::count());
    }

    /**
     * @test
     */
    function the_email_must_be_unique()
    {
        factory(USer::class)->create([
           'email' => 'albertroiglg@gmail.com'
        ]);

        $this->from('usuarios/nuevo')
            ->post('/usuarios', $this->getValidData([
                'email' => 'albertroiglg@gmail.com'
            ]))
            ->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['email' => 'El correo introducido ya existe']);

        $this->assertDatabaseCount('users');
    }


    /**
     * @test
     */
    function it_loads_the_edit_user_page()
    {
        $user = factory(User::class)->create();

        $this->get("/usuarios/{$user->id}/editar")
            ->assertStatus(200)
            ->assertSee('Editar usuario')
            ->assertViewIs('users.edit')
            ->assertViewHas('user', function ($viewUser) use ($user) {
                return $viewUser->id == $user->id;
            });
    }

    /**
     * @test
     */
    function it_updates_a_user()
    {
        $user = factory(User::class)->create();

        $this->withoutExceptionHandling();

        $this->put("/usuarios/{$user->id}", [
            'name' => 'Albert',
            'email' => 'albertroiglg@gmail.com',
            'password' => '123456'
        ])->assertRedirect("/usuarios/{$user->id}");
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
    function the_name_is_required_when_updating_a_user()
    {
        $user = factory(User::class)->create();

        $this->from("usuarios/{$user->id}/editar")
            ->put("usuarios/{$user->id}", [
                'name' => '',
                'email' => 'albertroiglg@gmail.com',
                'password' => '123456'
            ])
            ->assertRedirect("usuarios/{$user->id}/editar")
            ->assertSessionHasErrors(['name']);

        $this->assertDatabaseMissing('users', ['email' => 'albertroiglg@gmail.com']);
    }

    /**
     * @test
     */
    function the_email_must_be_valid_when_updating_the_user()
    {
        $user = factory(User::class)->create();

        $this->from("usuarios/{$user->id}/editar")
            ->put("usuarios/{$user->id}", [
                'name' => 'Albert Roig',
                'email' => 'corre-no-valido',
                'password' => '123456'
            ])
            ->assertRedirect("usuarios/{$user->id}/editar")
            ->assertSessionHasErrors(['email']);

        $this->assertDatabaseMissing('users', ['name' => 'Albert Roig']);
    }

    /**
     * @test
     */
    function the_email_must_be_unique_when_updating_the_user()
    {
        factory(User::class)->create([
           'email' => 'existing-email@example.com'
        ]);

        $user = factory(USer::class)->create([
            'email' => 'albertroiglg@gmail.com'
        ]);

        $this->from("usuarios/{$user->id}/editar")
            ->put("usuarios/{$user->id}", [
                'name' => 'Albert Roig',
                'email' => 'existing-email@example.com',
                'password' => '123456'
            ])
            ->assertRedirect("usuarios/{$user->id}/editar")
            ->assertSessionHasErrors(['email']);
    }

    /**
     * @test
     */
    function the_users_email_can_stay_the_same_when_updating_the_user()
    {

        $user = factory(User::class)->create([
            'email' => 'albertroiglg@gmail.com'
        ]);

        $this->from("usuarios/{$user->id}/editar")
            ->put("usuarios/{$user->id}", [
                'name' => 'Albert Roig',
                'email' => 'albertroiglg@gmail.com',
                'password' => '123456',
            ])
            ->assertRedirect("usuarios/{$user->id}"); // (users.show)

        $this->assertDatabaseHas('users', [
            'name' => 'Albert Roig',
            'email' => 'albertroiglg@gmail.com'
        ]);
    }

    /**
     * @test
     */
    function the_password_is_optional_when_updating_the_user()
    {
        $oldPassword = 'clave_anterior';

        $user = factory(User::class)->create([
            'password' => bcrypt($oldPassword)
        ]);

        $this->from("usuarios/{$user->id}/editar")
            ->put("usuarios/{$user->id}", [
                'name' => 'Albert Roig',
                'email' => 'albertroiglg@gmail.com',
                'password' => '',
            ])
            ->assertRedirect("usuarios/{$user->id}"); // (users.show)

        $this->assertCredentials([
            'name' => 'Albert Roig',
            'email' => 'albertroiglg@gmail.com',
            'password' => $oldPassword
        ]);
    }

    /**
     * @test
     */
    function it_deletes_a_user()
    {
        $user = factory(User::class)->create();

        $this->delete("usuarios/{$user->id}")
            ->assertRedirect('usuarios');

        $this->assertDatabaseMissing('users', [
            'id' => $user->id
        ]);
    }
//    /**
//     * @test
//     */
//    function it_loads_the_edit_users_details_page()
//    {
//        $this->get('/usuarios/5/editar')
//            ->assertStatus(200)
//            ->assertSee('Editar usuario 5');
//    }
//
//    /**
//     * @test
//     */
//    function it_loads_no_edit_users_details_page()
//    {
//        $this->get('/usuarios/texto/editar')
//            ->assertStatus(404);
//    }
    /**
     * @return string[]
     */
    protected function getValidData(array $custom =[]): array
    {
        $this->profession = factory(Profession::class)->create();

        return array_merge([
            'name' => 'Albert',
            'email' => 'albertroiglg@gmail.com',
            'password' => '123456',
            'profession_id' => $this->profession->id,
            'bio' => 'Programador de Laravel y Vue.js',
            'twitter' => 'https://twitter.com/bertito',
            'role' => 'user',
        ], $custom);
    }

}
