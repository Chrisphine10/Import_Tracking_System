<?php

namespace App\Http\Controllers;

use App\Chart;
use App\User;
use App\Supplier;
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

        $year = date("Y");
        $month = date("m");

        $transact  = \Lava::DataTable();
        $transact->addStringColumn('month')
        ->addNumberColumn('Monthly Transactions');
       

        for ($i=1; $i<=12; $i++)
        {
              $dateObj   = \DateTime::createFromFormat('!m', $i);
              $monthName = $dateObj->format('F');
              $monthtransactions = Transaction::whereYear('date', $year)->whereMonth('date', $month)->orderBy('date')->get();
              $monthcount = count($monthtransactions);   
              $transact->addRow([
                    $monthName, (int) $monthcount //$transaction->proforma_invoice_number
                  ]);
                  
             
          }

          $allSuppliers = Supplier::all();
            $supplier  = \Lava::DataTable();
            $supplier->addStringColumn('Supplier')
                ->addNumberColumn('Transactions');

            $allusers = User::all();
            $user  = \Lava::DataTable();
            $user->addStringColumn('User')
                ->addNumberColumn('Transactions');
    

            foreach($allusers as $alluser)
            {
                $usertrans = Transaction::whereYear('created_at', $year)->whereMonth('date', $month)->where('user_id', '=', $alluser->id)->orderBy('date')->get();
                $count = count($usertrans);
          if($count > 0) { 
                $user->addRow([
                    $alluser->fname, $count
                 ]);
                }
            }

            foreach($allSuppliers as $allSupplier)
            {
                $suppliertrans = Transaction::whereYear('date', $year)->whereMonth('date', $month)->where('supplier_id', '=', $allSupplier->id)->orderBy('date')->get();
                $count = count($suppliertrans);
                if($count > 0) { 
                $supplier->addRow([
                    $allSupplier->name, $count
                 ]);
                }
            }
          
            $userbar = \Lava::AreaChart('User', $user, [
                'title' => 'Monthly User Transactions', 
                'legend' => ['position' => 'in'],
                'interpolateNulls'   => true
            ]);
            $supplierbar = \Lava::AreaChart('Supplier', $supplier, [
                'title' => 'Monthly Supplier Transactions', 
                'legend' => [
                    'position' => 'in']
            ]);
            $tran = \Lava::AreaChart('Transactions', $transact, [
                'title' => 'Monthly Transactions',
                'legend' => [
                    'position' => 'in']
            ]);
            return view('filter', compact(['userbar']), compact(['supplierbar']), compact(['tran']));     
//return $monthName;

}


   //$yearcount = count($yeartransactions);

     // $transactions = Transaction::whereYear('date', '2020')->whereMonth('date', '4')->orderBy('date')->get();
      //$monthcount = count($monthtransactions);
      

     
     /* $formatter  = \Lava::DateFormat([
          'pattern' => 'y-m-d',
      ]);
*/
      

      //$transact->addDateColumn('Date', $formatter)
     


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
          
        if (isset($request->year)) {
            $transact  = \Lava::DataTable();
            $transact->addStringColumn('month')
            ->addNumberColumn('Monthly Transactions');
            
            $year = $request->year;

            for ($i=1; $i<=12; $i++)
            {
                  $dateObj   = \DateTime::createFromFormat('!m', $i);
                  $monthName = $dateObj->format('F');
                  $monthtransactions = Transaction::whereYear('date', $year)->whereMonth('date', $i)->orderBy('date')->get();
                  $monthcount = count($monthtransactions); 
                  if($monthcount > 0) {   
                  $transact->addRow([
                        $monthName, (int) $monthcount //$transaction->proforma_invoice_number
                      ]);
                  }
                      
                 
              }
                    
    $tran = \Lava::AreaChart('Transactions', $transact, [
        'title' => 'Monthly Transactions',
        'legend' => [
            'position' => 'in']
    ]);
    return view('filter', compact(['tran']));
            

        }
        else {

            $allSuppliers = Supplier::all();
            $supplier  = \Lava::DataTable();
            $supplier->addStringColumn('Supplier')
                ->addNumberColumn('Transactions');

            $allusers = User::all();
            $user  = \Lava::DataTable();
            $user->addStringColumn('User')
                ->addNumberColumn('Transactions');
    
            $year = date('Y', strtotime($request->month));
            $month = date('m', strtotime($request->month));

            foreach($allusers as $alluser)
            {
                $usertrans = Transaction::whereYear('created_at', $year)->whereMonth('date', $month)->where('user_id', '=', $alluser->id)->orderBy('date')->get();
                $count = count($usertrans);
                if($count > 0) {  
                $user->addRow([
                    $alluser->fname, $count
                 ]);
                }
            }

            foreach($allSuppliers as $allSupplier)
            {
                $suppliertrans = Transaction::whereYear('date', $year)->whereMonth('date', $month)->where('supplier_id', '=', $allSupplier->id)->orderBy('date')->get();
                $count = count($suppliertrans);
                if($count > 0) {  
                $supplier->addRow([
                    $allSupplier->name, $count
                 ]);
                }
            }
          
             
    $userbar = \Lava::AreaChart('User', $user, [
        'title' => 'Monthly User Transactions',
        'legend' => [
            'position' => 'in']
    ]);
    $supplierbar = \Lava::AreaChart('Supplier', $supplier, [
        'title' => 'Monthly Suplier Transactions',
        'legend' => [
            'position' => 'in']
    ]);
    return view('filter', compact(['userbar']), compact(['supplierbar']));
        }
       
     
    
  

  // return view('filter', compact(['tran']));
  
  // I add these line
  
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
