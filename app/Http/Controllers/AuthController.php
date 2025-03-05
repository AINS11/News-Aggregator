<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Session; // Import Session
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    // User Registration
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|min:6',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]); 
        return redirect('/login')->with('status', 'Registration successful! Please log in.');
    }

    // User Login
    public function login(Request $request)
    {
        $credentials =$request->validate([
            'email' => 'required|string|max:255|min:6',
            'password' => 'required|string|min:6'
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return redirect()->back()->withErrors(['email' => 'The provided credentials are incorrect.']);
        }
    
        $token = $user->createToken('auth_token', ['*'], now()->addDay())->plainTextToken;
        // Store token in session
        Session::put('auth_token', $token);
        // Attempt login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Prevent session fixation attacks
            return redirect()->route('dashboard')->with('success', 'Logged in successfully.');
        }
         // If login fails, return error
         throw ValidationException::withMessages([
            'email' => 'Invalid login credentials.',
        ]);
    }
}
