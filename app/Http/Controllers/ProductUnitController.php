<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductUnit;


class ProductUnitController extends Controller
{
    public function index()
    {
        $unidades = ProductUnit::latest()->paginate(10);

        return view('unidades-produtos.index', compact('unidades'));
    }

    public function create()
    {
        return view('unidades-produtos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:255',
            'abbreviation' => 'required|min:1|max:10'
        ]);
        ProductUnit::create([
            'name' => $request->name,
            'abbreviation' => $request->abbreviation
        ]);
        return redirect('unidades-produtos')->with('success', 'Unidade cadastrada com sucesso!');
    }

    public function show(ProductUnit $unidade)
    {
        return view('unidades-produtos.show', compact('unidade'));
    }

    public function edit(ProductUnit $unidade)
    {
        return view('unidades-produtos.edit', compact('unidade'));
    }

    public function update(Request $request, ProductUnit $unidade)
    {
        $attributes = $request->validate([
            'name' => 'required|min:2|max:255',
            'abbreviation' => 'required|min:1|max:10'
        ]);

        $unidade->update($attributes);

        return redirect('unidades-produtos')->with('success', 'Unidade atualizada com sucesso!');
    }

    public function destroy(ProductUnit $unidade)
    {
        $unidade->delete();
        return redirect('unidades-produtos')->with('success', 'Unidade excluída com sucesso!');
    }

}
