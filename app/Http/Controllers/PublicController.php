<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Auth;

class PublicController extends Controller
{
  /**
   * Show the profile for the given user.
   */
  // public function index(Request $request, string $id): View
  // {
  //     $value = $request->session()->get('key', function () {
  //         return 'default';
  //     });
  //
  //     $user = $this->users->find($id);
  //
  //     return view('index', ['user' => $user]);
  // }

  public function index()
  {
    if (Auth::check()) {
      return view('index',['info'=>' Usuario autenticado...']);
    }else {
    // dd(Auth::user());
      return view('index',['info'=>' Usuario no autenticado por favor inicie sesión...']);

  }
      // $value = $request->session()->get('key', function () {
      //     return 'default';
      // });
      //
      // $user = $this->users->find($id);
      //
      // return view('index', ['user' => $user]);
  }
}
