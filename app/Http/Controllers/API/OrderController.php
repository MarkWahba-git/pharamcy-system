<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ItemResource;
use App\Item;
use App\Pharmacy;
use Illuminate\Http\Request;
use App\Orders;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\PharmacyResource;
use App\Http\Requests\OrderRequest;
use App\Address;


class OrderController extends Controller
{
    public function index(Request $request){

        return $request->user()->orders;
    }

    public function show(Request $request, $id){
        try{
            //to make sure that this order belongs to this user 
            $order = Orders::where('user_id',$request->user()->id)
                    ->where('id', $id)->firstOrFail();

            
        }catch(ModelNotFoundException $ex){
            return response()->json(['state'=>'order is notfound']);
        }
        $items = Item::where('order_id',$id)->get();
        $items = ItemResource::collection($items);

        $order_total_price = $this->calculateTotalPricre($items);

        return response()->json([
            'order_id'=>$id,
            'medecines'=> $items,
            'order_total_price'=> $order_total_price,
            'ordered_at'=> date_diff(new \DateTime('now'),$order->created_at)->h .' hours ago',
            'status'=>$order->status,
            'assigned_pharmacy'=>new PharmacyResource(Pharmacy::find($order->pharmacy_id))
            
            ]);

    }

    public function store(OrderRequest $request){
        $userID = $request->user()->id;
        try{
            Address::where('user_id',request()->user()->id)
                ->where('id'->request()->address_id)->firstOrFail();
        }catch(ModelNotFoundException $ex){
            return response()->json([
                'state'=>'the address not found'
            ]);
        }
        Orders::create(
            array_merge($request->all(), [
                
                'user_id' => $request->user()->id,
                'status'=>'new'
                ]));
        
        return response()->json(['state'=>'order is added']);
    }
    
    public function update(OrderRequest $request, $id){
        try{
            $order = 
            Orders::where('user_id',$request->user()->id)
                    ->where('id', $id)->firstOrFail();
        }catch(ModelNotFoundException $ex){
            return response()->json(['state'=>'order is notfound']);
        }
        if($order->status =='new'){
            $order->update($request->all());
            return response()->json(['state'=>'order is updated']);
        }
        else{
            return response()->json(['state'=>'Cannot modify this order']);
        }
        
    }

    public function destroy(Request $request, $id){
        try{
            $order = 
            Orders::where('user_id',$request->user()->id)
                    ->where('id', $id)->firstOrFail();
        }catch(ModelNotFoundException $ex){
            return response()->json(['state'=>'order is notfound']);
        }
        if($order->status =='new'){
            $order->delete();
            return response()->json(['state'=>'order is deleted']);
        }
        else{
            return response()->json(['state'=>'Cannot delete this order']);
        }
    }

    private function calculateTotalPricre($items){
        $order_total_price = 0;
        foreach($items as $item){

            $order_total_price += $item->drug_qty * $item->drug_unit_price;
            return $order_total_price;
        }
    }
}
