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
        $title = 'Creacion de Usuarios';
        
        return view('users.create', compact('title'));
    }
    
    public function edit($id)
    {
        $title = 'Edicion de Usuarios';
        
        return view('users.edit', compact('title', 'id'));
    }
    public function menu()
    {
        $title = 'Menu';
        
        return view('menu', compact('title'));
    }

    public function store()
    {
        return 'Procesando información...';
    }
    
}
