<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordCode;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

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
            
            $welcomeMsg = 'Welcome back, ' . explode(' ', Auth::user()->name)[0] . '!';

            if (Auth::user()->is_admin) {
                return redirect('/admin')->with('success', $welcomeMsg);
            }
            
            return redirect()->intended('/main')->with('success', $welcomeMsg);
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

    // --- Forgot Password Flow ---

    public function showForgetPasswordForm()
    {
        return view('forget-password');
    }

    public function sendVerificationCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ], [
            'email.exists' => 'This email is not registered in our system.'
        ]);

        $code = rand(100000, 999999);
        
        // Store in session
        $request->session()->put('reset_code', $code);
        $request->session()->put('reset_email', $request->email);
        $request->session()->put('reset_code_expires_at', now()->addMinutes(10));

        // Send Real Email
        try {
            Mail::to($request->email)->send(new ResetPasswordCode($code));
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Failed to send email. Please check your configuration. ' . $e->getMessage()]);
        }

        return back()->with('status', 'code_sent')->with('success', "A verification code has been sent to your email.");
    }

    public function verifyCode(Request $request)
    {
        $request->validate(['otp' => 'required|numeric|digits:6']);

        $storedCode = $request->session()->get('reset_code');
        $expiresAt = $request->session()->get('reset_code_expires_at');
        
        if (!$storedCode || now()->greaterThan($expiresAt)) {
            return redirect('/forget-password')->withErrors(['email' => 'Verification code expired. Please request a new one.']);
        }

        if ($request->otp == $storedCode) {
            $request->session()->put('password_reset_verified', true);
            return redirect('/reset-password')->with('success', 'Code verified! You can now reset your password.');
        }

        return back()->withErrors(['otp' => 'The verification code is incorrect.']);
    }

    public function showResetPasswordForm(Request $request)
    {
        if (!$request->session()->get('password_reset_verified')) {
            return redirect('/forget-password')->withErrors(['email' => 'Please verify your email first.']);
        }
        return view('reset-password');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        if (!$request->session()->get('password_reset_verified')) {
            return redirect('/forget-password')->withErrors(['email' => 'Session expired or invalid.']);
        }

        $email = $request->session()->get('reset_email');
        $user = User::where('email', $email)->first();
        
        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();

            // Clear session
            $request->session()->forget(['reset_code', 'reset_email', 'reset_code_expires_at', 'password_reset_verified']);

            return redirect('/login')->with('success', 'Password reset successfully! You can now log in.');
        }

        return redirect('/forget-password')->withErrors(['email' => 'User not found.']);
    }

    // --- Google OAuth Flow ---
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'password' => Hash::make(Str::random(24)), // Random password for Google signup
                    // Address and contact are required in standard registration, 
                    // but nullable in DB based on standard Laravel, wait, our standard registration validates them
                    // Let's leave them null, the user can update their profile later
                ]);
            } else {
                // If user exists but doesn't have google_id, update it
                if (!$user->google_id) {
                    $user->google_id = $googleUser->getId();
                    $user->save();
                }
            }

            Auth::login($user);

            $welcomeMsg = 'Welcome back, ' . explode(' ', $user->name)[0] . '!';

            if ($user->is_admin) {
                return redirect('/admin')->with('success', $welcomeMsg);
            }

            return redirect()->intended('/main')->with('success', $welcomeMsg);
            
        } catch (\Exception $e) {
            \Log::error('Google Auth Error: ' . $e->getMessage());
            return redirect('/login')->withErrors(['email' => 'Failed to authenticate using Google. Please try again.']);
        }
    }
}
