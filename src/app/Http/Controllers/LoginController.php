<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use function Laravel\Prompts\alert;



class LoginController extends Controller
{
    //


    public function showRegisterForm()
    {
        return view('registerForm');
    }


    public function register(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'string'
        ]);



        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);


        FacadesAuth::login($user);

        return redirect('/home')->with('Success', '>>> User registred successfully <<<');
    }

    public function getLogin()
    {
        return view('loginForm');
    }

    public function login(Request $request)
    {
        if (FacadesAuth::attempt(["email" => $request->email, "password" => $request->password])) {

            FacadesAuth::user();
            if (FacadesAuth::check()) {


                alert('Succés!', 'Bienvenue!');
                if (FacadesAuth::user()->role === 'admin') {
                    return redirect()->route('admin');
                }
                return redirect('/home');
            } else {
                return redirect()->back()->with('Failed to connect');
            }
        }
    }

    public function logout(Request $request)
    {
        FacadesAuth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
