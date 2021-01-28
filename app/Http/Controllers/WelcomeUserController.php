<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeUserController extends Controller
{
    public function index($name)
    {
        /*$name = ucfirst($name);
        return "Bienvenido {$name}";*/
        return view('saludo1', compact('name'));
    }
    public function index2($name, $nickname)
    {
        /*$name = ucfirst($name);
        return "Bienvenido {$name}, tu apodo es {$nickname}";*/
        return view('saludo2', compact('name', 'nickname'));
    }
}