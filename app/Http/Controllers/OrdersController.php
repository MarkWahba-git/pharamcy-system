<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Orders;
use DataTables;
use App\User;
use App\Doctor;
use Validator;
use App\Pharmacy;

class OrdersController extends Controller
{
    
   
    public function index()
    {
        
        $users=User::get()->where('role','user');
        
        $doctors=User::join('doctors','doctors.dr_user','users.id')->get()->where('role','doctor');
        $pharmacies=User::join('pharmacies','pharmacies.owner_id','=','users.id')->get();
       
        return view('orders.index',[
            'users'=>$users,
            'doctors'=>$doctors,
            'pharmacies'=>$pharmacies
        ]);
    }

    public function getData()
    {   
      
                
        $orders = Orders::join('users','orders.user_id','users.id')->
        join('doctors','doctors.id','=','orders.doctor_id')
        ->join('addresses','addresses.id','=','orders.user_id')->select(['orders.id','users.name','doctors.doctor_name','addresses.street_name','orders.created_at','orders.is_insured','orders.status']);
        

        return Datatables::of($orders)->editColumn('created_at', function ($order) {
            return $order->created_at->toDateString();})
            ->addColumn('action', function($student){
                return '<a href="#" class="btn btn-xs btn-primary edit" id="'.$student->id.'"><i class="glyphicon glyphicon-edit"></i> Edit</a><a href="#" class="btn btn-xs btn-danger delete" id="'.$student->id.'"><i class="glyphicon glyphicon-remove"></i> Delete</a>';
            })->make(true);

    }
     function postOrders(Request $request){
        
        $validation = Validator::make($request->all(), [
            'user_id' => 'required',
            'status'=>'required'
            
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
                    'user_id'    =>  $request->user_id,
                    'status'    =>  $request->status,
                    'is_insured'=> $request->is_insured,
                    'doctor_id'=>$request->doctor_id,
                    'pharmacy_id'=>$request->pharmacy_id
                    
                ]);
                $orders->save();
                $success_output = '<div class="alert alert-success">Data Inserted</div>';
            }
            if($request->get('button_action') == 'update')
            {
                $order = Orders::find($request->get('order_id'));
                $order->user_id = $request->get('user_id');
                $order->status = $request->get('status');
                $order->is_insured = $request->get('is_insured');
                $order->doctor_id = $request->get('doctor_id');
                $order->pharmacy_id = $request->get('pharmacy_id');

                $order->save();
                $success_output = '<div class="alert alert-success">Data Updated</div>';
            }
        }
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );
        echo json_encode($output);
    }
    function fetchorder(Request $request)
    {
        $id = $request->input('id');
        $student = Orders::find($id);
        $output = array(
            'user_id'    =>  $request->user_id,
            'status'    =>  $request->status,
            'is_insured'=> $request->is_insured,
            'doctor_id'=>$request->doctor_id,
            'pharmacy_id'=>$request->pharmacy_id
        );
        echo json_encode($output);
    }
    function removeorder(Request $request)
    {
        $order = Orders::find($request->input('id'));
        if($order->delete())
        {
            echo 'Data Deleted';
        }
    }


}

