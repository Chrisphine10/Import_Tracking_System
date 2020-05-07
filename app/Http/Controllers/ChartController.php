<?php

namespace App\Http\Controllers;

use App\Chart;
use App\User;
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

      $transactions = Transaction::all();

      $transact  = \Lava::DataTable();
     /* $formatter  = \Lava::DateFormat([
          'pattern' => 'y-m-d',
      ]);
*/
      

      //$transact->addDateColumn('Date', $formatter)
      $transact->addStringColumn('month')
      ->addNumberColumn('Price');


      foreach($transactions as $transaction)
{
      $date = $transaction->date;
      $monthNum  = date('m', strtotime($date));
      $dateObj   = \DateTime::createFromFormat('!m', $monthNum);
      $monthName = $dateObj->format('F');
      $date = $transaction->date;
          $transact->addRow([
            $monthName, (int) $transaction->total_price //$transaction->proforma_invoice_number
          ]);
          
     
  }
/*
  $allusers = User::all();
  

$user  = \Lava::DataTable();
$user->addStringColumn('month');
foreach($allusers as $alluser){

    $user->addNumberColumn($alluser->fname);
}
//$months = array("Jan","Feb","Mar","Apr","May","Jun","Jul","Agu","Sep","Oct","Nov","Dec");


//foreach ($months as $month) {
  
foreach($allusers as $alluser){

    $usertrans = Transaction::where('user_id', '=', $alluser->id)->get();
    $count = count($usertrans);
    foreach ($usertrans as $usertran) {
$date = $usertran->date;
$monthNum  = date('m', strtotime($date));
$dateObj   = \DateTime::createFromFormat('!m', $monthNum);
$monthName = $dateObj->format('F');
        $user->addRow([
            $monthName, $count
         ]);
    }

}
$usertrans = Transaction::join('users', 'transactions.user_id', 'users.id')->get();
$user  = \Lava::DataTable();
$user->addStringColumn('month')
    ->addNumberColumn('user');

foreach($usertrans as $usertran){
    $date = $usertran->date;
    $monthNum  = date('m', strtotime($date));
    $dateObj   = \DateTime::createFromFormat('!m', $monthNum);
    $monthName = $dateObj->format('F');
    return $usertrans;
    $user->addRow([
    $monthName, $usertran->fname
    ]);
}
*/
    $allusers = User::all();
    $user  = \Lava::DataTable();
    $user->addStringColumn('User')
        ->addNumberColumn('Transactions');

    foreach($allusers as $alluser)
    {
        $usertrans = Transaction::where('user_id', '=', $alluser->id)->get();
        $count = count($usertrans);

        $user->addRow([
            $alluser->fname, $count
         ]);
    }

      
            $tran = \Lava::AreaChart('Transactions', $transact);
            $userbar = \Lava::ScatterChart('Votes', $user);
     // return view('filter', compact(['tran']));

return view('filter', compact(['tran']), compact(['userbar'])); // I add these line

//return $monthName;

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
        
        //return $transactions;
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
