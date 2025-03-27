<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = User::latest()->paginate(10);
        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate(
            [
                'name' => 'string|required|max:255|min:2',
                'email' => 'string|required|email|max:255|min:2|unique:users,email',
                'password' => 'string|required|confirmed|min:6|max:255',
            ],
            [
                'name.required' => 'O campo nome é obrigatório.',
                'name.string' => 'O nome deve ser um texto válido.',
                'name.max' => 'O nome não pode ter mais que 255 caracteres.',
                'name.min' => 'O nome deve ter pelo menos 2 caracteres.',

                'email.required' => 'O campo e-mail é obrigatório.',
                'email.string' => 'O e-mail deve ser um texto válido.',
                'email.email' => 'Informe um endereço de e-mail válido.',
                'email.max' => 'O e-mail não pode ter mais que 255 caracteres.',
                'email.min' => 'O e-mail deve ter pelo menos 2 caracteres.',
                'email.unique' => 'Este e-mail já está cadastrado.',

                'password.required' => 'O campo senha é obrigatório.',
                'password.string' => 'A senha deve ser um texto válido.',
                'password.confirmed' => 'As senhas não coincidem.',
                'password.min' => 'A senha deve ter pelo menos 6 caracteres.',
                'password.max' => 'A senha não pode ter mais que 255 caracteres.',
            ]
        );

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('usuarios.index')->with('sucess', 'Usuário cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $usuario)
    {
        return view('usuarios.show', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $usuario)
    {
        return view('usuarios.edit', compact('usuario'));
    }

    /**
     * Atualizar um usuário especico
     */
    public function update(Request $request, User $usuario)
    {
        $request->validate(
            [
                'name' => 'string|required|max:255|min:2',
                'password' => 'nullable|string|confirmed|min:6|max:255'
            ],
            [
                'name.required' => 'O campo nome é obrigatório.',
                'name.string' => 'O nome deve ser um texto válido.',
                'name.max' => 'O nome não pode ter mais que 255 caracteres.',
                'name.min' => 'O nome deve ter pelo menos 2 caracteres.',

                'password.required' => 'Digite a senha para prosseguir com a alteração.',
                'password.string' => 'A senha deve ser um texto válido.',
                'password.confirmed' => 'As senhas não coincidem.',
                'password.min' => 'A senha deve ter pelo menos 6 caracteres.',
                'password.max' => 'A senha não pode ter mais que 255 caracteres.',
            ]
        );
        $usuario->update([
            'name' => $request->name,
            'password' => $request->password ? Hash::make($request->password) : $usuario->password,
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuário atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $usuario)
    {
        $usuario->delete();

        return redirect()->route('usuarios.index')->with('success', 'O usuário foi apagado com sucesso');
    }
}
