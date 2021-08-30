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

        $profession = factory(Profession::class)->create();

        $skillA = factory(Skill::class)->create();
        $skillB = factory(Skill::class)->create();
        $skillC = factory(Skill::class)->create();

        $this->post('/usuarios/', $this->getValidData([
            'skills' => [$skillA->id, $skillB->id],
            'profession_id' => $profession->id,
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
     * @return string[]
     */
    protected function getValidData(array $custom =[]): array
    {

        return array_merge([
            'name' => 'Albert',
            'email' => 'albertroiglg@gmail.com',
            'password' => '123456',
            'bio' => 'Programador de Laravel y Vue.js',
            'profession_id' => '',
            'twitter' => 'https://twitter.com/bertito',
            'role' => 'user',
        ], $custom);
    }


}





