<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name_fantasy'  => 'required|string|max:255',
            'business_name' => 'nullable|string|max:255',
            'cpf_cnpj'      => 'required|string|min:11|max:14',
            'type'          => 'required|in:Pessoa Física,Pessoa Jurídica, PF, PJ',
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
        ];
    }

    public function messages(): array
    {
        return [
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
        ];
    }
}
