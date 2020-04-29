@extends('layouts.app')

@section('content')
<script
      src="https://code.jquery.com/jquery-3.2.1.js"
      integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
      crossorigin="anonymous">
   </script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-14">
            <div class="card">
                <div class="card-header">{{ __('Transactions List') }}
                    <div style="text-align: center">
                    <a href="{{ route('suppliers.create')}}" class="btn btn-primary">New Transaction</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-sm-12">
                        @if(session()->get('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                        @endif
                    </div>

                    <table class="table table-condenced">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>proforma_invoice_number</th>
                                <th>quantity</th>
                                <th>unit_price</th>
                                <th>total_price</th>
                                <th>payment_terms</th>
                                <th>user_id</th>
                                <th>supplier_id</th>
                                <th>status</th>
                                <th></th>
                            </tr>
                            <thead>
                            <tbody>
                                @foreach($transactions as $transaction)
                                <tr>
                                    <td>{{$transaction->id}}</td>
                                    <td>{{$transaction->proforma_invoice_number}}</td>
                                    <td>{{$transaction->quantity}}</td>
                                    <td>{{$transaction->unit_price}}</td>
                                    <td>{{$transaction->total_price}}</td>
                                    <td>{{$transaction->payment_terms}}</td>
                                    <td>{{$transaction->user_id}}</td>
                                    <td>{{$transaction->supplier_id}}</td>
                                    <td>{{$transaction->status}}</td>
                                    <td>
                                        <div class="btn-toolbar" role="toolbar">
                                            <form action="{{ route('transactions.show', $transaction->id) }}" method="get">
                                                @csrf
                                                <button type="submit" class="btn btn-primary" style="margin-right: 1em;">view</button>
                                            </form>

                                        </div> 
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection