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
            
            @can('create', App\Transaction::class)
            @endcan
            </div>
            <div class="card">
                <div class="card-header">{{ __('Transactions List') }}                   
                </div>
                <div class="card-body">
                    <div class="col-sm-12">
                        @if(session()->get('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                        @endif
                    </div>
                    <div style="overflow-x:scroll;" class="col-sm-12">
                    <table class="table table-condenced">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>proforma_invoice_no</th>
                                <th>quantity</th>
                                <th>unit_price</th>
                                <th>total_price</th>
                                <th>payment_terms</th>
                                <th>added_by</th>
                                <th>supplier</th>
                                <th>status</th>
                                <th>details</th>
                                <th>created_at</th>
                                <th>documents</th>
                                

                            </tr>
                            <thead>
                            <tbody>
                                @foreach($transactions as $transaction)
                                <tr>
                                    <td>{{$transaction->id}}</td>
                                    <td>
                                    @php
                                    $document = App\Http\Controllers\DocumentController::showstatic($transaction->document_id);
                                    @endphp
                                    <a href="{{ route('documents.show',  $document->id)}}"> {{ $transaction->proforma_invoice_number }}</a>
                                    </td>
                                    <td>{{$transaction->quantity}}</td>
                                    <td>{{$transaction->unit_price}}</td>
                                    <td>{{$transaction->total_price}}</td>
                                    <td>{{$transaction->payment_terms}}</td>
                                    <td>
                                    @php
                                    $user = App\Http\Controllers\UserController::showstatic($transaction->user_id);
                                    echo $user->name;
                                    @endphp
                                    </td>
                                    <td>
                                    @php
                                    $supplier = App\Http\Controllers\SupplierController::showstatic($transaction->supplier_id);
                                    @endphp
                                    <a href="{{ route('suppliers.show',  $supplier->id)}}"> {{ $supplier->name }}</a>
                                    </td>
                                    <td>{{$transaction->status}}</td>
                                 
                                    <td>
                                        <a href="{{ route('progresses.show', $transaction->id) }}">
                                             details</a>
                                    </td>
                                    <td>
                                        {{$transaction->created_at}}
                                    </td>
                                    <td>
                                        <a href="{{ route('documents.show',  $document->id)}}"> view documents</a>
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
</div>
@endsection