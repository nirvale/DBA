<?php

namespace App\Http\Controllers\Dbam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GetlogsController extends Controller
{
  public function __construct(Request $request)
  {
      $this->middleware(['role_or_permission:Administrador de Base de Datos|DBA Junior|adming|down_logs']);
  }

    public function downloadd($log)
    {

         if(Auth::check()) {
            // filename should be a relative path inside storage/app to your file like 'userfiles/report1253.pdf'
            //return $log;
            return Storage::download('/bdiarias/'.$log);
        }else{
            return abort('403');
        }

    }
    public function downloads($log)
    {

         if(Auth::check()) {
            // filename should be a relative path inside storage/app to your file like 'userfiles/report1253.pdf'
            //return $log;
            return Storage::download('/bsemanales/'.$log);
        }else{
            return abort('403');
        }
    }
    public function downloadm($log)
    {

         if(Auth::check()) {
            // filename should be a relative path inside storage/app to your file like 'userfiles/report1253.pdf'
            //return $log;
            return Storage::download('/bmanuales/'.$log);
        }else{
            return abort('403');
        }
    }
    public function downloadr($log)
    {

         if(Auth::check()) {
            // filename should be a relative path inside storage/app to your file like 'userfiles/report1253.pdf'
            //return $log;
            return Storage::download('/recovere/'.$log);
        }else{
            return abort('403');
        }
    }



}
