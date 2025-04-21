<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NinjaController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FreelancerController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\UserController;



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



//auth stuff
Route::get('/', [AuthController::class, 'showLogin'])->name('show.login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('show.register');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');




//========= Dashboard
Route::get('/dashboard', [UserController::class, 'index'])->name('show.dashboard');
Route::post('/client', [UserController::class, 'addClient'])->name('store.client');


//========= Client
Route::get('client/create', [ClientController::class, 'showAddClient'])->name('create.client');
Route::post('/client', [ClientController::class, 'addClient'])->name('store.client');
Route::get('client/{client}/edit', [ClientController::class, 'edit'])->name('edit.client');
Route::get('client/{client}/delete', [ClientController::class, 'delete'])->name('delete.client');
Route::put('client/{client}', [ClientController::class, 'update'])->name('update.client');
Route::get('client/{client}', [ClientController::class, 'showClient'])->name('show.client');
Route::delete('client/{client}', [ClientController::class, 'destroy'])->name('destroy.client');


//========= Project
Route::get('project/{id}', [ProjectController::class, 'showProject'])->name('show.project');




//try out the modal
Route::get('modal', function(){
    return view('test.modal');
})->name('modal');