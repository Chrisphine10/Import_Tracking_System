@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Transaction</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="{{ route('suppliers.show', $supplier->id)}}" class="btn btn-primary">Supplier</a>
                    <a href="{{ route('transactions.show', $transaction->id) }}" class="btn btn-primary">Transaction Details</a>
                    <a href="{{ route('documents.show', $transaction->document_id) }}" class="btn btn-primary">Transaction Documents</a>
                    <a href="{{ route('transactions.index')}}" class="btn btn-primary">Confirm Clearance</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection