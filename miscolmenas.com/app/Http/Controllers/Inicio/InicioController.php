<?php

namespace App\Http\Controllers\Inicio;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InicioController extends Controller
{

    public function index(){
      return view('home.index');
    }

    public function noticias(){
      return view('home.noticias');
    }
    public function descargas(){
      return view('home.descargas');
    }
    public function contactos(){
      return view('home.contacto');
    }
}
