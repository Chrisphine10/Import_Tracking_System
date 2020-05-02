@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-14 col-lg-10">
            <div class="card">
                <div class="card-header">Transaction id: {{ $transaction->id }}</div>

                <div class="card-body">
                <div class="container">

                <div class="row">

                    <div class="col-lg-5 col-md-5">
                        <div><p><strong>proforma_invoice_number</strong>
                        {{ $transaction->proforma_invoice_number }}
                        </p>
                        <p><strong>quantity</strong>
                        {{ $transaction->quantity }}
                        </p>
                        <p><strong>unit price</strong>
                        {{ $transaction->unit_price }}
                        </p>
                        <p><strong>total price</strong>
                        {{ $transaction->total_price }}
                        </p>
                        <p><strong>payment terms</strong>
                        {{ $transaction->payment_terms }}
                        </p>
                        <p><strong>user id</strong>
                        {{ $transaction->user_id }}
                        </p>

                      
                        <form action="{{ route('transactions.edit', $transaction->id) }}" method="get">
                            @csrf
                            <button type="submit" class="btn btn-secondary" style="margin-right: 1em;">edit</button>
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