<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Carbon\Carbon;
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
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:1024'
        ], [
            'username.required' => 'username tidak boleh kosong.',
            'password.required' => 'password tidak boleh kosong.',
            'email.required' => 'email tidak boleh kosong.',
            'name.required' => 'Nama harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'photo.image' => 'File yang diupload harus berupa gambar.',
            'photo.mimes' => 'File yang diupload harus dalam format jpeg, png, jpg, atau gif.',
            'photo.max' => 'Ukuran file tidak boleh lebih dari 1 MB.'
        ]);

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/photos', $imageName); 
        }
        
        $formatedDate = Carbon::createFromFormat('d/m/Y', $request['Dob'])->format('Y-m-d');

        $userData = [
            'name' =>  $request['name'],
            'password' => bcrypt( $request['password']),
            'phone_number' => $request['phoneNumber'],
            'date_of_birth' => $formatedDate,
            'email' => $request['email'],
            'gender' => $request['gender'],
            'ktp_number' => $request['ktpNumber'],
            'photo' => $imageName,
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
