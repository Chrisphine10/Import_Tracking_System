<?php

namespace App\Http\Controllers;

use App\Document;
use App\Additional;
use Storage;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documents = Document::latest()->paginate(10);
        return view('document.documentslist', compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $request->validate([
            'image'     =>  'required|image|mimes:jpeg,png,jpg'
            
            ]);


        $document = Document::findOrFail($request->id);
        if(isset($request->name)){
        $name = $request->name;
            
        $path = Storage::putFile('public', $request->file('image'));
        $url = Storage::url($path);

        $additional = new Additional();
        $additional->document_id = $request->id;
        $additional->document = $url;
        $additional->document_name = $name;
        $additional->save();
        } 
        elseif(isset($request->document_name)) {
        $name = $request->document_name;         
        $path = Storage::putFile('public', $request->file('image'));
        $url = Storage::url($path);
        $document->$name = $url;
        $document->save();
        } 
        // elseif(isset($request->document_name)) {
        // $name = $request->document_name;

        // if($name === 'proforma_invoice'){
            
        // }
        // elseif($name === 'idf'){
        //     $document = Document::findOrFail($request->id);
        //     $document->idf = $url;
        // }
        // elseif($name === 'commercial_invoice'){
        //     $document = Document::findOrFail($request->id);
        //     $document->commercial_invoice = $url;
        // }
        // elseif($name === 'bill_of_landing'){
        //     $document = Document::findOrFail($request->id);
        //     $document->bill_of_landing = $url; 
        // }
        // elseif($name === 'clearing_document'){
        //     $document = Document::findOrFail($request->id);
        //     $document->clearing_document = $url; 
        // }
       
        // }
        // $document->proforma_invoice = $request->proforma_invoice;
        // $document->idf = $request->idf;
        // $document->commercial_invoice = $request->commercial_invoice;
        // $document->bill_of_landing = $request->bill_of_landing;
        // $document->clearing_document = $request->clearing_documen;
        // $document->additional_document_name = $request->additional_document_name;
        // $document->additional_document = $request->additional_document;
        // $document->transaction_id = $request->transaction_id;
        // $document->save();
        //return redirect('/documents')->with('success', 'documents saved!');

        return redirect()->action(
            'TransactionController@index'
        )->with('success', 'document saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $document= Document::find($id);
        $additionals = Additional::where('document_id', '=', $id)->orderBy('created_at', 'desc');
        return view('document.adddocument', ['document' => $document, 'additionals' => $additionals]);
    }

    public static function download($id, $name)
    {
        $document= Document::find($id);
        $path = $document->$name;

        $download_link = asset($path);
        return $download_link;
    }

    public static function adddownload($id, $name)
    {
        $additional = Additional::where('document_id', '=', $id)->where('name', '=', $name)->orderBy('created_at', 'desc');
        if(isset($additional->document)){
        $path = $additional->document;
        $download_link = asset($path);
        return $download_link;
        }
    }

    public static function showstatic($id)
    {
        $document= Document::find($id);
        $additionals = Additional::where('document_id', '=', $id)->orderBy('created_at', 'desc');
        return $document;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $document = Document::findOrFail($id);
        return view('document.editdocument', compact('document'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $document = Document::findOrFail($id);
        $document->proforma_invoice = $request->proforma_invoice;
        $document->idf = $request->idf;
        $document->commercial_invoice = $request->commercial_invoice;
        $document->bill_of_landing = $request->bill_of_landing;
        $document->clearing_document = $request->clearing_document;
        $document->additional_document_name = $request->additional_document_name;
        $document->additional_document = $request->additional_document;
        $document->transaction_id = $request->transaction_id;
        $document->save();
        return redirect('/documents')->with('success', 'document updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $document = Document::findorFail($id);
        $document->delete();
        return redirect('/documents')->with('success', 'document deleted!');
    }
}