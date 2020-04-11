<?php

namespace App\Http\Controllers\API;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class UserController extends Controller 
{

    public function store(Request $request){
        $validatedData = 
            $request->validate([
                'name'=> 'required',
                'email'=> 'required|email',
                'gender'=> 'required|in:male,female',
                'password'=> 'required',
                'password_confirmation' => 'required_with:password|same:password',
                'dob' => 'required|date',
                // 'avatar'=> 'required|Image',
                'phone_number'=> 'required',
                'nat_id'=> 'required' 
            ]);
        
        $validatedData['password']=Hash::make($validatedData['password']);
        unset($validatedData["password_confirmation"]); 

        try{
            User::create($validatedData);
        }catch(QueryException $ex){
            return response()->json(['state'=>'registeration failed email already registerd']);
        }
        
        Mail::to( $validatedData['email'])->send(new WelcomeMail($validatedData));
        return response()->json(['state'=>'registeration done']);
    }

    public function update(Request $request){
        
        $user = $request->user();

        $validatedData = 
            $request->validate([
                'name'=> 'required',
                // 'email'=> 'required|email',
                'gender'=> 'required|in:male,female',
                'password'=> 'required',
                'password_confirmation' => 'required_with:password|same:password',
                'dob' => 'required|date',
                // 'avatar'=> 'required|Image',
                'phone_number'=> 'required',
                'nat_id'=> 'required' 
            ]);

        $user->update($validatedData);
        return response()->json(['state'=>'update done']);


    }
}
