<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Auth;

class AuthController extends Controller
{
    /**
     * Get login page
     */
    public function login()
    {
        if (auth()->user()) {
            return redirect('/admin');
        }

        return view('auth.login');
    }

    /**
     * Authenticate user
     */
    public function authenticate(Request $request)
    {
        $request->validate([
            'npk' => 'required|max:6|min:6|regex:/^[0-9]+$/',
            'password' => 'required'
        ]);
    
        $credentials = $request->only('npk', 'password');
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            // return view('admin.pages.home');
            return redirect()->route('admin.home');

            // if ($user->hasRole('admin')) {
            //     return redirect()->route('admin.home');
            
            // } else {
            //     auth()->logout();
            //     $message = 'Anda tidak memiliki otorisasi ke halaman ini';
            // }
        } else {
            $message = 'NPK or Password is wrong!';
        }
    
        return redirect()->back()->withErrors(['unauthenticate' => $message]);
    }

    /**
     * Logout
     */
    public function logout()
    {
        Auth::logout();

        return redirect()->route('admin.auth.login');
    }
}
