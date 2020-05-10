<script type="text/javascript">
    function test (event, chart) {
        alert('Test');
        // Useful for using chart methods such as chart.getSelection();
        console.log(chart);
    }
</script>
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Report</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form style="margin-top:30px; margin-bottom:30px;" method="GET" action="{{ route('charts.index')}}" enctype="multipart/form-data">
                        @csrf
                    <input type="submit" name="type" value="Current Report" id="type" class="btn btn-primary">
                    </form>

                 <div class="card" style="margin-bottom: 20px;">
                    @if(Lava::exists('AreaChart', 'Transactions'))
                    <div id="transact">
                        {!! \Lava::render('AreaChart', 'Transactions', 'transact') !!}
                    </div>
                    @endif
                </div>        
               
                <div class="card" style="margin-bottom: 20px;">
                    @if(Lava::exists('AreaChart', 'Supplier'))
                    <div id="supplier">
                        {!! \Lava::render('AreaChart', 'Supplier', 'supplier') !!}
                    </div>
                    @endif
                </div>

                <div class="card" style="margin-bottom: 20px;">    
                    @if(Lava::exists('AreaChart', 'User'))
                    <div id="trans">
                        {!! \Lava::render('AreaChart', 'User', 'trans') !!}
                    </div>
                    @endif
                </div>
                    

                </div>
            </div>
        </div>
    </div>
</div>
@endsection