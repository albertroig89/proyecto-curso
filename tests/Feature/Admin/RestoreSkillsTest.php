<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Skill;

class RestoreSkillsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_restores_a_deleted_profession_from_the_trash()
    {
        //Creo la habilidad, luego la elimino mediante softDelete y compruebo que ha sido eliminada
        $skill = factory(Skill::class)->create();

        $this->patch("habilidades/{$skill->id}/papelera")
            ->assertRedirect(route('skills.index'));

        $this->assertSoftDeleted('skills', [
            'id' => $skill->id,
        ]);
        //--------------------------------------------------------------------------------------------------------
        //Restauro la habilidad y compruebo en la base de datos que se ha restaurado correctamente
        $this->get("habilidades/{$skill->id}/restaurar")
            ->assertRedirect(route('skills.trashed'));

        $this->assertDatabaseHas('skills', [
            'id' => $skill->id,
            'deleted_at' => null,
        ]);
    }
}
