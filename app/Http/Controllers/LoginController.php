<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function login(Request $request){
        $credentials = $request->only('email', 'password');
       
        if(Auth::attempt($credentials)){
            return redirect()->intended('/users');
        }else{
            return back()->withErrors(['email' => 'Email atau password salah']);
        }
    }
    public function logout(){
        Auth::logout();
        return redirect('/login');
    }

    public function register(Request $request){
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ], [
            'name.required' => 'Nama harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Password tidak cocok dengan konfirmasi password.',
        ]);

        $userData = [
            'name' =>  $request['name'],
            'password' => bcrypt( $request['password']),
            'phone_number' => $request['phoneNumber'],
            'date_of_birth' => null,
            'email' => $request['email'],
            'gender' => $request['gender'],
            'ktp_number' => $request['ktpNumber'],
            'photo' => null,
            'role' => 'Member'
        ];

        $user = Users::create($userData);
        if ($user) {
            return redirect()->route('login.page')->with('success', 'Registrasi berhasil');
        } else {
            return redirect()->back()->with('error', 'Gagal melakukan registrasi');
        }
    }
}
