<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produtos = Product::latest()->paginate(10);
        return view('produtos.index', compact('produtos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = ProductCategory::all();
        return view('produtos.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = $request->validate(
            [
                'name'       => 'required|string|max:255',
                'sku'        => 'nullable|string|max:100|unique:products,sku',
                'barcode'    => 'required|string|max:100|unique:products,barcode',
                'unit'       => 'required|in:UN,CX,M,L,KG,TON',
                'category_id'   => 'required|exists:product_categories,id',
                'stock'      => 'nullable|numeric|min:0',
                'min_stock'  => 'nullable|numeric|min:0',
                'cost_price' => 'required|numeric|min:0',
            ],
            [
                'name.required'      => 'O nome do produto é obrigatório.',
                'name.max'           => 'O nome do produto não pode ter mais de 255 caracteres.',
                'sku.max'            => 'O SKU não pode ter mais de 100 caracteres.',
                'sku.unique'         => 'Este SKU já está cadastrado.',
                'barcode.required'   => 'O código de barras é obrigatório.',
                'barcode.max'        => 'O código de barras não pode ter mais de 100 caracteres.',
                'barcode.unique'     => 'Este código de barras já está cadastrado.',
                'unit.required'      => 'A unidade de medida é obrigatória.',
                'unit.in'            => 'A unidade de medida selecionada é inválida.',
                'category_id.required'  => 'A categoria é obrigatória.',
                'category_id.exists'    => 'A categoria selecionada não existe.',
                'stock.numeric'      => 'O estoque deve ser um valor numérico.',
                'stock.min'          => 'O estoque não pode ser negativo.',
                'min_stock.numeric'  => 'O estoque mínimo deve ser um valor numérico.',
                'min_stock.min'      => 'O estoque mínimo não pode ser negativo.',
                'cost_price.required'=> 'O preço de custo é obrigatório.',
                'cost_price.numeric' => 'O preço de custo deve ser um valor numérico.',
                'cost_price.min'     => 'O preço de custo não pode ser negativo.',
            ]
        );

        Product::create($attributes);
        return redirect()->route('produtos.index')->with('success', 'Produto cadastrado com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $produto)
    {
        return view('produtos.show', compact('produto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $produto)
    {
        $categorias = ProductCategory::all();
        return view('produtos.edit', compact('produto', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $produto)
    {
        $attributes = $request->validate(
            [
                'name'       => 'required|string|max:255',
                'sku'        => 'nullable|string|max:100',
                'barcode'    => 'required|string|max:100',
                'unit'       => 'required|in:UN,CX,M,L,KG,TON',
                'category_id'   => 'required|exists:product_categories,id',
                'min_stock'  => 'nullable|numeric|min:0',
                'cost_price' => 'required|numeric|min:0',
            ],
            [
                'name.required'      => 'O nome do produto é obrigatório.',
                'name.max'           => 'O nome do produto não pode ter mais de 255 caracteres.',
                'sku.max'            => 'O SKU não pode ter mais de 100 caracteres.',
                'barcode.required'   => 'O código de barras é obrigatório.',
                'barcode.max'        => 'O código de barras não pode ter mais de 100 caracteres.',
                'unit.required'      => 'A unidade de medida é obrigatória.',
                'unit.in'            => 'A unidade de medida selecionada é inválida.',
                'category_id.required'  => 'A categoria é obrigatória.',
                'category_id.exists'    => 'A categoria selecionada não existe.',
                'stock.min'          => 'O estoque não pode ser negativo.',
                'min_stock.numeric'  => 'O estoque mínimo deve ser um valor numérico.',
                'min_stock.min'      => 'O estoque mínimo não pode ser negativo.',
                'cost_price.required'=> 'O preço de custo é obrigatório.',
                'cost_price.numeric' => 'O preço de custo deve ser um valor numérico.',
                'cost_price.min'     => 'O preço de custo não pode ser negativo.',
            ]
        );

        $produto->update($attributes);
        return redirect()->route('produtos.index')->with('success', 'Produto atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $produto)
    {
        $produto->delete();
        return redirect()->route('produtos.index')->with('success', 'Produto removido com sucesso.');
    }
}
