<?php

namespace Tests\Feature\Admin;

use App\Profession;
use App\UserProfile;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteProfessionsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_sends_a_profession_to_the_trash()
    {
        $profession = factory(Profession::class)->create();

        $this->patch("profesiones/{$profession->id}/papelera")
            ->assertRedirect('profesiones');

        // Option 1:
        $this->assertSoftDeleted('professions', [
            'id' => $profession->id,
        ]);

        //Option 2:
        $profession->refresh();

        $this->assertTrue($profession->trashed());
    }

    /** @test */
    function it_completly_deletes_a_profession()
    {
        $profession = factory(Profession::class)->create([
            'deleted_at' => now()
        ]);

        $this->delete("profesiones/{$profession->id}")
            ->assertRedirect('profesiones/papelera');

        $this->assertDatabaseEmpty('professions');
    }

    /** @test */
    function it_cannot_delete_a_profession_that_is_not_in_the_trash()
    {
        $this->withExceptionHandling();

        $profession = factory(Profession::class)->create([
            'deleted_at' => null,
        ]);

        $this->delete("profesiones/{$profession->id}")
            ->assertStatus(404);

        $this->assertDatabaseHas('professions', [
            'id' => $profession->id,
            'deleted_at' => null,
        ]);
    }

    /** @test */
    function a_profession_associated_to_a_profile_cannot_be_deleted()
    {
        $this->withExceptionHandling();

        $profession = factory(Profession::class)->create();

        $profile = factory(UserProfile::class)->create([
            'profession_id' => $profession->id,
        ]);

        $response = $this->delete("profesiones/{$profession->id}");

        $response->assertStatus(404);

        $this->assertDatabaseHas('professions', [
            'id' => $profession->id,
        ]);
    }
}