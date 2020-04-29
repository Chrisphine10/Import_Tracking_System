<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\Document;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::latest()->paginate(20);
        return view('transaction.transactionlist', compact('transactions'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transaction.addtransaction');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        $transaction = new Transaction();
        $transaction->proforma_invoice_number = $request->proforma_invoice_number;
        $transaction->quantity = $request->quantity;
        $transaction->unit_price = $request->unit_price;
        $transaction->total_price = ($request->quantity * $request->unit_price);
        $transaction->payment_terms = $request->payment_terms;
        $transaction->user_id = \Auth::User()->id;
        $transaction->supplier_id = $request->session()->get('supplier_id');
        $transaction->status = "ordered";
        $transaction->save();

        $document = new Document();
        $document->transaction_id = $transaction->id;
        $document->save();
        return redirect('/transactions')->with('success', 'transactions added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction = Transaction::findOrFail($id);
        $tid = $transaction->id;
        $document = Document::where('transaction_id', '=', $tid)->get();
        return view('transaction.transactionview', ['transaction' => $transaction, 'document' => $document]);
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transaction = Transaction::findOrFail($id);
        return view('transaction.edittransaction', compact('transaction'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $transaction = Transaction::findorFail($id);
        $transaction->proforma_invoice_number = $request->proforma_invoice_number;
        $transaction->quantity = $request->quantity;
        $transaction->unit_price = $request->unit_price;
        $transaction->total_price = ($request->quantity * $request->unit_price);
        $transaction->payment_terms = $request->payment_terms;     
        $transaction->status = $request->status;
        $transaction->save();
        return redirect('/transactions')->with('success', 'transactions updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaction = Transaction::findorFail($id);
        $transaction->delete();
        return redirect('/transactions')->with('success', 'transactions deleted!');
    }
}
