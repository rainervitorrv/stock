<?php

namespace App\Http\Controllers;

use App\Models\StockTransaction;
use App\Models\StockMovement;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockTransactionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'date' => 'required|date',
            'type' => 'required|in:entrada,saida',
            'movement_category_id' => 'required|exists:movement_categories,id',
            'observation' => 'nullable|string',
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();

        try {
            // Criar a transação de estoque
            $transaction = StockTransaction::create([
                'user_id' => $request->user_id,
                'supplier_id' => $request->supplier_id,
                'date' => $request->date,
                'type' => $request->type,
                'movement_category_id' => $request->movement_category_id,
                'observation' => $request->observation,
            ]);

            // Criar os movimentos de estoque
            foreach ($request->products as $product) {
                StockMovement::create([
                    'stock_transaction_id' => $transaction->id,
                    'product_id' => $product['id'],
                    'quantity' => $product['quantity'],
                ]);

                // Atualizar o estoque do produto
                $productModel = Product::find($product['id']);

                if ($request->type === 'entrada') {
                    $productModel->stock += $product['quantity'];
                } else {
                    if ($productModel->stock < $product['quantity']) {
                        throw new \Exception("Estoque insuficiente para o produto: {$productModel->name}");
                    }
                    $productModel->stock -= $product['quantity'];
                }

                $productModel->save();
            }

            DB::commit();

            return redirect()->back()->with('success', 'Movimentação salva com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Erro ao salvar movimentação: ' . $e->getMessage());
        }
    }
}
