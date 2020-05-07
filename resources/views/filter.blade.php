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
                    <input type="submit" name="type" id="type" class="btn btn-primary">
                    </form>

                  
                    @if(Lava::exists('BarChart', 'Votes'))
                    <div id="trans">
                        {!! \Lava::render('BarChart', 'Votes', 'trans') !!}
                    </div>
                    @else
                        <p>Chart not found!</p>
                    @endif

            

                    @if(Lava::exists('BarChart', 'Transactions'))
                    <div id="transact">
                        {!! \Lava::render('BarChart', 'Transactions', 'transact') !!}
                    </div>
                    @else
                        <p>Chart not found!</p>
                    @endif
                      
                    
                    

                </div>
            </div>
        </div>
    </div>
</div>
@endsection