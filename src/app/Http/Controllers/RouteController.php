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

    public function admin()
    {
        return view('admin');
    }
    public function home()
    {
        return view('home');
    }
    public function expences()
    {
        return view('expences');
    }

    public function colocations()
    {
        return view('colocations');
    }

    public function balances()
    {
        return view('balances');
    }
}
