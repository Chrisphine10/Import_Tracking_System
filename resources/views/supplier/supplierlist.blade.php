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
                <div class="card-header">{{ __('Suppliers List') }}
                        <a style="margin-left: 20%;" href="{{ route('suppliers.create')}}" class="btn btn-primary">New Supplier</a>
                      
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
                                <th>name</th>
                                <th>email</th>
                                <th>phone number</th>
                            </tr>
                            <thead>
                            <tbody>
                                @foreach($suppliers as $supplier)
                                <tr>
                                    <td>{{$supplier->id}}</td>
                                    <td>{{$supplier->name}}</td>
                                    <td>{{$supplier->email}}</td>
                                    <td>{{$supplier->phone}}</td>
                                    <td>
                                        <div class="btn-toolbar" role="toolbar">
                                            <form action="{{ route('suppliers.show', $supplier->id) }}" method="get">
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
            {{ $suppliers->links() }}
        </div>
    </div>
</div>

@endsection