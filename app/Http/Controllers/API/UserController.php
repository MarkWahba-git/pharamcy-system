<?php

namespace App\Http\Controllers\API;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


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

        
        User::create($validatedData);
        
        Mail::to( $validatedData['email'])->send(new WelcomeMail($validatedData));
        return response()->json(['state'=>'registeration done']);
    }

    public function edit(Request $request){
        
        $user = $request->user();

        $validatedData = 
            $request->validate([
                'name'=> 'required',
                // 'gender'=> 'required|in:male,female',
                'password'=> 'required',
                'password_confirmation' => 'required_with:password|same:password',
                // 'date_of_birth' => 'required',
                // 'profile_image'=> 'required',
                // 'mobile_number'=> 'required',
                // 'national_id'=> 'required' 
            ]);

        $user->update($validatedData);

    }
}
