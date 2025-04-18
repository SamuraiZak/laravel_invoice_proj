<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NinjaController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FreelancerController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\IncomeController;

Route::get('/', function () {
    return view('welcome');
});

// Tutorial routes
    Route::get('ninjas/', [NinjaController::class, 'index'])->name('ninjas.index');
    Route::get('ninjas/create', [NinjaController::class, 'create'])->name('ninjas.create');
    Route::get('ninjas/{id}', [NinjaController::class, 'show'])->name('ninjas.show');
    Route::post('/ninjas', [NinjaController::class, 'store'])->name('ninjas.store');



// ======   example wrapper for Auth Middleware
// Route::middleware('auth')->group(function(){
//     // Insert routes here
// });
//
//  to wrap routes and protect them from already logged in users, replace 'auth' middleware with 'guest', (already login why want to login again?)



//Development routes




Route::get('/login', [AuthController::class, 'showLogin'])->name('show.login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('show.register');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
