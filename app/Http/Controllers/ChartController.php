<?php

namespace App\Http\Controllers;

use App\Chart;
use App\Transaction;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
        $stocksTable = \Lava::DataTable();

$stocksTable->addDateColumn('Day of Month')
            ->addNumberColumn('Projected')
            ->addNumberColumn('Official');

// Random Data For Example
for ($a = 1; $a < 30; $a++) {
    $stocksTable->addRow([
      '2015-10-' . $a, rand(800,1000), rand(800,1000)
    ]);
}

        $chart = \Lava::LineChart('Day of Month', $stocksTable);

        //return view('filter', compact('chart'));
       // return $stocksTable;
       return $chart; */
       $votes  = \Lava::DataTable();

$votes->addStringColumn('Food Poll')
      ->addNumberColumn('Votes')
      ->addRow(['Tacos',  rand(1000,5000)])
      ->addRow(['Salad',  rand(1000,5000)])
      ->addRow(['Pizza',  rand(1000,5000)])
      ->addRow(['Apples', rand(1000,5000)])
      ->addRow(['Fish',   rand(1000,5000)]);

      $lava = \Lava::BarChart('Votes', $votes);

return view('filter', compact(['lava'])); // I add these line
//return compact(['lava']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $transactions = Transaction::findOrFail('$id');

        $transactions  = \Lava::DataTable();

        $transactions->addDateColumn('Date')
        ->addNumberColumn('Price')
        ->addNumberColumn('Payment');

        foreach($transactions as $transaction)
{
        for ($a = 1; $a < 30; $a++) {
            $transactions->addRow([
              '2020-5-' . $a, $transaction->total_price, $transaction->payment_terms
            ]);
        }
    }
        
              $tran = \Lava::BarChart('Transactions', $transactions);
        
        return view('filter', compact(['tran']));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Chart  $chart
     * @return \Illuminate\Http\Response
     */
    public function show(Chart $chart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chart  $chart
     * @return \Illuminate\Http\Response
     */
    public function edit(Chart $chart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Chart  $chart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chart $chart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chart  $chart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chart $chart)
    {
        //
    }
}
