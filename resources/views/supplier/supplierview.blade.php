@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-14 col-lg-10">
            <div class="card">
                <div class="card-header">Supplier id: {{ $supplier->id }}</div>

                <div class="card-body">
                <div class="container">

                <div class="row">

                    <div class="col-lg-5 col-md-5">
                        <div><p><strong>Name </strong>
                        {{ $supplier->name }}
                        </p>
                        <p><strong>email</strong>
                        {{ $supplier->email }}
                        </p>
                        <p><strong>phone contact</strong>
                        {{ $supplier->phone }}
                        </p>
                        

                        <form action="{{ route('suppliers.edit', $supplier->id) }}" method="get">
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