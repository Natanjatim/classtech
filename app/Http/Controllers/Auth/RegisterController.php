<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }
    public function showRegisterForm(){
        return view('register');
    }


    protected function insertRegister(Request $request) {
        $request->validate([
            'name' => 'required|string|min:3|max:250',
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'name.required' => 'Nama tidak boleh kosong.',
            'name.min' => 'Nama minimal harus 3 karakter.',
            'email.required' => 'Email tidak boleh kosong.',
            'email.email' => 'Email harus dalam format yang benar.',
            'email.max' => 'Email maksimal 250 karakter.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'Password tidak boleh kosong.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('login')->with('success', 'Registrasi berhasil');
        }
        return back()->withErrors(['msg' => 'Registrasi gagal']);
    }



    protected function validator(array $data)
    {
        return Validator::make($data, [
            "name" => 'required|string|min:3|max:250',
            'email' => 'email|required|max:250|unique:users',
            'password'=> 'required|string|min:8|confirmed',
            'password_confirmation' => 'required| same:password'
        ], [
            'name.required' => 'Nama tidak boleh kosong.',
            'name.min' => 'Nama minimal harus 3 karakter.',
            'email.required' => 'Email tidak boleh kosong.',
            'email.email' => 'Email harus dalam format yang benar.',
            'email.max' => 'Email maksimal 250 karakter.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'Password tidak boleh kosong.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
        ]);

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
