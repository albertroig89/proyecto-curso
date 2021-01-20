<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
    
        $users = [
          
            'Albert',
            'Laia',
            'Lidia',
            'Bonica',
            'Bimo',
            '<script>alert("Cliquer")</script>',
        ];
        
        return view('users', [
            'users' => $users,
            'title' => 'Listado de usuarios'
        ]);
    }
    
    public function show($id) {
        return 'Mostrando detalle del usuario: '.$id;
        /*return "Mostrando detalle del usuario: {$id}"*/ /*fa el mateix que la linea anterior en sintaxis diferent*/
    }
    
    public function create()
    {
        return 'Crear nuevo usuario';
    }
    
    public function edit($id)
    {
        return 'Editar usuario '.$id;
    }
}
