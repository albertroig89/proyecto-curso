<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeUserController extends Controller
{
    public function index($name)
    {
        $nickname=null;
        $name = ucfirst($name);
        $title = 'Pagina de bienvenida Usuarios';
        return view('saludo', compact('name', 'nickname', 'title'));
    }
    public function index2($name, $nickname)
    {
        $name = ucfirst($name);
        $title = 'Pagina de bienvenida Usuarios';
        return view('saludo', compact('name', 'nickname', 'title'));
    }
}