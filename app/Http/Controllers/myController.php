<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class myController extends Controller
{
    public function acceuil(Request $request){
        $user = Auth::user();
        return view('home' , [
            'user' => $user
        ]) ;
    }

    public function dashboard(){
       return Redirect::to('/');
    }

    public function login(){
        return view('login');
    }
    public function signin(){
        return view('signin');
    }

    public function logout(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/'); 
    }

}
