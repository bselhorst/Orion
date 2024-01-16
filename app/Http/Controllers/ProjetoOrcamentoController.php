<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProjetoOrcamento;
use App\Models\Projeto;
use Illuminate\Support\Facades\Redirect;

class ProjetoOrcamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id_projeto)
    {
        $data = ProjetoOrcamento::where('id_projeto', $id_projeto)->paginate(10);
        $projeto = Projeto::findOrFail($id_projeto);
        return view('projeto.orcamento.index', compact('data', 'projeto'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id_projeto)
    {
        return view('projeto.orcamento.form', compact('id_projeto'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(string $id_projeto, Request $request)
    {
        $validated = $request->validateWithBag('messages', [
            'programa_de_trabalho' => ['required', 'string', 'max:255'],
            'fonte' => ['required', 'string', 'max:255'],
            'natureza_da_despesa' => ['required', 'string', 'max:255'],
            'especificacao' => ['required'],
            'valor' => ['required'],
        ],[
            'required' => 'Campo obrigatório',
        ]);

        ProjetoOrcamento::create([
            'id_projeto' => $id_projeto,
            'programa_de_trabalho' => $request->programa_de_trabalho,
            'fonte' => $request->fonte,
            'natureza_da_despesa' => $request->natureza_da_despesa,
            'especificacao' => $request->especificacao,
            'valor' => str_replace(",", ".", str_replace(".", "", $request->valor)),
        ]);

        return Redirect::route('projeto.orcamento.index', $id_projeto)->with('success', 'Registro adicionado com sucesso!');
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
    public function edit(string $id_projeto, string $id)
    {
        $data = ProjetoOrcamento::findOrFail($id);
        return view('projeto.orcamento.form', compact('data', 'id_projeto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $id_projeto, Request $request, string $id)
    {
        $data = ProjetoOrcamento::findOrFail($id);
        $validated = $request->validateWithBag('messages', [
            'programa_de_trabalho' => ['required', 'string', 'max:255'],
            'fonte' => ['required', 'string', 'max:255'],
            'natureza_da_despesa' => ['required', 'string', 'max:255'],
            'especificacao' => ['required'],
            'valor' => ['required'],
        ],[
            'required' => 'Campo obrigatório',
        ]);

        $data->update([
            'id_projeto' => $id_projeto,
            'programa_de_trabalho' => $request->programa_de_trabalho,
            'fonte' => $request->fonte,
            'natureza_da_despesa' => $request->natureza_da_despesa,
            'especificacao' => $request->especificacao,
            'valor' => str_replace(",", ".", str_replace(".", "", $request->valor)),
        ]);

        return Redirect::route('projeto.orcamento.index', $id_projeto)->with('success', 'Registro editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_projeto, string $id)
    {
        ProjetoOrcamento::findOrFail($id)->delete();

        return Redirect::route('projeto.orcamento.index', $id_projeto)->with('success', 'Registro excluído com sucesso!');
    }
}
