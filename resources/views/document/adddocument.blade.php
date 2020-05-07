<style>
    {box-sizing: border-box;}
    
    
    
    </style>
    
    <script>
    
    function openForm() {
      document.getElementById("myForm").style.display = "block";
    }
    
    function closeForm() {
      document.getElementById("myForm").style.display = "none";
    }
    function openForm1() {
      document.getElementById("myForm1").style.display = "block";
    }
    
    function closeForm1() {
      document.getElementById("myForm1").style.display = "none";
    }
    </script>
    

@extends('layouts.app') @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Document</div>
                <div class="card-body">
                    <div class="form-popup" id="myForm1">
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                        <button style="margin-bottom:30px;" class="form-control" onclick="openForm(), closeForm1()">Other Document</button>
                            </div>
                        </div>
                    <form method="POST" style="margin-top: 30px; margin-bottom: 30px;" action="{{ route('documents.store') }}" enctype="multipart/form-data">
                        @csrf
                
                        <div class="form-group row">
                            <label for="document_name" class="col-md-4 col-form-label text-md-right">Document Type</label>
                            <div class="col-md-6">
                
                                <select class="form-control" id="document_name" name='document_name'>
                                    <option value="">-select document name-</option>
                                    <option value="idf">IDF</option>
                                    <option value="commercial_invoice">Commercial Invoice</option>
                                    <option value="bill_of_landing">Bill of Landing</option>
                                    <option value="clearing_document">Clearing Document</option>
                                </select>
                            </div>
                        </div>
                
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" for="image">Document File</label>
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
                 </div>

       
                <div class="form-popup" id="myForm" style="display:none;">
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                    <button style="margin-bottom:30px;" class="form-control" onclick="openForm1(), closeForm()">Official Documents</button>
                        </div>
                    </div>
                <form method="POST" style="margin-top: 30px; margin-bottom: 30px;" action="{{ route('documents.store') }}" enctype="multipart/form-data">
                    @csrf
                        
            
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">Document Type</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="name" name='name' placeholder="enter document name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="image">Document File</label>
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
                </div>
                </div></div>


            <div class="card">
                <div class="card-header">Saved Documents</div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif 
                    @php

                    $download = App\Http\Controllers\DocumentController::download($document->id, 'proforma_invoice');
                    $downloadidf = App\Http\Controllers\DocumentController::download($document->id, 'idf');
                    $downloadcommercial_invoice = App\Http\Controllers\DocumentController::download($document->id, 'commercial_invoice');
                    $downloadclearing_document = App\Http\Controllers\DocumentController::download($document->id, 'clearing_document');
                    $downloadbill_of_landing = App\Http\Controllers\DocumentController::download($document->id, 'bill_of_landing');
                    
                    $downloadadd = App\Http\Controllers\DocumentController::adddownload($document->id, 'proforma_invoice');

                    @endphp
                    @if ($document->proforma_invoice)
                    <div class="container">
                        <div class="row">
                            <div style="margin-bottom: 20px" class="col-lg-4 col-md-10">
                                <div class="card">
                                   
                                    <div class="card-body text-center">
                                        <div class="card-title">
                                            <strong>Proforma Invoice</strong>
                                            <a href="{{ $download }}" target="_blank">View</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endif
                        
                        @if($document->idf)

                        <div style="margin-bottom: 20px" class="col-lg-4 col-md-10">
                            <div class="card">
                               
                                <div class="card-body text-center">
                                    <div class="card-title">
                                        <strong>IDF</strong>
                                        <a href="{{ $downloadidf }}" target="_blank">View</a>
                                    </div>
                                </div>

                            </div>
                        </div>

                    @endif

                    @if($document->bill_of_landing)

                    <div style="margin-bottom: 20px" class="col-lg-4 col-md-10">
                        <div class="card">
                           
                            <div class="card-body text-center">
                                <div class="card-title">
                                    <strong>Bill of Landing</strong>
                                    <a href="{{ $downloadbill_of_landing }}" target="_blank">View</a>
                                </div>
                            </div>

                        </div>
                    </div>

                @endif

                    @if($document->commercial_invoice)

                    <div style="margin-bottom: 20px" class="col-lg-4 col-md-10">
                        <div class="card">
                           
                            <div class="card-body text-center">
                                <div class="card-title">
                                    <strong>Comm... Invoice</strong>
                                    <a href="{{ $downloadcommercial_invoice }}" target="_blank">View</a>
                                </div>
                            </div>

                        </div>
                    </div>


                @endif @if($document->clearing_document)

                <div style="margin-bottom: 20px" class="col-lg-4 col-md-10">
                    <div class="card">
                       
                        <div class="card-body text-center">
                            <div class="card-title">
                                <strong>Clearing Doc...</strong>
                                <a href="{{ $downloadclearing_document }}" target="_blank">View</a>
                            </div>
                        </div>

                    </div>
                </div>
            @endif
            @if($document->additional_document)

            <div style="margin-bottom: 20px" class="col-lg-4 col-md-10">
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
                </div>
    </div>
@endsection