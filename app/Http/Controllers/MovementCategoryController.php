<?php

namespace App\Http\Controllers;

use App\Models\MovementCategory;
use Illuminate\Http\Request;

class MovementCategoryController extends Controller
{
    public function index()
    {
        $categorias = MovementCategory::latest()->paginate(10);
        return view('categorias-movimentacao.index', compact('categorias'));
    }

    public function create()
    {
        return view('categorias-movimentacao.create');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate(
            [
                'name' => 'required|min:3|max:255',
            ],
            [
                'name.required' => 'O nome da categoria é obrigatório',
                'name.min' => 'O nome da categoria deve ter no mínimo 3 caracteres',
                'name.max' => 'O nome da categoria deve ter no máximo 255 caracteres',
            ]
        );


        MovementCategory::create($attributes);
        return redirect('categorias-movimentacao')->with('success', 'Categoria cadastrada com sucesso!');
    }
    public function show(MovementCategory $categoria)
    {
        return view('categorias-movimentacao.show', compact('categoria'));
    }   
    public function edit(MovementCategory $categoria)
    {
        return view('categorias-movimentacao.edit', compact('categoria'));
    }
    public function update(Request $request, MovementCategory $categoria)
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

        $categoria->update($attributes);
        return redirect('categorias-movimentacao')->with('success', 'Categoria atualizada com sucesso!');
    }
    public function destroy(MovementCategory $categoria)
    {
        $categoria->delete();
        return redirect('categorias-movimentacao')->with('success', 'Categoria excluída com sucesso!');
    }
}
