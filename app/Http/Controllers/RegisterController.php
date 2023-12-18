<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'username' => 'required|min:6',
        ]);
        $user = User::create([
            'email' => $validatedData['email'],
            'password_hash' => Hash::make($validatedData['password']), 
            'username' => $validatedData['username'],
        ]);
        
        return response()->json(['message' => 'User registered successfully'], 200);
    }
}


