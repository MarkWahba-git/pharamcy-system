<?php

namespace App\Http\Controllers;
use  App\DataTables\MyOrderDatatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Orders;
use DataTables;
use App\User;
class OrdersController extends Controller
{
    
   
    public function index()
    {
         
        return view('orders.index');
    }

    public function getData()
    {   
        
        $orders = Orders::join('users', 'orders.user_id', '=', 'users.nat_id')
        ->select(['users.street_name','orders.id', 'orders.status', 'users.name', 'users.email', 'orders.created_at','orders.is_insured','users.role'])->where('users.role','user');

        return Datatables::of($orders)->make(true);
    }
}

