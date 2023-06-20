<?php

namespace App\Http\Controllers;

use App\Http\Forms\UserForm;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Profession;
use App\User;

class UserController extends Controller
{
    public function index() {
        
        //$users = DB::table('users')->get(); //constructor de consultes
        $users = User::all();//fa el mateix que la linea anterior pero en eloquent

        $title = 'Listado de usuarios';

        return view('users.index', compact('title', 'users'));
        
    }

    public function trashed()
    {
        $users = User::onlyTrashed()->get();

        $title = 'Listado de usuarios en papelera';

        return view('users.index', compact('title', 'users'));

    }
    
    public function show(User $user) {
        $professions = Profession::orderBy('title', 'ASC')->get();
        $title = 'Detalles de Usuarios';

        return view('users.show', compact('title', 'user', 'professions'));
    }
    
    public function create()
    {
        return new UserForm('users.create', new User);
    }

    public function edit(User $user)
    {
        return new UserForm('users.edit', $user);
    }

    public function menu()
    {
        $title = 'Menu';
        
        return view('menu', compact('title'));
    }

    public function store(CreateUserRequest $request)
    {
        $request->createUser();

        return redirect()->route('users.index');
        //return redirect()->route('users.index'); EL MATEIX QUE LA LINEA ANTERIOR
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $request->updateUser($user);

        return redirect()->route('users.show', ['user' => $user]);
    }

    public function trash(User $user)
    {
        $user->delete();
        $user->profile()->delete();

        return redirect()->route('users.index');
    }

    function destroy($id)
    {
        $user = User::onlyTrashed()->where('id', $id)->firstOrFail();

        $user->forceDelete();

        return redirect()->route('users.trashed');
    }
    
}
