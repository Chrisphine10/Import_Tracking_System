@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Admin Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="{{ route('register') }}" class="btn btn-primary">Add User</a>
                    <a href="{{ route('users.index')}}" class="btn btn-primary">Manage Users</a>
                    <a href="{{ route('transactions.index')}}" class="btn btn-primary">Transactions List</a>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection