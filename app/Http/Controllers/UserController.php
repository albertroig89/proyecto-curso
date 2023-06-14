<?php

namespace App\Http\Controllers;

use App\Http\Forms\UserForm;
use App\Http\Requests\CreateUserRequest;
use App\Profession;
use App\Role;
use App\Skill;
use App\User;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index() {
        
        //$users = DB::table('users')->get(); //constructor de consultes
        $users = User::all();//fa el mateix que la linea anterior pero en eloquent
        
    
/*        if (request()->has('empty')) {
            $users = [];
        } else {
            $users = [
          
            'Albert',
            'Laia',
            'Lidia',
            'Bonica',
            'Bimo',
            ];
        }*/
        
        
        
        
        /*return view('users') 
                ->with('users', $users)
                ->with('title', 'Listado de usuarios');*/
     
        //SON DOS MANERES DE FER EXACTAMENT EL MATEIX
        $title = 'Listado de usuarios';
        
        /*return view('users', [
            'users' => $users,
            'title' => $title
        ]);*/
        
        
        //dd(compact('title', 'users')); ET MOSTRA ELS ARRAYS DE LES VARIABLES
        //var_dump(compact('title', 'users')); die(); ES EL MATEIX QUE LA LINEA ANTERIOR EN DIFERENT SINTAXIS
        
        
        return view('users.index', compact('title', 'users'));
        
    }
    
    public function show(User $user) {
        
        $title = 'Detalles de Usuarios';

//        $user = User::find($id); el bloc fa el mateix que: $user = User::findOrFail($id);
//
//        if ($user == null)
//        {
//            return response()->view('errors.404', [], 404);
//        }

//        $user = User::findOrFail($id); No fa falta perque hem posat directament $user enlloc del $id i ja ho controla automaticament eloquent

        return view('users.show', compact('title', 'user'));
        
        //return 'Mostrando detalle del usuario: '.$id;
        /*return "Mostrando detalle del usuario: {$id}"*/ /*fa el mateix que la linea anterior en sintaxis diferent*/
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

    public function update(User $user)
    {


        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
 //           'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)], //FA EL MATEIX QUE LA LINEA ANTERIOR PERO A MI ME FALLA FINAL TEMA 36
            'password' => '',



            'role' => ['nullable', Rule::in(Role::getList())],
            'bio' => 'required',
            'twitter' => ['nullable', 'present', 'url'],
            'profession_id' => [
                'nullable', 'present',
                Rule::exists('professions', 'id')->whereNull('deleted_at')
             ],
            'skills' => [
                'array',
                Rule::exists('skills', 'id'),
            ],



        ], [
            'name.required' => 'El campo nombre es obligatorio',
            'email.required' => 'Introduce un correo electronico',
            'email.email' => 'Introduce un correo electronico correcto',
            'email.unique' => 'El correo introducido ya existe',
        ]);

        if (! empty ($data['skills'])) {
            $user->skills()->attach($data['skills']);
        }

        if ($data['password'] != null) {
            $data['password'] = bcrypt($data['password']);
        }else{
            unset($data['password']);
        }

        $profession_id = $data['profession_id'];

        $user->role = $data['role'] ?? 'user';

        $user->update($data);

        $user->profile()->update([
            'bio' => $data['bio'],
            'twitter' => $data['twitter'],
            'profession_id' => $profession_id,
        ]);

//        return redirect("usuarios/{$user->id}"); FA EL MATEIX QUE LA LINEA ANTERIOR
        return redirect()->route('users.show', ['user' => $user]);
    }

    function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index');
    }
    
}
