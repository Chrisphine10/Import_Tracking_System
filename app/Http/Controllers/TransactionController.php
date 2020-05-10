<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\Document;
use App\Supplier;
use Carbon\Carbon;
use App\User;
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
        
        $transactions = Transaction::sortable()->paginate(13);
        return view('transaction.transactionlist', compact('transactions'));

    }

    public function index2(Request $request){
        $this->validate($request,[
            'stop' => 'required|date',
            'start' => 'required|date|before_or_equal:stop',
           ]);
         
           $start = Carbon::parse($request->start);
           $end = Carbon::parse($request->stop);
         
           $transactions = Transaction::whereDate('date','<=',$end->format('y-m-d'))
           ->whereDate('date','>=',$start->format('y-m-d'))->sortable()->paginate(15);

           //$start = $request->start;
           //$stop = $request->stop;

           //$transactions = Transaction::where('date','<=', $start)->where('date','>=', $stop)->sortable()->paginate(15);

           return view('transaction.transactionlist', compact('transactions'));

          // return compact('transactions');
    }

public function search(Request $request){
   // $users = User::where('fname','LIKE','%'.$request->search."%")
    //->orWhere('lname','LIKE','%'.$request->search."%")->get();
 
 $search = $request->search;
    $transactions = Transaction::where('payment_terms','LIKE','%'.$request->search."%")
    ->orWhere('description','LIKE','%'.$request->search."%")
    ->orWhere('status','LIKE','%'.$request->search."%")
    ->orWhere('proforma_invoice_number','LIKE','%'.$request->search."%")
    ->join('suppliers', 'transactions.supplier_id', 'suppliers.id')
    ->join('users', 'transactions.user_id', 'users.id')
    ->orWhere('suppliers.name','LIKE','%'.$request->search."%")
    ->orWhere('users.fname','LIKE','%'.$request->search."%")
    ->orWhere('users.lname','LIKE','%'.$request->search."%")
    ->sortable()
    ->paginate(13);

    return view('transaction.transactionlist', compact('transactions'));

    //return view('transaction.transactionlist', compact('transactions', 'links'));
   //$links = $transactions ->appends(['sort' => 'id'])->links();
    
   // return $users;
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
        $transaction->date = $request->date;
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
        $transaction->description = $request->description;
        $transaction->quantity = $request->quantity;
        $transaction->unit_price = $request->unit_price;
        $total = $request->quantity * $request->unit_price;
        $transaction->total_price = $total;
        $transaction->date = $request->date;
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
