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
    //
    public function index(){
        return User::all();
    }

    public function store(Request $request){
        $validatedData = 
        $request->validate([
                'name'=> 'required',
                'email'=> 'required',
                // 'gender'=> 'required|in:male,female',
                'password'=> 'required',
                'password_confirmation' => 'required_with:password|same:password',
        //         // 'date_of_birth' => 'required',
        //         // 'profile_image'=> 'required',
        //         // 'mobile_number'=> 'required',
        //         // 'national_id'=> 'required' 
            ]);
            // User::create([
            //     'name' => $validatedData['name'],
            //     'email' => $validatedData['email'],
            //     'password' => Hash::make($validatedData['password']),
            //     // 'nat_id'=>'required'
            // ]);
            Mail::to( $validatedData['email'])->send(new WelcomeMail($validatedData));
    }
}
