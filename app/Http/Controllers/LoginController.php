<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class LoginController extends Controller
{
    function loginView()
    {
        if (Session::has('user_id')) {
            return redirect()->route('home');
        }
        return view('auth.login', [
            'title' => 'Login',
            'description' => 'Login to your CivicTrack account.',
        ]);
    }
    function registerView()
    {
        if (Session::has('user_id')) {
            return redirect()->route('home');
        }
        return view('auth.register', [
            'title' => 'Register',
            'description' => 'Create a new CivicTrack account.',
        ]);
    }
    function resetPasswirdView()
    {
        if (Session::has('user_id')) {
            return redirect()->route('home');
        }
        return view('auth.reset-password', [
            'title' => 'Reset Password',
            'description' => 'Reset your CivicTrack account password.',
        ]);
    }
    public function register(Request $request)
    {
        // Validate request
        $request->validate([
            'username'              => 'required|alpha_dash|min:4|max:20|unique:users,username',
            'email'                 => 'required|email|unique:users,email',
            'phone'                 => 'required|digits:10|unique:users,phone',
            'password'              => 'required|min:8|confirmed',
        ]);

        // Create user
        $user = User::create([
            'username' => $request->username,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'password' => Hash::make($request->password),
            "email_verified_at" => null,
            "is_banned" => 0,
        ]);
        if ($this->sendEmailConfirmation($user)) {
            return redirect()->route('login')->with('success', 'Registration successful! A confirmation email has been sent to your email address. Please check your inbox.');
        }else{
            return redirect()->route('login')->withErrors(['email' => 'Failed to send confirmation email. Please try again later.']);
        }
    }
    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Find user by username
        $user = User::where('username', $request->username)->first();

        // Check if user exists and password matches
        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['Invalid credentials.'])->withInput();
        }
        if (is_null($user->email_verified_at)) {
            return back()->withErrors(['email' => 'Please verify your email before logging in.']);
        }
        if (($user->is_banned) == 1) {
            return back()->withErrors(['email' => 'Your account is banned. Please contact support.']);
        }

        Session::put('user_id', Crypt::encrypt($user->id));

        return redirect()->route('home');
    }
    public function sendEmailConfirmation($user)
    {
        $confirmationUrl = URL::temporarySignedRoute(
            'verify.email',
            now()->addDay(), 
            ['encid' => Crypt::encrypt($user->id)]
        );
        
        $websiteUrl = config('app.url');
        MailController::msc_mailer($user->email, "Confirm Your Email - CivicTrack", view("emails.verify-email", [
                            'user' => $user,
                            'confirmationUrl' => $confirmationUrl,
                            'websiteUrl' => $websiteUrl
                        ]));
        // return redirect()->route('login')->with('success', 'A confirmation email has been sent to your email address. Please check your inbox.');
        return true;
    }
    function logout()
    {
        Session::forget('user_id');
        return redirect()->route('login')->with('success', 'You have been logged out successfully.');
    }
}
