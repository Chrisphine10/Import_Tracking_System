@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Transaction Details') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('transactions.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="proforma_invoice_number" class="col-md-4 col-form-label text-md-right">proforma invoice no</label>
                            <div class="col-md-6">
                                <input type="text" required class="form-control" id="proforma_invoice_number" name='proforma_invoice_number' placeholder="enter proforma invoice number">
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
                                    <option value="ATGS">ATGS</option>

                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
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
@endsection