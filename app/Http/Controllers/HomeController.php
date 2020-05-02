<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    public function index(){
    if(\Auth::user()->role == 'user'){ 
        return redirect('/transactions');
    }
    elseif(\Auth::user()->role == 'admin'){
        return view('adminmenu');
    } 
    elseif(\Auth::user()->role == 'manager'){
        //return view('managermenu');
        return redirect('/transactions');
    }
    else {
        return route('login');
    }
}

    
}
