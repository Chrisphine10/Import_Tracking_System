<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\Supplier;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    public function show($id){
        $transaction = Transaction::findOrFail($id);
        $supplier = Supplier::findOrFail($transaction->id);
        return view('transaction.progress', ['transaction' => $transaction, 'supplier' => $supplier]);
    }
}
