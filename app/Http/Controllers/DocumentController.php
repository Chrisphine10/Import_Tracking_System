<?php

namespace App\Http\Controllers;

use App\Document;
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
        return view('document.documentlist', compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('document.adddocument');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $document = new Document();
        $document->proforma_invoice = $request->proforma_invoice;
        $document->idf = $request->idf;
        $document->commercial_invoice = $request->commercial_invoice;
        $document->bill_of_landing = $request->bill_of_landing;
        $document->clearing = $request->clearing;
        $document->additional_document_name = $request->additional_document_name;
        $document->additional_document = $request->additional_document;
        $document->transaction_id = $request->transaction_id;
        $document->save();
        return redirect('/documents')->with('success', 'documents saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($document= Document::find($id)){}
        else {
            $document = Document::where('transaction_id', '=', $id)->paginate(10);
        }
        return view('document.documentview', ['document' => $document]);
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