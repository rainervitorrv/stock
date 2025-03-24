<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierRequest;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * List
     */
    public function index()
    {
        $fornecedores = Supplier::latest()->paginate(10);
        return view('fornecedores.index', compact('fornecedores'));
    }

    /**
     * Show
     */
    public function create()
    {
        return view('fornecedores.create');
    }

    /**
     * Store
     */
    public function store(Request $request)
    {
        $attributes = $request->validate(
            [
                'name_fantasy'  => 'required|string|max:255',
                'business_name' => 'nullable|string|max:255',
                'cpf_cnpj'      => 'required|string|min:11|max:14|unique:fornecedores',
                'type'          => 'required|in:Pessoa Física,Pessoa Jurídica',
                'email'         => 'nullable|email|max:255',
                'phone'         => 'nullable|string|max:255',
                'address'       => 'string|max:255',
                'cep'           => 'nullable|string|max:9',
                'number'        => 'nullable|string|max:10',
                'complement'    => 'nullable|string|max:255',
                'neighborhood'  => 'required|string|max:255',
                'city'          => 'required|string|max:255',
                'state'         => 'required|string|max:255',
                'country'       => 'required|string|max:255',
            ],
            [
                'name_fantasy.required'  => 'O Nome Fantasia é obrigatório.',
                'name_fantasy.max'       => 'O Nome Fantasia não pode ter mais que 255 caracteres.',
                'business_name.max'      => 'A Razão Social não pode ter mais que 255 caracteres.',
                'cpf_cnpj.required'      => 'O CPF/CNPJ é obrigatório.',
                'cpf_cnpj.min'           => 'O CPF/CNPJ deve ter no mínimo 11 caracteres.',
                'cpf_cnpj.max'           => 'O CPF/CNPJ deve ter no máximo 14 caracteres.',
                'email.required'         => 'O E-mail é obrigatório.',
                'email.email'            => 'O E-mail deve ser um endereço válido.',
                'phone.required'         => 'O Telefone é obrigatório.',
                'phone.regex'            => 'O Telefone deve estar no formato 000.000.0000.',
                'address.required'       => 'O Endereço é obrigatório.',
                'address.max'            => 'O Endereço não pode ter mais que 255 caracteres.',
                'number.max'             => 'O Número não pode ter mais que 10 caracteres.',
                'neighborhood.required'  => 'O Bairro é obrigatório.',
                'city.required'          => 'A Cidade é obrigatória.',
                'state.required'         => 'O Estado é obrigatório.',
                'country.required'       => 'O País é obrigatório.',
            ]
        );

        Supplier::create($attributes);
        return redirect()->route('fornecedores.index')->with('success', 'Fornecedor cadastrado com sucesso!');
    }

    /**
     * Show
     */
    public function show(Supplier $fornecedor)
    {
        return view('fornecedores.show', compact('fornecedor'));
    }

    /**
     * Edit
     */
    public function edit(Supplier $fornecedor)
    {
        return view('fornecedores.edit', compact('fornecedor'));
    }

    /**
     * Update
     */
    public function update(Request $request, Supplier $fornecedor)
    {
        $attributes = $request->validate(
            [
                'name_fantasy'  => 'required|string|max:255',
                'business_name' => 'nullable|string|max:255',
                'cpf_cnpj'      => 'required|string|min:11|max:14',
                'type'          => 'required|in:Pessoa Física,Pessoa Jurídica',
                'email'         => 'nullable|email|max:255',
                'phone'         => 'nullable|string|max:255',
                'address'       => 'string|max:255',
                'cep'           => 'nullable|string|max:9',
                'number'        => 'nullable|string|max:10',
                'complement'    => 'nullable|string|max:255',
                'neighborhood'  => 'required|string|max:255',
                'city'          => 'required|string|max:255',
                'state'         => 'required|string|max:255',
                'country'       => 'required|string|max:255',
            ],
            [
                'name_fantasy.required'  => 'O Nome Fantasia é obrigatório.',
                'name_fantasy.max'       => 'O Nome Fantasia não pode ter mais que 255 caracteres.',
                'business_name.max'      => 'A Razão Social não pode ter mais que 255 caracteres.',
                'cpf_cnpj.required'      => 'O CPF/CNPJ é obrigatório.',
                'cpf_cnpj.min'           => 'O CPF/CNPJ deve ter no mínimo 11 caracteres.',
                'cpf_cnpj.max'           => 'O CPF/CNPJ deve ter no máximo 14 caracteres.',
                'email.required'         => 'O E-mail é obrigatório.',
                'email.email'            => 'O E-mail deve ser um endereço válido.',
                'phone.required'         => 'O Telefone é obrigatório.',
                'phone.regex'            => 'O Telefone deve estar no formato 000.000.0000.',
                'address.required'       => 'O Endereço é obrigatório.',
                'address.max'            => 'O Endereço não pode ter mais que 255 caracteres.',
                'number.max'             => 'O Número não pode ter mais que 10 caracteres.',
                'neighborhood.required'  => 'O Bairro é obrigatório.',
                'city.required'          => 'A Cidade é obrigatória.',
                'state.required'         => 'O Estado é obrigatório.',
                'country.required'       => 'O País é obrigatório.',
            ]
        );

        $fornecedor->update($attributes);
        return redirect()->route('fornecedores.index')->with('success', 'Fornecedor atualizado com sucesso!');
    }

    /**
     * Destroy
     */
    public function destroy(string $id)
    {
        //
    }
}
