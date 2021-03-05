<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $title = 'Creacion de usuarios';
        
        return view('users.create', compact('title'));
    }
    
    public function edit(User $user)
    {
        $title = 'Edicion de usuarios';
        
        return view('users.edit', ['user' => $user], compact('title'));
    }
    public function menu()
    {
        $title = 'Menu';
        
        return view('menu', compact('title'));
    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
//            'email' => ['required', 'email', 'unique':users,email], FA EL MATEIX QUE LA LINEA ANTERIOR
            'password' => 'required|min:6'
        ], [
            'name.required' => 'El campo nombre es obligatorio',
            'email.required' => 'Introduce un correo electronico',
            'email.email' => 'Introduce un correo electronico correcto',
            'email.unique' => 'El correo introducido ya existe',
            'password.required' => 'Especifica una contraseña',
            'password.min' => 'La contraseña debe contener almenos 6 caracteres'
        ]);

//        if (empty($data['name'])) {
//            return redirect ('usuarios/nuevo')->withErrors([
//                'name' => 'El campo nombre es obligatorio'
//            ]);
//        }

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        return redirect('usuarios');
        //return redirect()->route('users.index'); EL MATEIX QUE LA LINEA ANTERIOR
    }

    public function update(User $user)
    {
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
 //           'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)], //FA EL MATEIX QUE LA LINEA ANTERIOR PERO A MI ME FALLA FINAL TEMA 36
            'password' => ''
        ], [
            'name.required' => 'El campo nombre es obligatorio',
            'email.required' => 'Introduce un correo electronico',
            'email.email' => 'Introduce un correo electronico correcto',
            'email.unique' => 'El correo introducido ya existe',
        ]);

        if ($data['password'] != null) {
            $data['password'] = bcrypt($data['password']);
        }else{
            unset($data['password']);
        }
        $user->update($data);

//        return redirect("usuarios/{$user->id}"); FA EL MATEIX QUE LA LINEA ANTERIOR
        return redirect()->route('users.show', ['user' => $user]);
    }
    
}
