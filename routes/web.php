<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Create new user
Route::post('/users', function(Request $request){
    $userData = $request->validate([
        'name'=>['required'],
        'phone'=>['required', Rule::unique('users', 'phone')],
        'email'=>['required', 'email'],
        'password'
    ]);

    $user = User::create($userData);
    return json_encode([
        'data' => [
            'id'=>$user['id'],
            'name'=>$user['name'],
            'phone'=>$user['phone'],
            'email'=>$user['email'],
        ],
    ]);
});

// Get all users
Route::get('/users', function(){
    return User::all();
});

// Get user by id
Route::get('/users/{user}', function(User $user){
    return $user;
});