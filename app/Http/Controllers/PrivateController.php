<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Auth;
use Session;

class PrivateController extends Controller
{
  public function cerrars()
  {
    Session::flush();
    Auth::guard('web')->logout();
    return redirect()->Route('index.public')->with('info','Cerró sesión con éxito');
    //return view('index',['info'=>'Cerró sesión con éxito...']);
  }
  public function cerrarsp()
  {
    Session::flush();
    Auth::guard('web')->logout();
    return redirect()->Route('index.public')->with('info','Cerró sesión con éxito');
    //return view('index',['info'=>'Cerró sesión con éxito...']);
  }
}
