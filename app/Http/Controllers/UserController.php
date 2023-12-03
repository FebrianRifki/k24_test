<?php

namespace App\Http\Controllers;
use App\Models\Users;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        $users = Users::all();
        return view('dashboard')->with('users', $users);
    }

    public function create() {
        return view('create_user_form');
    }

    public function store(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'email'=> 'required|email'
        ], [
            'username.required' => 'username tidak boleh kosong.',
            'password.required' => 'password tidak boleh kosong.',
            'email.required' => 'email tidak boleh kosong.',
        ]);

        $userData = [
            'name' =>  $request['username'],
            'password' => $request['password'],
            'phone_number' => $request['phoneNumber'],
            'date_of_birth' => null,
            'email' => $request['email'],
            'gender' => $request['gender'],
            'ktp_number' => $request['ktpNumber'],
            'photo' => null,
            'role' => $request['role']
        ];

       $user = Users::create($userData);
       if($user){
        return redirect()->route('dashboard')->with('success', 'Data user berhasil disimpan');
       }else {
        return redirect()->back()->with('error', 'Gagal menyimpan data user');
       }
    }

    public function edit($id){
        $user = Users::find($id);
        return view('edit_user_form')->with('user', $user);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'username' => 'required',
            'email'=> 'required|email'
        ], [
            'username.required' => 'username tidak boleh kosong.',
            'password.required' => 'password tidak boleh kosong.',
            'email.required' => 'email tidak boleh kosong.',
        ]);

        $user = Users::find($id);
        $user->name = $request['username'];
        $user->phone_number = $request['phoneNumber'];
        $user->date_of_birth = $request['Dob'];
        $user->email = $request['email'];
        $user->gender = $request['gender'];
        $user->photo = $request['photo'];
        $user->save();
        return redirect()->route('user.edit', $user->id)->with('success', 'Berhasil update data');
    }
    public function destroy($id) {
       $data = users::findOrFail($id);
       $data->delete();

       return redirect()->route('dashboard')->with('success', 'Data berhasil dihapus');
    }

}

