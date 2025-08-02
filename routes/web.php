<?php

use App\Http\Controllers\MovementCategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\StockMovementController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductUnitController;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;


Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (Request $request) {
    $attributes = $request->validate([
        'email'    => 'required|email',
        'password' => 'required'
    ]);

    if (!Auth::attempt($attributes)) {
        throw ValidationException::withMessages([
            'email' => 'Desculpe, as credenciais não correspondem.'
        ]);
    }

    $request->session()->regenerate();

    return redirect()->route('home')->with('sucess', 'Login efetuado com sucesso!');
})->name('login.store');

Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('login')->with('sucess', 'Logout efetuado com sucesso!');
})->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('home');
    })->name('home');

    Route::resource('fornecedores', SupplierController::class)->parameter('fornecedores', 'fornecedor');
    Route::resource('produtos', ProductController::class)->parameter('produtos', 'produto');
    Route::resource('categorias-produtos', ProductCategoryController::class)->parameter('categorias-produtos', 'categoria');
    Route::resource('unidades-produtos', ProductUnitController::class)->parameter('unidades-produtos', 'unidade');
    Route::resource('movimentacoes', StockMovementController::class)->parameter('movimentacoes', 'movimentacao');
    Route::resource('categorias-movimentacao', MovementCategoryController::class)->parameter('categorias-movimentacao', 'categoria');
    Route::get('/relatorios', function () {
        $produtos = Product::latest()->paginate(20);
        return view('relatorio.index', compact('produtos'));
    })->name('relatorios.index');
    Route::resource('usuarios', UserController::class)->parameter('usuarios', 'usuario');
});
