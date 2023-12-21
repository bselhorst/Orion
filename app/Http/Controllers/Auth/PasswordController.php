<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('messages', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed'],
        ],[
            'current_password' => 'Senha atual incorreta',
            'required' => 'Campo obrigatório',
            'confirmed' => 'Confirmação de senha nova não é igual a senha nova'
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('success', 'Senha atualizada com sucesso');
    }
}
