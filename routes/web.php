<?php

use App\Http\Controllers\MovementCategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\StockMovementController;
use App\Http\Controllers\StockTransactionController;
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

//Para Movimentações de Estoque
Route::get('/movimentacoes', [StockMovementController::class, 'create'])->name('movimentacoes.create');
Route::post('/movimentacoes', [StockMovementController::class, 'store'])->name('movimentacoes.store');

//Rota para categorias de movimentação
Route::get('/categorias-movimentacao', [MovementCategoryController::class, 'index'])->name('categorias-movimentacao.index');
Route::get('/categorias-movimentacao/create', [MovementCategoryController::class, 'create'])->name('categorias-movimentacao.create');
Route::post('/categorias-movimentacao', [MovementCategoryController::class, 'store'])->name('categorias-movimentacao.store');

Route::get('/categorias-movimentacao/{categoria}', [MovementCategoryController::class, 'show'])->name('categorias-movimentacao.show');
Route::get('/categorias-movimentacao/{categoria}/edit', [MovementCategoryController::class, 'edit'])->name('categorias-movimentacao.edit');
Route::patch('/categorias-movimentacao/{categoria}', [MovementCategoryController::class, 'update'])->name('categorias-movimentacao.update');
Route::delete('/categorias-movimentacao/{categoria}', [MovementCategoryController::class, 'destroy'])->name('categorias-movimentacao.destroy');

Route::post('/stock-transactions', [StockTransactionController::class, 'store'])->name('stock-transactions.store');


