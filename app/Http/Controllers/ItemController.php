<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Drug;
use App\User;
use App\Item;
use DB;
class ItemController extends Controller
{

    function orderDrugs()
    {
        $request = request();
        $order_id = $request->order_id;
        $drugs_list = DB::table("drugs")
                    ->groupBy("drug_name")
                    ->get();
        $users_list = DB::table("users")
                        ->get();
        return view('drugs.order_drugs',[
          'drugs_list'=>$drugs_list,
          'users_list'=>$users_list,
          'order_id'=>$order_id,
        ]);                 
        // return view('drugs.order_drugs',compact('drugs_list'))->with(
        //     'drugs_list', $drugs_list
        // );
       
    }
    function store(Request $request)
    {
            if (count($request->drug_name)> 0 )
            {
                foreach($request->drug_name as $key => $value)
                {
                    $data = array(
                        'order_id'=>$request->order_id,
                        'drug_name'=>$request->drug_name[$key],
                        'drug_type'=>$request->drug_type[$key],
                        'drug_qty'=>$request->drug_qty[$key],
                        'drug_unit_price'=>$request->drug_unit_price[$key],
                        'drug_amount'=>$request->amount[$key],
                    );
                
                Item::insert($data);

            }
                    $total = $request->total;
                    return redirect()->route('payment.takepayment',['user_id'=>1,'total'=>$total])->with('success','Please confirm the Customer Card details to Notify Him');
                
            }
                
    }
}
