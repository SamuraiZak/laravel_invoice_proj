<?php

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


//Development routes
Route::get('/register', [])->name('show.register');
Route::get('/login', [])->name('show.login');
Route::post('/register', [])->name('register');
Route::post('/login', [])->name('login');
