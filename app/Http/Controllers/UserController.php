<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::with('roles')->paginate(10);
        return view('user.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validateWithBag('messages', [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'min:6'],
        ],[
            'required' => 'Campo obrigatório',
            'min' => 'O campo senha deve ter pelo menos 6 caracteres',
            'unique' => 'Esse email já existe na base de dados'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return Redirect::route('user.index')->with('success', 'Registro adicionado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = User::findOrFail($id);
        return view('user.form', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        
        ($user->email != $request['email']) ? $email = ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class] : $email = [];

        if(@$request->password){
            $validated = $request->validateWithBag('messages', [
                'name' => ['required', 'string', 'max:255'],
                'email' => $email,
                'password' => ['required', 'min:6']
            ],[
                'required' => 'Campo obrigatório',
                'unique' => 'Já existe outro usuário com esse email na base de dados'
            ]);  
            $validated['password'] = Hash::make($request->password);
        }else{
            $validated = $request->validateWithBag('messages', [
                'name' => ['required', 'string', 'max:255'],
                'email' => $email,
            ],[
                'required' => 'Campo obrigatório',
                'unique' => 'Já existe outro usuário com esse email na base de dados'
            ]);        
        }

        $user->update($validated);

        return Redirect::route('user.index')->with('success', 'Registro atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = User::findOrFail($id);
        $data->delete();
        return Redirect::route('user.index')->with('success', 'Registro excluído com sucesso!');
    }

    public function permission(string $id)
    {
        $data = User::with('roles')->findOrFail($id);
        $roles = Role::all();
        return view('user.permission', compact(['data', 'roles']));
    }

    public function permissionUpdate(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $user->syncRoles($request['permission']);
        return Redirect::route('user.index')->with('success', 'Permissão alterada com sucesso!');
    }

    public function json()
    {
        $data = User::with('roles')->where('id', 1)->get();
        return $data;
    }
}
