<?php

namespace App\Http\Controllers;

use App\Models\MovementCategory;
use App\Models\Product;
use App\Models\StockMovement;
use App\Models\StockTransaction;
use App\Models\Supplier;
use Illuminate\Http\Request;

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
        // foreach ($request->products as $product) {
        //     dd($product['id']);
        // }
        
        $transaction = StockTransaction::create([
            'user_id' => '1',
            'supplier_id' => $request->supplier_id,
            'date' => now(),
            'type' => $request->movement_type,
            'movement_category_id' => $request->category_id,
            'observation' => $request->observation
        ]);

        foreach ($request->products as $product) {
            StockMovement::create([
                'stock_transaction_id' => $transaction->id,
                'product_id' => $product['id'],
                'quantity' => $product['quantity']
            ]);
        }
        return redirect()->route('categorias-movimentacao.index')->with('success', 'Movimentação registrada com sucesso!');
    }
    public function destroy(StockTransaction $movimentacao)
    {
        $movimentacao->delete();

        return redirect()->route('movimentacoes.index')->with('success', 'Movimentação excluída com sucesso!');
    }
}
