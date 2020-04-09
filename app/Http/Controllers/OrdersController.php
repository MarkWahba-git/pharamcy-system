<?php

namespace App\Http\Controllers;
use  App\DataTables\MyOrderDatatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Orders;
use DataTables;
use App\User;
use App\Doctor;
class OrdersController extends Controller
{
    
   
    public function index()
    {
        
         $orders=Orders::join('users','orders.user_id','=','users.id')->get();

        return view('orders.index',[
            
          
            'orders'=>$orders
        ]);
    }

    public function getData()
    {   
        
        $orders = Orders::join('pharmacies', 'orders.pharmacy_id', '=', 'orders.id')
       ->join('doctors','doctors.id','=','orders.doctor_id')
       ->join('users','users.id','=','orders.user_id')->get();
        return Datatables::of($orders)->editColumn('created_at', function ($order) {
            return $order->created_at->toDateString();})
            ->addColumn('action', function($order){
                return '<a href="#" class="btn btn-xs btn-primary edit" id="'.$order->id.'"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })->make(true);
    }
    /*function postdata(Request $request)
    {   
        

        $validation = Validator::make($request->all(), [
            
            
        ]);

        $error_array = array();
        $success_output = '';
        if ($validation->fails())
        {
            foreach($validation->messages()->getMessages() as $field_name => $messages)
            {
                $error_array[] = $messages;
            }
        }
        else
        {     
            
            if($request->get('button_action') == "insert")
             {  
                 
                $orders = new Orders([
                    'user_id'    =>  $request->get('user_id'),
                    'pharmacy_id'    =>  $request->get('pharmacy_id'),
                    'Doctor_id'    =>  $request->get('Doctor_id'),
                    'is_insured'    =>  $request->get('is_insured'),
                    'status'    =>  $request->get('status'),
                    'created_at'    =>  $request->get('created_at'),
                ]);
                $orders->save();
                $success_output = '<div class="alert alert-success">Data Inserted</div>';
            }
        }
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );
        echo json_encode($output);
    }*/

}

