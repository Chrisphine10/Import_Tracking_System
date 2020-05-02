@guest
@else

<nav class="navbar navbar-expand-md">
    <div class="container">
        <a style="margin:2px;" href="{{ url()->previous() }}" class="btn btn-success">Back</a>
        <a style="margin:2px;" href="{{ route('transactions.index')}}" class="btn btn-success">To Transactions</a>
    </div>
</nav>

@endguest