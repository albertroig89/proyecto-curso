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
        
        $this->get("/usuarios/{$user->id}")// usuarios/5
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
        $this->withoutExceptionHandling();

        $profession = factory(Profession::class)->create();

        $skillA = factory(Skill::class)->create();
        $skillB = factory(Skill::class)->create();

        $this->get('/usuarios/nuevo')
                ->assertStatus(200)
                ->assertSee('Creacion de usuarios')
                ->assertViewHas('professions', function ($professions) use ($profession) {
                    return $professions->contains($profession);
                })
                ->assertViewHas('skills', function($skills) use ($skillA, $skillB) {
                    return $skills->contains($skillA) && $skills->contains($skillB);
                });
    }

    /**
     * @test
     */
    function it_creates_a_new_user()
    {
        $this->withoutExceptionHandling();

        $skillA = factory(Skill::class)->create();
        $skillB = factory(Skill::class)->create();
        $skillC = factory(Skill::class)->create();

        $this->post('/usuarios/', $this->getValidData([
            'skills' => [$skillA->id, $skillB->id],
        ]))->assertRedirect(route('users.index'));
        //->assertRedirect('usuarios'); EL MATEIX QUE LA LINEA ANTERIOR

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
            'profession_id' => $this->profession->id,
        ]);
        $this->assertDatabaseHas('user_skill', [
            'user_id' => $user->id,
            'skill_id' => $skillA->id,
        ]);
        $this->assertDatabaseHas('user_skill', [
            'user_id' => $user->id,
            'skill_id' => $skillB->id,
        ]);
        $this->assertDatabaseMissing('user_skill', [
            'user_id' => $user->id,
            'skill_id' => $skillC->id,

        ]);
    }

    /**
     * @test
     */
    function the_twitter_field_is_optional()
    {
        $this->withoutExceptionHandling();

        $this->post('/usuarios/', $this->getValidData([
            'twitter' => null,
        ]))->assertRedirect(route('users.index'));
        //->assertRedirect('usuarios'); EL MATEIX QUE LA LINEA ANTERIOR

        $this->assertCredentials([
            'name' => 'Albert',
            'email' => 'albertroiglg@gmail.com',
            'password' => '123456'
        ]);

        $this->assertDatabaseHas('user_profiles', [
            'bio' => 'Programador de Laravel y Vue.js',
            'twitter' => null,
            'user_id' => User::findByEmail('albertroiglg@gmail.com')->id,
        ]);
    }

    /**
     * @test
     */
    function the_role_field_is_optional()
    {
        $this->withoutExceptionHandling();

        $this->post('/usuarios/', $this->getValidData([
            'role' => null,
        ]))->assertRedirect(route('users.index'));
        //->assertRedirect('usuarios'); EL MATEIX QUE LA LINEA ANTERIOR

        $this->assertDatabaseHas('users', [
            'email' => 'albertroiglg@gmail.com',
            'role' => 'user'
        ]);
    }

    /**
     * @test
     */
    function the_role_must_be_valid()
    {
        $this->handleValidationExceptions();

        $this->post('/usuarios/', $this->getValidData([
            'role' => 'invalid-role',
        ]))->assertSessionHasErrors('role');
        //->assertRedirect('usuarios'); EL MATEIX QUE LA LINEA ANTERIOR

        $this->assertDatabaseEmpty('users');
    }

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
    function the_password_is_required()
    {
        $this->from('usuarios/nuevo')
            ->post('/usuarios', $this->getValidData([
                'password' => '',
            ]))
            ->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['password' => 'Especifica una contraseña']);

        $this->assertEquals(0, User::count());
    }

    /**
     * @test
     */
    function the_profession_must_be_valid()
    {
        $this->from('usuarios/nuevo')
            ->post('/usuarios', $this->getValidData([
                'profession_id' => '999',
            ]))
            ->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['profession_id']);

        $this->assertDatabaseEmpty('users');
    }

//    /**
//     * @test
//     */
//    function only_selectable_professions_are_valid()
//    {
//        $nonSelectableProfession = factory(Profession::class)->create([
//            'selectable' => false,
//        ]);
//
//        $this->from('usuarios/nuevo')
//            ->post('/usuarios', $this->getValidData([
//                'profession_id' => $nonSelectableProfession->id,
//            ]))
//            ->assertRedirect('usuarios/nuevo')
//            ->assertSessionHasErrors(['profession_id']);
//
//        $this->assertDatabaseEmpty('users');
//    }

//    /**
//     * @test
//     */
//    function only_not_deleted_professions_can_be_selected()
//    {
//        $deletedProfession = factory(Profession::class)->create([
//            'deleted_at' => now()->format('Y-m-d'),
//        ]);
//
//        $this->from('usuarios/nuevo')
//            ->post('/usuarios', $this->getValidData([
//                'profession_id' => $deletedProfession->id,
//            ]))
//            ->assertRedirect('usuarios/nuevo')
//            ->assertSessionHasErrors(['profession_id']);
//
//        $this->assertDatabaseEmpty('users');
//    }

    /**
     * @test
     */
    function the_skills_must_be_an_array()
    {
        $this->from('usuarios/nuevo')
            ->post('/usuarios', $this->getValidData([
                'skills' => 'PHP, JS',
            ]))
            ->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['skills']);

        $this->assertDatabaseEmpty('users');
    }

    /**
     * @test
     */
    function the_skills_must_be_valid()
    {
        $this->handleValidationExceptions();

        $skillA = factory(Skill::class)->create();
        $skillB = factory(Skill::class)->create();

        $this->from('usuarios/nuevo')
            ->post('/usuarios', $this->getValidData([
                'skills' => [$skillA->id, $skillB->id + 1],
            ]))
            ->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['skills']);

        $this->assertDatabaseEmpty('users');
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
