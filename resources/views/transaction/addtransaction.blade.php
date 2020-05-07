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

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Transaction Details') }}</div>

                <div class="card-body">   
                    <div class="form-group row mb-0">
                        
                        <div id="myForm1" class="col-md-6 offset-md-4">
                    <button style="margin-bottom:30px;" class="form-control" onclick="openForm(), closeForm1()">Add Supplier</button>
                        </div>
                    </div>
                    <div class="form-popup" id="myForm" style="display:none;">
                        <div class="form-group row">
                            <div class="col-md-8 col-form-label text-md-right">
                        <label>Enter Supplier Details</label>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('suppliers.store') }}" class="form-container">
                            @csrf
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">supplier name</label>
                        <div class="col-md-6">
                            <input type="text" required class="form-control" id="name" name='name' placeholder="enter supplier name">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">supplier email</label>
                        <div class="col-md-6">
                            <input type="email" required class="form-control" id="email" name='email' placeholder="enter supplier email">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">supplier phone</label>
                        <div class="col-md-6">
                            <input type="text" required class="form-control" id="phone" name='phone' placeholder="enter supplier phone">
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                    <button type="submit" style="margin-bottom:10px;" class="form-control btn-warning">Add Supplier</button>
                        </form>
                    <button type="submit" class="form-control btn-danger" onclick="openForm1(), closeForm()">Close</button>
                        </div>
                    </div>
                 </div>


                            <form style="margin-top:30px; margin-bottom:30px;" method="POST" action="{{ route('transactions.store') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group row">
                                    <label for="supplier" class="col-md-4 col-form-label text-md-right">Supplier</label>
                                    <div class="col-md-6">
        
                                        <select onclick="closeForm()" class="form-control" id="supplier_id" required name='supplier_id'>
                                            <option value="">-select supplier-</option>
                                            @php
                                                 $suppliers = App\Http\Controllers\SupplierController::all();
                                            @endphp
                                            @foreach($suppliers as $supplier)
                                                
                                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                           
                                            @endforeach
                                            
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right"></label>
                                    <label class="col-md-6">Product Details</label>
                                </div>
                                <div class="form-group row">
                                    <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>
                                    <div class="col-md-6">
                                        <textarea type="text" required class="form-control" style="height: 200px;" name="description" id="description" placeholder="Write a short description"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="quantity" class="col-md-4 col-form-label text-md-right">quantity</label>
                                    <div class="col-md-6">
                                        <input type="number" required class="form-control" id="quantity" name='quantity' placeholder="enter quantity">
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <label for="unit_price" class="col-md-4 col-form-label text-md-right">unit price</label>
                                    <div class="col-md-6">
                                        <input type="number" required class="form-control" id="unit_price" name='unit_price' placeholder="enter unit_price">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="payment_terms" class="col-md-4 col-form-label text-md-right">payment terms</label>
                                    <div class="col-md-6">
        
                                        <select class="form-control" id="payment_terms" required name='payment_terms'>
                                            <option value="">-select payment method-</option>
                                            <option value="cheque">cheque</option>
                                            <option value="swift">swift</option>
                                            <option value="RTGS">RTGS</option>
        
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="date" class="col-md-4 col-form-label text-md-right">date</label>
                                    <div class="col-md-6">
                                        <input class="form-control" required type="date" name="date" value="" id="date">
                                    </div>
                                </div>


                                
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right"></label>
                                    <label class="col-md-6">Document Upload</label>
                                </div>


                                <div class="form-group row">
                                    <label for="proforma_invoice_number" class="col-md-4 col-form-label text-md-right">proforma invoice no</label>
                                    <div class="col-md-6">
                                        <input type="text" required class="form-control" id="proforma_invoice_number" name='proforma_invoice_number' placeholder="enter proforma invoice number">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="image" class="col-md-4 col-form-label text-md-right" for="image">Image</label>
                                    <div class="col-md-6">
                                        <input class="form-control" required type="file" name="image" id="image">
                                    </div>
                                </div>
        
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-warning">
                                            {{ __('Submit') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                          </div>
                        </div>     
                </div>
            
                </div>
            </div>
        </div>
    </div>
</div>
@endsection