<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::sortable()->paginate(15);
        return view('supplier.supplierlist', compact('suppliers'));
    }

    public static function all()
    {
        $suppliers = Supplier::all();
        return $suppliers;
    }

    public function search(Request $request){
        // $users = User::where('fname','LIKE','%'.$request->search."%")
         //->orWhere('lname','LIKE','%'.$request->search."%")->get();
      
      $search = $request->search;
         $suppliers = Supplier::where('name','LIKE','%'.$request->search."%")
         ->orWhere('email','LIKE','%'.$request->search."%")
         ->orWhere('phone','LIKE','%'.$request->search."%")
         ->sortable()
         ->paginate(13);
     
         return view('supplier.supplierlist', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supplier.addsupplier');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $supplier = new Supplier();
        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->phone = $request->phone;
        $supplier->save();
        $request->session()->put('supplier_id', $supplier->id);

        return redirect()->action(
            'TransactionController@create'
        )->with('success', 'suppliers saved!');
        //return redirect('/suppliers')->with('success', 'suppliers saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('supplier.supplierview', ['supplier' => $supplier]);
    }
    public static function showstatic($id)
    {
        $supplier = Supplier::findOrFail($id);
        return $supplier;
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('supplier.editsupplier', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->phone = $request->phone;
        $supplier->save();
        return redirect('/suppliers')->with('success', 'supplier updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //deletion is not recommended
        //$this->authorize('create', Supplier::class);
        $supplier = Supplier::findorFail($id);
        $supplier->delete();
        return redirect('/suppliers')->with('success', 'supplier deleted!');
    }
}