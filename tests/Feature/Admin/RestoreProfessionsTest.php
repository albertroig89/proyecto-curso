<?php

namespace Tests\Feature\Admin;

use App\Profession;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RestoreProfessionsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_restores_a_deleted_profession_from_the_trash()
    {
        //Creo la profession, luego la elimino mediante softDelete y compruebo que ha sido eliminada
        $profession = factory(Profession::class)->create();

        $this->patch("profesiones/{$profession->id}/papelera")
            ->assertRedirect(route('professions.index'));

        $this->assertSoftDeleted('professions', [
            'id' => $profession->id,
        ]);
        //--------------------------------------------------------------------------------------------------------
        //Restauro la profesion y compruebo en la base de datos que se ha restaurado correctamente
        $this->get("profesiones/{$profession->id}/restaurar")
            ->assertRedirect(route('professions.trashed'));

        $this->assertDatabaseHas('professions', [
            'id' => $profession->id,
            'deleted_at' => null,
        ]);
    }
}
