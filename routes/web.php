<?php

use App\Http\Controllers\MovementCategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\StockMovementController;
use App\Http\Controllers\StockTransactionController;
use App\Http\Controllers\UserController;
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
    Route::get('/movimentacoes', [StockMovementController::class, 'index'])->name('movimentacoes.index');
    Route::get('/movimentacoes/create', [StockMovementController::class, 'create'])->name('movimentacoes.create');
    Route::post('/movimentacoes', [StockMovementController::class, 'store'])->name('movimentacoes.store');
    Route::get('/movimentacoes/{movimentacao}', [StockMovementController::class, 'show'])->name('movimentacoes.show');
    Route::delete('/movimentacoes/{movimentacao}', [StockMovementController::class, 'destroy'])->name('movimentacoes.destroy');

    //Rota para categorias de movimentação
    Route::get('/categorias-movimentacao', [MovementCategoryController::class, 'index'])->name('categorias-movimentacao.index');
    Route::get('/categorias-movimentacao/create', [MovementCategoryController::class, 'create'])->name('categorias-movimentacao.create');
    Route::post('/categorias-movimentacao', [MovementCategoryController::class, 'store'])->name('categorias-movimentacao.store');

    Route::get('/categorias-movimentacao/{categoria}', [MovementCategoryController::class, 'show'])->name('categorias-movimentacao.show');
    Route::get('/categorias-movimentacao/{categoria}/edit', [MovementCategoryController::class, 'edit'])->name('categorias-movimentacao.edit');
    Route::patch('/categorias-movimentacao/{categoria}', [MovementCategoryController::class, 'update'])->name('categorias-movimentacao.update');
    Route::delete('/categorias-movimentacao/{categoria}', [MovementCategoryController::class, 'destroy'])->name('categorias-movimentacao.destroy');

    //Rota para relatórios
    Route::get('/relatorios', function () {
        $produtos = Product::latest()->paginate(20);
        return view('relatorio.index', compact('produtos'));
    })->name('relatorios.index');

    //Rota para usuários
    Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios.index');
    Route::get('/usuarios/create', [UserController::class, 'create'])->name('usuarios.create');
    Route::post('/usuarios', [UserController::class, 'store'])->name('usuarios.store');

    Route::get('/usuarios/{usuario}', [UserController::class, 'show'])->name('usuarios.show');
    Route::get('/usuarios/{usuario}/edit', [UserController::class, 'edit'])->name('usuarios.edit');
    Route::patch('/usuarios/{usuario}', [UserController::class, 'update'])->name('usuarios.update');
    Route::delete('/usuarios/{usuario}', [UserController::class, 'destroy'])->name('usuarios.destroy');
});
