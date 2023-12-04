<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
});

// Route::get('/dashboard', function () {
//     $userData = Auth::user();
//     if ($userData && $userData->role == 'Admin'){
//         $users = Users::all();
//     }else if ($userData){
//         $users=  $user = Users::find($userData->$id);
//     } else {
//         redirect('/login');
//     }
//     return view('dashboard')->with('users', $users)->with('userData', $userData);
// })->name('dashboard');

Route::get('/login', function () {
    return view('login');
})->name('login.page');

Route::get('/register', function () {
    return view('register');
});

Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/register', [LoginController::class, 'register'])->name('register');

// Route::get('/user-json', function (){
   
// });

// User route
Route::get('/users', [UserController::class, 'index'])->name('dashboard');
Route::get('/users/create', [UserController::class, 'create'])->name('user.create');
Route::post('/users', [UserController::class, 'store'])->name('user.store');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('user.update');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('user.delete');
Route::get('/users/json', [UserController::class, 'getDataJson'])->name('user.json');

