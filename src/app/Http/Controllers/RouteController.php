<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use function Ramsey\Uuid\v1;

class RouteController extends Controller
{
    //

    public function dashboard()
    {
        return view('dashboard');
    }

    public function home()
    {
        return view('home');
    }
    


    public function balances()
    {
        return view('settlements');
    }
}
