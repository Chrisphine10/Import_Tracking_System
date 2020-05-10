<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Supplier;
use App\User;

class FilterController extends Controller
{
    public function index(){

        $year = date("Y");
        $month = date("m");

        $transactions = Transaction::whereYear('created_at', $year)->whereMonth('date', $month)->where('user_id', '=', $alluser->id)->orderBy('date')->get();
        
        return view('filter');
    }

    public function chart(Request $request){
    }
}
