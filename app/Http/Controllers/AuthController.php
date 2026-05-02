<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('signup-page');
    }

    public function register(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'contact' => 'required|string|max:20',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'fullname.required' => 'Please provide your full name.',
            'address.required' => 'An address is required for our records.',
            'email.required' => 'A valid email address is mandatory.',
            'email.unique' => 'This email is already registered with us.',
            'contact.required' => 'Please enter a contact number.',
            'password.required' => 'A secure password is required.',
            'password.min' => 'Your password must be at least 8 characters long.',
            'password.confirmed' => 'Password confirmation does not match.',
        ]);

        $user = User::create([
            'name' => $request->fullname,
            'address' => $request->address,
            'email' => $request->email,
            'contact' => $request->contact,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect('/main')->with('success', 'Account created successfully!');
    }

    public function showLoginForm()
    {
        return view('login-page');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/main');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/main');
    }
}
