<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\Document;
use Storage;
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
        
        $transactions = Transaction::sortable()->paginate(15);
        return view('transaction.transactionlist', compact('transactions'));

    }

    public function index2(Request $request){
        $this->validate($request,[
            'start' => 'required|date',
            'stop' => 'required|date|before_or_equal:start',
           ]);
         
           $start = Carbon::parse($request->start);
           $end = Carbon::parse($request->stop);
         
           $transactions = Transaction::whereDate('date','<=',$end->format('m-d-y'))
           ->whereDate('date','>=',$start->format('m-d-y'))->sortable()->paginate(15);
           
           return view('transaction.transactionlist', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Transaction::class);
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
        
        $this->authorize('create', Transaction::class);

        $request->validate([
            'image'     =>  'required|image|mimes:jpeg,png,jpg',
            "image" => "required|mimes:pdf|max:10000"
            
            ]);

  
        $path = Storage::putFile('public', $request->file('image'));
        $url = Storage::url($path);

        $document = new Document();
        $document->proforma_invoice = $url;
        $document->save();

        $transaction = new Transaction();
        $transaction->proforma_invoice_number = $request->proforma_invoice_number;
        $transaction->quantity = $request->quantity;
        $transaction->unit_price = $request->unit_price;
        $transaction->total_price = ($request->quantity * $request->unit_price);
        $transaction->payment_terms = $request->payment_terms;
        $transaction->description = $request->description;
        $transaction->user_id = \Auth::User()->id;
        $transaction->supplier_id = $request->supplier_id;
        $transaction->document_id = $document->id;
        $transaction->status = "ordered";
        $transaction->save();

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
        return view('transaction.transactionview', ['transaction' => $transaction]);
       
    }

    public function status($id, $status){
        $transaction = Transaction::findOrFail($id);
        $transaction->status = $status;
        return redirect('/transactions');
    }

    public static function showstatic($id)
    {
        $transaction = Transaction::findOrFail($id);
        return $transaction;
       
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
        //$this->authorize('user', 'admin', Transaction::class);
        $transaction = Transaction::findorFail($id);
        $transaction->proforma_invoice_number = $request->proforma_invoice_number;
        $transaction->quantity = $request->quantity;
        $transaction->unit_price = $request->unit_price;
        $total = $request->quantity * $request->unit_price;
        $transaction->total_price = $total;
        $transaction->payment_terms = $request->payment_terms;
        $transaction->user_id = \Auth::User()->id;
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
        //not recommended... add the data to trash table
        $transaction = Transaction::findorFail($id);
        $transaction->delete();
        return redirect('/transactions')->with('success', 'transactions deleted!');
    }
}
