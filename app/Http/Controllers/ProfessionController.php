<?php

namespace App\Http\Controllers;

use App\Profession;

class ProfessionController extends Controller
{
    public function index()
    {
        $professions = Profession::query()
            ->withCount('profiles')
            ->orderBy('title')
            ->get();

        return view('professions.index', [
            'professions' => $professions,
        ]);
    }

    public function trashed()
    {
        $professions = Profession::onlyTrashed()->get();

        $title = 'Professiones en papelera';

        return view('professions.trashed', compact('title', 'professions'));

    }

    public function trash(Profession $profession)
    {
        $profession->delete();

        return redirect()->route('professions.index');
    }

    public function destroy($id)
    {
        $profession = Profession::onlyTrashed()->where('id', $id)->firstOrFail();

        $profession->forceDelete();

        return redirect()->route('professions.trashed');
    }

    public function restore( $id )
    {
        $profession = Profession::withTrashed()->where('id', '=', $id)->first();

        $profession->restore();

        return redirect()->route( "professions.trashed" )->with("restored" , $id );
    }
}