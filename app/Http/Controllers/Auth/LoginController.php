<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function authenticate(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|exists:users,email|max:8', // Mengubah "max:8" menjadi "max:225"
            'password' => 'required|min:6|max:225', // Mengubah "max:8" menjadi "max:225"
        ], [
            'email.max' => 'Masukkan 225 karakter!',
            'password.max' => 'Masukkan 225 karakter!',
            'email.required' => 'Masukkan Email Anda!',
            'email.exists' => 'Email Yang Anda Masukkan Belum Terdaftar!',
            'password.required' => 'Masukkan Kata Sandi Anda!',
            'password.min' => 'Password Minimal 6 Karakter!',
        ]);


        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->route('admin.index')->with('success','Anda berhasil login');
            } elseif ($user->role === 'user') {
                return redirect()->route('home')->with('success','Anda berhasil login');
            }
        }

        return redirect()->route('login')->with('error', 'Email atau kata sandi salah.');
    }


    public function logout(){
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect()->route('login');
    }
}

