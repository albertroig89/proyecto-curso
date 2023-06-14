<?php

namespace Tests\Feature\Admin;

use App\Profession;
use App\Skill;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateUsersTest extends TestCase
{
    use RefreshDatabase;

    protected $defaultData = [
        'name' => 'Albert',
        'email' => 'albertroiglg@gmail.com',
        'password' => '123456',
        'bio' => 'Programador de Laravel y Vue.js',
        'profession_id' => '',
        'twitter' => 'https://twitter.com/bertito',
        'role' => 'user',
    ];

    /** @test */
    function it_loads_the_new_users_page()
    {
        $profession = factory(Profession::class)->create();

        $skillA = factory(Skill::class)->create();
        $skillB = factory(Skill::class)->create();

        $this->get('/usuarios/nuevo')
            ->assertStatus(200)
            ->assertSee('Creacion de usuarios')
            ->assertViewHas('professions', function ($professions) use ($profession) {
                return $professions->contains($profession);
            })
            ->assertViewHas('skills', function ($skills) use ($skillA, $skillB) {
                return $skills->contains($skillA) && $skills->contains($skillB);
            });
    }

    /** @test */
    function it_creates_a_new_user()
    {
        $profession = factory(Profession::class)->create();

        $skillA = factory(Skill::class)->create();
        $skillB = factory(Skill::class)->create();
        $skillC = factory(Skill::class)->create();

        $this->post('/usuarios/', $this->withData([
            'skills' => [$skillA->id, $skillB->id],
            'profession_id' => $profession->id,
        ]))->assertRedirect('usuarios');
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
        $this->assertDatabaseMissing('user_skill', [
            'user_id' => $user->id,
            'skill_id' => $skillC->id,

        ]);
    }




//    /** @test */
//    function the_profession_id_is_absent_but_another_profession_is_passed()
//    {
//        $this->withoutExceptionHandling();
//
//        $this->post('/usuarios/', $this->withData([
//            'profession_id' => null,
//            'other_profession' => 'new profession'
//        ]));
//
//        //Obtenim la nova professió (other_profession) que s'incerta al no posar el (profession_id)
//        $other_profession = Profession::where('title', 'new profession')->orderBy('id', 'DESC')->get()->last()->id;
//
//        $this->assertCredentials([
//            'name' => 'Albert',
//            'email' => 'albertroiglg@gmail.com',
//            'password' => '123456',
//        ]);
//
//        $this->assertDatabaseHas('user_profiles', [
//            'bio' => 'Programador de Laravel y Vue.js',
//            'user_id' => User::findByEmail('albertroiglg@gmail.com')->id,
//            'profession_id' => $other_profession,
//        ]);
//    }
//
//    /** @test */
//    /**ESTA*/
//    function the_other_profession_is_absent_but_profession_id_is_passed()
//    {
////        $this->handleValidationExceptions();
//
//        $profession = factory(Profession::class)->create();
//
//        $this->post('/usuarios/', $this->withData([
//            'other_profession' => null
//        ]));
//
//        $this->assertCredentials([
//            'name' => 'Albert',
//            'email' => 'albertroiglg@gmail.com',
//            'password' => '123456',
//        ]);
//
//        $this->assertDatabaseHas('user_profiles', [
//            'bio' => 'Programador de Laravel y Vue.js',
//            'user_id' => User::findByEmail('albertroiglg@gmail.com')->id,
//            'profession_id' => $profession->id,
//        ]);
//    }




    /** @test */
    function the_twitter_field_is_optional()
    {
        $this->post('/usuarios/', $this->withData([
            'twitter' => null,
        ]))->assertRedirect('usuarios');

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

    /** @test */
    function the_role_field_is_optional()
    {
        $this->post('/usuarios/', $this->withData([
            'role' => null,
        ]))->assertRedirect(route('users.index'));
        //->assertRedirect('usuarios'); EL MATEIX QUE LA LINEA ANTERIOR

        $this->assertDatabaseHas('users', [
            'email' => 'albertroiglg@gmail.com',
            'role' => 'user'
        ]);
    }

    /** @test */
    function the_role_must_be_valid()
    {
        $this->handleValidationExceptions();

        $this->post('/usuarios/', $this->withData([
            'role' => 'invalid-role',
        ]))->assertSessionHasErrors('role');
        //->assertRedirect('usuarios'); EL MATEIX QUE LA LINEA ANTERIOR

        $this->assertDatabaseEmpty('users');
    }

    /** @test */
    function the_profession_id_field_is_optional()
    {
        $this->post('/usuarios/', $this->withData([
            'profession_id' => '',
        ]))->assertRedirect('usuarios');

        $this->assertCredentials([
            'name' => 'Albert',
            'email' => 'albertroiglg@gmail.com',
            'password' => '123456',
        ]);

        $this->assertDatabaseHas('user_profiles', [
            'bio' => 'Programador de Laravel y Vue.js',
            'user_id' => User::findByEmail('albertroiglg@gmail.com')->id,
            'profession_id' => null,
        ]);
    }

    /** @test */
    function the_user_is_redirected_to_the_previous_page_when_the_violation_fails()
    {
        $this->handleValidationExceptions();

        $this->from('usuarios/nuevo')
            ->post('/usuarios', [])
            ->assertRedirect('usuarios/nuevo');

        $this->assertDatabaseEmpty('users');
    }

    /** @test */
    function the_name_is_required()
    {
        $this->handleValidationExceptions();

        $this->post('/usuarios', $this->withData([
            'name' => '',
        ]))
            ->assertSessionHasErrors(['name' => 'El campo nombre es obligatorio']);

        $this->assertDatabaseEmpty('users');
    }

    /** @test */
    function the_email_is_required()
    {
        $this->handleValidationExceptions();

        $this->post('/usuarios', $this->withData([
            'email' => '',
        ]))
            ->assertSessionHasErrors(['email' => 'Introduce un correo electronico']);

        $this->assertEquals(0, User::count());
    }

    /** @test */
    function the_email_must_be_valid()
    {
        $this->handleValidationExceptions();

        $this->post('/usuarios', $this->withData([
            'email' => 'correo-no-valido',
        ]))
            ->assertSessionHasErrors(['email' => 'Introduce un correo electronico correcto']);

        $this->assertDatabaseEmpty('users'); //JO NO TENIA ESTE

//        $this->assertEquals(0, User::count()); ESTE ELL NO EL TE
    }

    /** @test */
    function the_email_must_be_unique()
    {
        $this->handleValidationExceptions();

        factory(User::class)->create([
            'email' => 'albertroiglg@gmail.com'
        ]);

        $this->post('/usuarios', $this->withData([
            'email' => 'albertroiglg@gmail.com'
        ]))
            ->assertSessionHasErrors(['email' => 'El correo introducido ya existe']);

        $this->assertEquals(1, User::count());
    }

    /** @test */
    function the_password_is_required()
    {
        $this->handleValidationExceptions();

        $this->post('/usuarios', $this->withData([
                'password' => '',
            ]))
            ->assertSessionHasErrors(['password' => 'Especifica una contraseña']);

        $this->assertEquals(0, User::count());
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


    /** @test */
    function the_profession_must_be_valid()
    {
        $this->handleValidationExceptions();

        $this->post('/usuarios', $this->withData([
            'profession_id' => '999',
        ]))
            ->assertSessionHasErrors(['profession_id']);

        $this->assertDatabaseEmpty('users');
    }

    /** @test */
    function only_not_deleted_professions_can_be_selected()
    {
        $deletedProfession = factory(Profession::class)->create([
            'deleted_at' => now()->format('Y-m-d'),
        ]);

        $this->handleValidationExceptions();

        $this->post('/usuarios/', $this->withData([
                'profession_id' => $deletedProfession->id,
            ]))
            ->assertSessionHasErrors(['profession_id']);

        $this->assertDatabaseEmpty('users');
    }

    /** @test */
    function the_skills_must_be_an_array()
    {
        $this->handleValidationExceptions();

        $this->from('usuarios/nuevo')
            ->post('/usuarios', $this->withData([
                'skills' => 'PHP, JS',
            ]))
            ->assertSessionHasErrors(['skills']);

        $this->assertDatabaseEmpty('users');
    }

    /** @test */
    function the_skills_must_be_valid()
    {
        $this->handleValidationExceptions();

        $skillA = factory(Skill::class)->create();
        $skillB = factory(Skill::class)->create();

        $this->post('/usuarios', $this->withData([
            'skills' => [$skillA->id, $skillB->id + 1],
        ]))
            ->assertSessionHasErrors(['skills']);

        $this->assertDatabaseEmpty('users');
    }

}





