@extends('layouts.app') @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="card">
                <div class="card-header">Add Document</div>
                <div class="card-body">
                    <form method="POST" style="margin-top: 30px; margin-bottom: 30px;" action="{{ route('documents.store') }}" enctype="multipart/form-data">
                        @csrf
                
                        <div class="form-group row">
                            <label for="document_name" class="col-md-4 col-form-label text-md-right">document name</label>
                            <div class="col-md-6">
                
                                <select class="form-control" id="document_name" required name='document_name'>
                                    <option value="">-select document name-</option>
                                    <option value="proforma_invoice">Proforma Invoice</option>
                                    <option value="idf">IDF</option>
                                    <option value="commercial_invoice">Commercial Invoice</option>
                                    <option value="bill_of_landing">Bill of Landing</option>
                                    <option value="clearing_document">Clearing Document</option>
                                    <option value="other_document">Other Document</option>
                                </select>
                            </div>
                        </div>
                
                
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">document name</label>
                            <div class="col-md-6">
                                <input type="text" required class="form-control" id="name" name='name' placeholder="enter document name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" for="image">Image</label>
                            <div class="col-md-6">
                                <input class="form-control" required type="file" name="image" id="image">
                            </div>
                        </div>
                
                        <input type="number" required id="id" name='id' hidden value={{ $document->id }}>
                
                                 <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                </form>
                </div></div>


            <div class="card">
                <div class="card-header">Saved Documents</div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif 
                    
                    @if ($document->proforma_invoice)
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-4 col-md-10">
                                <div class="card">
                                    <img src="{{ $document->proforma_invoice }}" alt="proforma_invoice" height="300px">
                                    <div class="card-body text-center">
                                        <div class="card-title"><strong>Proforma Invoice</strong>
                                            <br>
                                            <form action="{{ route('documents.show', $document->id) }}" method="get">
                                                @csrf
                                                <button type="submit" class="btn btn-primary" style="margin-right: 1em;">View Document</button>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endif @if($document->idf)

                        <div class="col-lg-4 col-md-10">
                            <div class="card">
                                <img src="{{ $document->idf }}" alt="idf" height="300px">

                                <div class="card-body text-center">
                                    <div class="card-title"><strong>IDF</strong>
                                        <br>
                                        <form action="{{ route('documents.show', $document->id) }}" method="get">
                                            @csrf
                                            <button type="submit" class="btn btn-primary" style="margin-right: 1em;">View Document</button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>


                    @endif @if($document->commercial_invoice)

                    <div class="col-lg-4 col-md-10">
                        <div class="card">
                            <img src="{{ $document->commercial_invoice }}" alt="commercial_invoice" height="300px">
                            <div class="card-body text-center">
                                <div class="card-title"><strong>Commercial Invoice</strong>
                                    <br>
                                    <form action="{{ route('documents.show', $document->id) }}" method="get">
                                        @csrf
                                        <button type="submit" class="btn btn-primary" style="margin-right: 1em;">View Document</button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>


                @endif @if($document->clearing_document)

                <div class="col-lg-4 col-md-10">
                    <div class="card">
                        <img src="{{ $document->clearing_document }}" alt="clearing_document" height="300px">

                        <div class="card-body text-center">
                            <div class="card-title"><strong>Clearing Document</strong>
                                <br>
                                <form action="{{ route('documents.show', $document->id) }}" method="get">
                                    @csrf
                                    <button type="submit" class="btn btn-primary" style="margin-right: 1em;">View Document</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>

            @endif
            @if($document->additional_document)

            <div class="col-lg-4 col-md-10">
                <div class="card">
                    <img src="{{ $document->additional_document }}" alt="additional_document" height="300px">
                    <div class="card-body text-center">
                        <div class="card-title"><strong>Additional Document</strong>
                            <br>
                            <form action="{{ route('documents.show', $document->id) }}" method="get">
                                @csrf
                                <button type="submit" class="btn btn-primary" style="margin-right: 1em;">View Document</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
             
@endif
</div>
</div>

                    </div>
                </div>
@endsection