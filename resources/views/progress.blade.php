@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Transaction</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="{{ route('suppliers.create')}}" class="btn btn-primary">Add Supplier</a>
                    <a href="{{ route('transactions.create')}}" class="btn btn-primary">Transaction Details</a>
                    <a href="{{ route('transactions.index')}}" class="btn btn-primary">Transaction Documents</a>
                    <a href="{{ route('transactions.index')}}" class="btn btn-primary">Confirm Clearance</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection