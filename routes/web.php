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
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PdfController;




//Development routes
Route::middleware('guest')->group(
    function () {
        Route::get('/', [AuthController::class, 'showLogin'])->name('show.login');
        Route::post('/login', [AuthController::class, 'login'])->name('login');
        Route::get('/register', [AuthController::class, 'showRegister'])->name('show.register');
        Route::post('/register', [AuthController::class, 'register'])->name('register');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    }
);

Route::middleware('auth')->group(function () {
    // Insert routes here


    //========= Dashboard
    Route::get('/dashboard', [UserController::class, 'index'])->name('show.dashboard');
    Route::get('/dashboard/projects', [UserController::class, 'indexProjects'])->name('show.dashboardProjects');
    Route::get('/dashboard/invoices', [UserController::class, 'indexInvoices'])->name('show.dashboardInvoices');

    //deleting invoice from dashboard
    Route::get('dashboard/{invoice}/delete', [UserController::class, 'deleteInvoice'])->name('deleteInvoice.dashboard');
    Route::delete('dashboard/{invoice}', [UserController::class, 'destroyInvoice'])->name('destroyInvoice.dashboard');
    //marking invoice as paid or unpaid from dashboard
    Route::put('dashboard/{invoice}/markAsPaid', [UserController::class, 'markAsPaid'])->name('markInvoiceAsPaid.dashboard');
    Route::put('dashboard/{invoice}/markAsUnpaid', [UserController::class, 'markAsUnpaid'])->name('markInvoiceAsUnpaid.dashboard');


    //========= Client
    Route::get('client/create', [ClientController::class, 'showAddClient'])->name('create.client');
    Route::post('/client', [ClientController::class, 'addClient'])->name('store.client');
    Route::get('client/{client}/edit', [ClientController::class, 'edit'])->name('edit.client');
    Route::get('client/{client}/delete', [ClientController::class, 'delete'])->name('delete.client');
    Route::put('client/{client}', [ClientController::class, 'update'])->name('update.client');
    Route::get('client/{client}', [ClientController::class, 'showClient'])->name('show.client');
    Route::delete('client/{client}', [ClientController::class, 'destroy'])->name('destroy.client');


    //========= Project
    Route::post('/project/{client}', [ProjectController::class, 'store'])->name('store.project');
    Route::get('project/{client}/create', [ProjectController::class, 'add'])->name('create.project');
    Route::get('project/{project}', [ProjectController::class, 'showProject'])->name('show.project');
    Route::get('project/{project}/delete', [ProjectController::class, 'delete'])->name('delete.project');
    Route::delete('project/{project}', [ProjectController::class, 'destroy'])->name('destroy.project');
    Route::get('project/{project}/edit', [ProjectController::class, 'edit'])->name('edit.project');
    Route::put('project/{project}', [ProjectController::class, 'update'])->name('update.project');


    //===== Invoice
    Route::get('invoice/{project}/create', [InvoiceController::class, 'add'])->name('create.invoice');
    Route::post('/invoice/{project}', [InvoiceController::class, 'store'])->name('store.invoice');
    Route::get('invoice/{invoice}/delete', [InvoiceController::class, 'delete'])->name('delete.invoice');
    Route::delete('invoice/{invoice}', [InvoiceController::class, 'destroy'])->name('destroy.invoice');
    Route::put('invoice/{invoice}/markAsPaid', [InvoiceController::class, 'markAsPaid'])->name('markAsPaid.invoice');
    Route::put('invoice/{invoice}/markAsUnpaid', [InvoiceController::class, 'markAsUnpaid'])->name('markAsUnpaid.invoice');


    //download pdf
    Route::get('generate-pdf/{invoice}', [PdfController::class, 'generatePdf'])->name('invoice_download');
});
