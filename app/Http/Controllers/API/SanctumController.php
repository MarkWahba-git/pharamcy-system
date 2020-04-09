<?php

namespace App\Http\Controllers\API;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SanctumController extends Controller
{
    public function generateToken(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required'
        ]);
    
        $user = User::where('email', $request->email)->first();
    
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
    
        return $user->createToken($request->device_name)->plainTextToken;
    }
}
