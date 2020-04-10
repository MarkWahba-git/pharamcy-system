<?php

namespace App\Http\Controllers\API;

use App\Address;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AddressRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class AddressController extends Controller
{
    public function index(Request $request){

        return $request->user()->addresses;
    }

    public function store(AddressRequest $request){

        Address::create(array_merge(
            $request->all(), ['user_id' => $request->user()->id]));
        
        return response()->json(['state'=>'address is added']);

    }

    public function update(AddressRequest $request, $id){
        try{
            $address = 
            Address::where('user_id',$request->user()->id)
                    ->where('id', $id)->firstOrFail();
        }catch(ModelNotFoundException $ex){
            return response()->json(['state'=>'address is notfound']);
        }

        $address->update($request->all());
        return response()->json(['state'=>'address is updated']);
    }

    public function destroy(Request $request, $id){
        try{
            $address = 
            Address::where('user_id',$request->user()->id)
                    ->where('id', $id)->firstOrFail();
        }catch(ModelNotFoundException $ex){
            return response()->json(['state'=>'address is notfound']);
        }

        $address->delete();
        return response()->json(['state'=>'address is deleted']);

    }
}