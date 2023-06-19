<?php

namespace App\Http\Controllers;

use App\Skill;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::query()
        ->withCount('skills')
        ->orderBy('name')
        ->get();

        return view('skills.index', [
            'skills' => $skills,
        ]);
    }

    public function destroy(Skill $skill)
    {
        abort_if($skill->skills()->exists(), 400, 'Cannot delete a skill linked to a user.');

        $skill->delete();

        return redirect('habilidades');
    }
}