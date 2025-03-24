<?php

use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});


//Rota para Fornecedores
Route::get('/fornecedores', [SupplierController::class, 'index'])->name('fornecedores.index');
Route::get('/fornecedores/create', [SupplierController::class, 'create'])->name('fornecedores.create');
Route::post('/fornecedores', [SupplierController::class, 'store'])->name('fornecedores.store');

Route::get('/fornecedores/{fornecedor}', [SupplierController::class, 'show'])->name('fornecedores.show');
Route::get('/fornecedores/{fornecedor}/edit', [SupplierController::class, 'edit'])->name('fornecedores.edit');
Route::patch('/fornecedores/{fornecedor}', [SupplierController::class, 'update'])->name('fornecedores.update');
Route::delete('/fornecedores/{fornecedor}', [SupplierController::class, 'destroy'])->name('fornecedores.destroy');