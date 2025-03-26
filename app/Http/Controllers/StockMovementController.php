<?php

namespace App\Http\Controllers;

use App\Models\MovementCategory;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class StockMovementController extends Controller
{
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
            'products.*.quantity' => 'required|numeric|min:1'
        ]);

        // Simulação de salvar a movimentação
        return back()->with('success', 'Movimentação registrada com sucesso!');
    }
}
