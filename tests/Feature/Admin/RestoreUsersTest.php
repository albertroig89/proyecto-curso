<?php

namespace Tests\Feature\Admin;

use App\User;
use App\UserProfile;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RestoreUsersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_restores_a_deleted_user_from_the_trash()
    {
        //Creo el usuario y su perfil, luego elimino mediante softDelete tanto el usuario como el perfil y compruebo que han sido eliminados
        $user = factory(User::class)->create();
        factory(UserProfile::class)->create([
            'user_id' => $user->id,
        ]);

        $this->patch("usuarios/{$user->id}/papelera")
            ->assertRedirect(route('users.index'));

        $this->assertSoftDeleted('users', [
            'id' => $user->id,
        ]);

        $this->assertSoftDeleted('user_profiles', [
            'user_id' => $user->id,
        ]);
        //--------------------------------------------------------------------------------------------------------
        //Restauro el usuario y compruebo en la base de datos que tanto el usuario como el perfil se han restaurado correctamente
        $this->get("usuarios/{$user->id}/restaurar")
            ->assertRedirect(route('users.trashed'));

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'deleted_at' => null,
        ]);

        $this->assertDatabaseHas('user_profiles', [
            'user_id' => $user->id,
            'deleted_at' => null,
        ]);
    }
}
