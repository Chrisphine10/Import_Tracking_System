@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Transaction') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('transactions.update', $transaction->id) }}" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">proforma invoice no</label>
                            <div class="col-md-6">
                                <input type="text" required class="form-control" id="proforma_invoice_number" name='proforma_invoice_number'  value={{ $transaction->proforma_invoice_number }}>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">quantity</label>
                            <div class="col-md-6">
                                <input type="number" required class="form-control" id="quantity" name='quantity' value={{ $transaction->quantity }}>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">unit_price</label>
                            <div class="col-md-6">
                                <input type="number" required class="form-control" id="unit_price" name='unit_price' value={{ $transaction->unit_price }}>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">payment terms</label>
                            <div class="col-md-6">
                                <input type="text" required class="form-control" id="payment_terms" name='payment_terms' value={{ $transaction->payment_terms}}>
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