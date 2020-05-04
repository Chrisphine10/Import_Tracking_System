<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
class SearchController extends Controller
{
   public function index()
{
return view('search.search');
}
public function search(Request $request)
{
if($request->ajax())
{
$output="";
$transactions=DB::table('transactions')->where('title','LIKE','%'.$request->search."%")->get();
if($transactions)
{
foreach ($transactions as $key => $transaction) {
$output.='<tr>'.
'<td>'.$transaction->id.'</td>'.
'<td>'.$transaction->title.'</td>'.
'<td>'.$transaction->description.'</td>'.
'<td>'.$transaction->price.'</td>'.
'</tr>';
}
return Response($output);
   }
   }
}
}