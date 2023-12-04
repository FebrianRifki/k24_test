<?php

namespace App\Http\Controllers;
use App\Models\Users;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index() {
        $userData = Auth::user();
    
        if ($userData && $userData->role == 'Admin'){
            $users = Users::all();
            foreach ($users as $user) {
                $user->date_of_birth = Carbon::parse($user->date_of_birth)->format('d-m-Y');
            }
        }else if ($userData){
            $users = Users::find($userData->id);
            if ($users->date_of_birth != null) {
                $users->date_of_birth = Carbon::parse($users->date_of_birth)->format('d-m-Y');
            }
        } else {
           return redirect('/login');
        }
        return view('dashboard')->with('users', $users)->with('userData', $userData);
    }

    public function create() {
        $userData = Auth::user();
        if(!$userData){
            return redirect('/login');
        }
        return view('create_user_form')->with('userData', $userData);
    }

    public function store(Request $request){
        $request->validate([
            'username' => 'required',
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

        if($request['Dob'] != null){
            $formatedDate = Carbon::createFromFormat('d/m/Y', $request['Dob'])->format('Y-m-d');    
        }
        
        $userData = [
            'name' =>  $request['username'],
            'password' => bcrypt( $request['password']),
            'phone_number' => $request['phoneNumber'],
            'date_of_birth' => $formatedDate ?? null,
            'email' => $request['email'],
            'gender' => $request['gender'],
            'ktp_number' => $request['ktpNumber'],
            'photo' => $imageName ?? null,
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
        $userData = Auth::user();
        if(!$userData){
            return redirect('/login');
        }
        $user = Users::find($id);
        return view('edit_user_form')->with('user', $user)->with('userData', $userData);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'username' => 'required',
            'email'=> 'required|email',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:1024'
        ], [
            'username.required' => 'username tidak boleh kosong.',
            'password.required' => 'password tidak boleh kosong.',
            'email.required' => 'email tidak boleh kosong.',
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

        $user = Users::find($id);
        $user->name = $request['username'];
        $user->phone_number = $request['phoneNumber'];
        $user->date_of_birth = $formatedDate;
        $user->email = $request['email'];
        $user->gender = $request['gender'];
        $user->photo =  $imageName;

        if ($user->isDirty('photo')) {
            $user->save();
            return redirect()->route('user.edit', $user->id)->with('success', 'Berhasil update data');
        } else {
            return redirect()->route('user.edit', $user->id)->with('success', 'Tidak ada perubahan pada foto');
        }
    }
    public function destroy($id) {
       $data = users::findOrFail($id);
       
       if ($data->photo) {
            Storage::delete('public/photos/' . $data->photo);
       }
       
       $data->delete();
       return redirect()->route('dashboard')->with('success', 'Data berhasil dihapus');
    }
    
    public function getDataJson(){
        $userData = Auth::user();
        if(!$userData){
            return redirect('/login');
        }
        if($userData->role == 'Admin'){
            $users = Users::all();
        } else {
            $users = Users::find($userData->id); 
        }
        
        $jsonData = [
            'users' => $users,
        ];
        
        $jsonString = json_encode($jsonData);
        
        return view('user_json')->with('userData', $userData)->with('jsonData', json_decode($jsonString, JSON_PRETTY_PRINT));
    }
    

}

