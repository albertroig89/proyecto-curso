<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeUserController extends Controller
{
    public function index($name)
    {
        /*$name = ucfirst($name);
        return "Bienvenido {$name}";*/
       $title = 'Bienvenido';
        return view('saludo1', compact('name', 'title'));
    }
    public function index2($name, $nickname)
    {
        /*$name = ucfirst($name);
        return "Bienvenido {$name}, tu apodo es {$nickname}";*/
        $title = 'Bienvenido';
        return view('saludo2', compact('name', 'nickname', 'title'));
    }
}