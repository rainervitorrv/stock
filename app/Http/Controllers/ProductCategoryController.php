<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $categorias = ProductCategory::latest()->paginate(10);
        return view('categorias-produtos.index', compact('categorias'));
    }

    public function create()
    {
        return view('categorias-produtos.create');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate(
            [
                'name' => 'required|min:3|max:255'
            ],
            [
                'name.required' => 'O nome da categoria é obrigatório',
                'name.min' => 'O nome da categoria deve ter no mínimo 3 caracteres',
                'name.max' => 'O nome da categoria deve ter no máximo 255 caracteres'
            ]
        );


        ProductCategory::create($attributes);
        return redirect('categorias-produtos')->with('success', 'Categoria cadastrada com sucesso!');
    }
    public function show(ProductCategory $categoria)
    {
        return view('categorias-produtos.show', compact('categoria'));
    }   
    public function edit(ProductCategory $categoria)
    {
        return view('categorias-produtos.edit', compact('categoria'));
    }
    public function update(Request $request, ProductCategory $categoria)
    {
        $attributes = $request->validate(
            [
                'name' => 'required|min:3|max:255'
            ],
            [
                'name.required' => 'O nome da categoria é obrigatório',
                'name.min' => 'O nome da categoria deve ter no mínimo 3 caracteres',
                'name.max' => 'O nome da categoria deve ter no máximo 255 caracteres',
            ]
        );

        $categoria->update($attributes);
        return redirect('categorias-produtos')->with('success', 'Categoria atualizada com sucesso!');
    }
    public function destroy(ProductCategory $categoria)
    {
        $categoria->delete();
        return redirect('categorias-produtos')->with('success', 'Categoria excluída com sucesso!');
    }
}
