<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Item;
use Illuminate\Http\Request;
use App\Orders;
use Illuminate\Database\Eloquent\ModelNotFoundException;


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
        $items = Item::where('order_id',$id);

        return response()->json([
            'order_id'=>$id,
            'medecines'=>$items
            
            
            
            ]);

    }

    // public function store(AddressRequest $request){

    //     Address::create(array_merge(
    //         $request->all(), ['user_id' => $request->user()->id]));
        
    //     return response()->json(['state'=>'address is added']);

    // }

    // public function update(AddressRequest $request, $id){
    //     try{
    //         $address = 
    //         Address::where('user_id',$request->user()->id)
    //                 ->where('id', $id)->firstOrFail();
    //     }catch(ModelNotFoundException $ex){
    //         return response()->json(['state'=>'address is notfound']);
    //     }

    //     $address->update($request->all());
    //     return response()->json(['state'=>'address is updated']);
    // }

    // public function destroy(Request $request, $id){
    //     try{
    //         $address = 
    //         Address::where('user_id',$request->user()->id)
    //                 ->where('id', $id)->firstOrFail();
    //     }catch(ModelNotFoundException $ex){
    //         return response()->json(['state'=>'address is notfound']);
    //     }

    //     $address->delete();
    //     return response()->json(['state'=>'address is deleted']);

    // }
}
