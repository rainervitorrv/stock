<?php

use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProductController;
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

//Rota para produtos
Route::get('/produtos', [ProductController::class, 'index'])->name('produtos.index');
Route::get('/produtos/create', [ProductController::class, 'create'])->name('produtos.create');
Route::post('/produtos', [ProductController::class, 'store'])->name('produtos.store');

Route::get('/produtos/{produto}', [ProductController::class, 'show'])->name('produtos.show');
Route::get('/produtos/{produto}/edit', [ProductController::class, 'edit'])->name('produtos.edit');
Route::patch('/produtos/{produto}', [ProductController::class, 'update'])->name('produtos.update');
Route::delete('/produtos/{produto}', [ProductController::class, 'destroy'])->name('produtos.destroy');

//Rota para categorias de produto
Route::get('/categorias-produtos', [ProductCategoryController::class, 'index'])->name('categorias-produtos.index');
Route::get('/categorias-produtos/create', [ProductCategoryController::class, 'create'])->name('categorias-produtos.create');
Route::post('/categorias-produtos', [ProductCategoryController::class, 'store'])->name('categorias-produtos.store');

Route::get('/categorias-produtos/{categoria}', [ProductCategoryController::class, 'show'])->name('categorias-produtos.show');
Route::get('/categorias-produtos/{categoria}/edit', [ProductCategoryController::class, 'edit'])->name('categorias-produtos.edit');
Route::patch('/categorias-produtos/{categoria}', [ProductCategoryController::class, 'update'])->name('categorias-produtos.update');
Route::delete('/categorias-produtos/{categoria}', [ProductCategoryController::class, 'destroy'])->name('categorias-produtos.destroy');

