<?php

namespace App\Http\Controllers;

use App\Additional;
use Storage;
use Illuminate\Http\Request;

class AdditionalController extends Controller
{
    
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /**
     * Display the specified resource.
     *
     * @param  \App\Additional  $additional
     * @return \Illuminate\Http\Response
     */
    public function show(Additional $additional)
    {
        $additional= Additional::find($id);
        return view('additional.adddocument', ['additional' => $additional]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Additional  $additional
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $additional = Additional::findOrFail($id);
        return view('additional.editdocument', compact('additional'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Additional  $additional
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $additional = Additional::findOrFail($id);

        $additional->save();
        return redirect('/documents')->with('success', 'additional updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Additional  $additional
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $additional = D::findorFail($id);
        $additional->delete();
        return redirect('/documents')->with('success', 'additional deleted!');
    }
}
