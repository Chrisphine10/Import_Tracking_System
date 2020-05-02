<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    public function show($id){
        $transaction = Transaction::findOrFail($id);
        return view('transaction.progress', ['transaction' => $transaction]);
    }
}
