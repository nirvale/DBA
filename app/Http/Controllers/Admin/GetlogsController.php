<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GetlogsController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware(['permission:admin|adming|dba|esquema']);
    }

    public function download($log)
    {

         if(Auth::check()) {
            // filename should be a relative path inside storage/app to your file like 'userfiles/report1253.pdf'
            //return $log;
            return Storage::download('/bdiarias/'.$log);
        }else{
            return abort('403');
        }

    }


}
