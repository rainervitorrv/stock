<?php

namespace App\Http\Controllers;

use App\Models\MovementCategory;
use App\Models\Product;
use App\Models\StockMovement;
use App\Models\StockTransaction;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StockMovementController extends Controller
{

    public function index()
    {
        $movimentacoes = StockTransaction::latest()->paginate(10);
        return view('movimentacoes.index', compact('movimentacoes'));
    }


    public function show(StockTransaction $movimentacao)
    {
        $movimentacoes = StockMovement::where('stock_transaction_id', $movimentacao->id)->get();

        return view(
            'movimentacoes.show',
            compact('movimentacao', 'movimentacoes')
        );
    }

    public function create()
    {
        $suppliers = Supplier::all();
        $categories = MovementCategory::all();
        $products = Product::all();

        return view('movimentacoes.create', compact(
            'suppliers',
            'categories',
            'products'
        ));
    }

public function store(Request $request)
{
    $request->validate([
        'supplier_id' => 'required|exists:suppliers,id',
        'movement_type' => 'required|in:entrada,saida',
        'category_id' => 'required|exists:movement_categories,id',
        'products' => 'required|array',
        'products.*.id' => 'required|exists:products,id',
        'products.*.quantity' => 'required|numeric|min:1',
        'observation' => 'nullable|string'
    ]);

    try {
        DB::beginTransaction();

        $transaction = StockTransaction::create([
            'user_id' => Auth::id(),
            'supplier_id' => $request->supplier_id,
            'date' => now(),
            'type' => $request->movement_type,
            'movement_category_id' => $request->category_id,
            'observation' => $request->observation
        ]);

        foreach ($request->products as $product) {
            $qtdProdutos = Product::find($product['id']);

            if (!$qtdProdutos) {
                throw new \Exception("Produto ID {$product['id']} não encontrado.");
            }

            if ($request->movement_type === 'saida' && $qtdProdutos->stock < $product['quantity']) {
                throw new \Exception("Estoque insuficiente para {$qtdProdutos->name}. Quantidade solicitada: {$product['quantity']}, Estoque atual: {$qtdProdutos->stock}.");
            }

            StockMovement::create([
                'stock_transaction_id' => $transaction->id,
                'product_id' => $product['id'],
                'quantity' => $product['quantity']
            ]);

            // Atualiza estoque
            $qtdProdutos->stock += ($request->movement_type === 'entrada') ? $product['quantity'] : -$product['quantity'];
            $qtdProdutos->save();
        }

        DB::commit();

        return redirect()->route('movimentacoes.index')->with('success', 'Movimentação registrada com sucesso!');

    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', $e->getMessage());
    }
}


    public function destroy(StockTransaction $movimentacao)
    {
        $movimentacao->delete();

        return redirect()->route('movimentacoes.index')->with('success', 'Movimentação excluída com sucesso!');
    }
}
