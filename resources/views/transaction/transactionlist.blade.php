<script>
 
function printContent(printpage){
    var headstr = "<html><head><title>" + document.title + "</title></head><body>";
            var footstr = "</body>";
            var newstr = document.all.item(printpage).innerHTML;
            var oldstr = document.body.innerHTML;
            document.body.innerHTML = headstr + newstr + footstr;
            window.print();
            document.body.innerHTML = oldstr;
            return true;
}

</script>

<style>

@media print {
    #print {
        background-color: white;
        height: 100%;
        width: 100%;
        position: fixed;
        top: 0;
        left: 0;
        margin: 0;
        padding: 15px;
        font-size: 14px;
        line-height: 18px;
    }
}
table th {
    color: black;
}
</style>

@extends('layouts.app')

@section('content')
<script
      src="https://code.jquery.com/jquery-3.2.1.js"
      integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
      crossorigin="anonymous">
   </script>
 @can('create', App\Transaction::class)
 @endcan


 

<div class="container">
        <div class="row justify-content-center">
        <div class="col-md-14">

               <div class="card">
                <div class="card-header">{{ __('Transactions List') }}
                    <button style="margin:2px;" onclick="printContent('print')">Print</button> 
                 
                </div>
                
                <div class="card-body">
                    <div class="col-sm-12">
                        @if(session()->get('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                        @endif
                    </div>
                    <div id="print">
                        <div class="card">
                    <table class="table table-condenced">
                        <thead>
                            <tr>
                                <th>@sortablelink('id', "id")</th>
                                <th>@sortablelink('description', "description")</th>
                                <th>@sortablelink('proforma_invoice_number', "invoice no.")</th>
                                <th>@sortablelink('quantity', "quantity")</th>
                                <th>@sortablelink('unit_price', "unit price")</th>
                                <th>@sortablelink('total_price', "total price")</th>
                                <th>@sortablelink('payment_terms', "payment")</th>
                                <th>@sortablelink('supplier_id', "supplier")</th>
                                <th>@sortablelink('status', "status")</th>
                                <th>@sortablelink('date', "date")</th>
                                <th>@sortablelink('added_by', "added by")</th>
                                <th>details</th>
                                <th>documents</th>
                                

                            </tr>
                            <thead>
                            <tbody>
                                @foreach($transactions as $transaction)
                                <tr>
                                    <td>{{$transaction->id}}</td>
                                    <td>{{$transaction->description}}</td>
                                    <td>
                                    @php
                                    $document = App\Http\Controllers\DocumentController::showstatic($transaction->document_id);

                                    $download = App\Http\Controllers\DocumentController::download($transaction->document_id, 'proforma_invoice');
                                    @endphp
                                    <a href="{{ $download }}" target="_blank"> {{ $transaction->proforma_invoice_number }}</a>
                                    </td>
                                    <td>{{$transaction->quantity}}</td>
                                    <td>{{$transaction->unit_price}}</td>
                                    <td>{{$transaction->total_price}}</td>
                                    <td>{{$transaction->payment_terms}}</td>
                                    
                                    <td>
                                    @php
                                    $supplier = App\Http\Controllers\SupplierController::showstatic($transaction->supplier_id);
                                    @endphp
                                    <a href="{{ route('suppliers.show',  $supplier->id)}}"> {{ $supplier->name }}</a>
                                    </td>
                                    <td>{{$transaction->status}}</td>
                                 
                                    <td>
                                        {{$transaction->date}}
                                    </td>
                                    <td>
                                        @php
                                        $user = App\Http\Controllers\UserController::showstatic($transaction->user_id);
                                        echo $user->fname;
                                        @endphp
                                        </td>
                                    <td>
                                        <a href="{{ route('progresses.show', $transaction->id) }}">
                                             details</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('documents.show',  $transaction->document_id)}}"> view documents</a>
                                    </td>
                                  
                                </tr>
                                @endforeach
                            </tbody>
                    </table>
                </div>
                    </div>


                </div>
            </div>
            {!! $transactions->appends(\Request::except('page'))->render() !!}
        </div>
    </div>
</div>
@endsection