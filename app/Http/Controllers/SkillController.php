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

    public function trashed()
    {
        $skills = Skill::onlyTrashed()->get();

        $title = 'Habilidades en papelera';

        return view('skills.trashed', compact('title', 'skills'));

    }

    public function trash(Skill $skill)
    {
        $skill->delete();

        return redirect()->route('skills.index');
    }

    public function destroy($id)
    {
        $skill = Skill::onlyTrashed()->where('id', $id)->firstOrFail();

        $skill->forceDelete();

        return redirect()->route('skills.trashed');
    }

    public function restore( $id )
    {
        $skill = Skill::withTrashed()->where('id', '=', $id)->first();

        $skill->restore();

        return redirect()->route( "skills.trashed" )->with("restored" , $id );
    }
}