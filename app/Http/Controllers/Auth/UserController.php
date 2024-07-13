<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.user.register');
    }
    public function showLoginForm()
    {
        return view('auth.user.login');
    }
    

    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'email' => ['required'],
            'password' => ['required', 'min:8'],
        ]);

        try {
            $credentials = $request->only('email', 'password');
            if (Auth::guard('user')->attempt($credentials)) {
                return redirect()->intended('/');
            }
            return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');

        } catch (\Exception $e) {
            // Also we can send email to developer with $error & request data to notify something went wrong on this project
            return $e->getMessage();
        }
        
    }
    
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'unique:users'],
            'password' => ['required', 'min:8'],
            'phone' => ['required']
        ]);

        try {
            $input = $request->all();
            $registerUser = User::create($input);

            return redirect()->intended('/')
            ->with('message', 'User Register successfully!');

        } catch (\Exception $e) {
            // Also we can send email to developer with $error & request data to notify something went wrong on this project
            return $e->getMessage();
        }
        
    }
}
