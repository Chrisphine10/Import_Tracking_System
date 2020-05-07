<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Import Tracking System') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/transactions') }}">
                    {{ config('app.name', 'Import Tracking System') }}
                </a>
                              
               
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li>
                        @guest
                                
                        @else
                        @can('create', App\User::class)
                        <a style="margin:2px;" href="{{ route('home')}}" class="btn btn-success">Admin Dashboard</a>
                        @endcan
                        @endguest    
                    </li>


                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                           
                        @else
                        
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                  {{ Auth::user()->role }} : {{ Auth::user()->fname }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>

                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @guest
        @else
        <nav class="navbar navbar-expand-md">

            <div class="container">
<ul class="navbar-nav mr-auto">
    <li>
        <a style="margin:2px;" href="{{ route('transactions.create')}}" class="btn btn-success">Add Transaction</a>
    </li>
    <li>
        <a style="margin:2px;" href="{{ route('suppliers.index')}}" class="btn btn-success">Suppliers</a>
    </li>
    @can('viewAny', App\Transaction::class)
    <li>
        <a style="margin:2px;" href="{{ route('filters.index')}}" class="btn btn-success">Transaction Reports</a>
    </li>

    @endcan
    
        <li>
            <form action="{{ url('/dateFilter') }}" method="get" enctype="multipart/form-data">
                @csrf
                <ul class="navbar-nav">
               <li><label for="start">From:</label></li>
               <li> <input class="form-control" required type="date" name="start" id="start"></li>
               <li> <label for="stop">To:</label></li>
               <li> <input class="form-control" required type="date" name="stop" id="stop"></li>
               <li> <input class="btn btn-primary" type="submit" name="submit" value="Filter" id="submit">
               </li>
           </ul>
            
           </form>
       </li>
       <li>

        <form action="{{ url('/searches') }}" method="GET" class="navbar-form navbar-left" role="search">
            @csrf
                <ul class="navbar-nav mr-auto">
                    <li>
              <input class="form-control" type="search" name="search" id="search">
          </li><li>
              <button type="submit" class="btn btn-warning">Search</button>
              </li>
                </ul>
              </form> 
        
        </li>
            
  
</ul>
            
            
            
       
            </div>

         </nav>
         
       
         @endguest

        <main class="py-4">
            @yield('content')
        </main>
     
@extends('layouts.navigate')
@section('content')
@endsection
    </div>
</body>
</html>
