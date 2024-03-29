<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Projeto;
use App\Models\ProjetoOrcamento;
use App\Models\ProjetoOrcamentoDespesa;
use App\Models\AuxCept;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class ProjetoOrcamentoDespesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id_projeto, string $id_orcamento)
    {
        $data = ProjetoOrcamentoDespesa::select('*', DB::raw('(quantidade * valor_unitario) as total'))->where('id_orcamento', $id_orcamento)->paginate(10);
        $orcamento = ProjetoOrcamento::with('projeto')->findOrFail($id_orcamento);
        return view('projeto.orcamento.despesa.index', compact('data', 'orcamento'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id_projeto, string $id_orcamento)
    {
        $cepts = AuxCept::all();
        return view('projeto.orcamento.despesa.form', compact('id_projeto', 'id_orcamento', 'cepts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(string $id_projeto, string $id_orcamento, Request $request)
    {
        $validated = $request->validateWithBag('messages', [
            'descricao' => ['required', 'string', 'max:255'],
            'unidade' => ['required', 'string', 'max:255'],
            'quantidade' => ['required'],
            'valor_unitario' => ['required'],
        ],[
            'required' => 'Campo obrigatório',
        ]);

        ProjetoOrcamentoDespesa::create([
            'id_orcamento' => $id_orcamento,
            'id_aux_cept' => @$request->select_cept,
            'descricao' => $request->descricao,
            'unidade' => $request->unidade,
            'quantidade' => $request->quantidade,
            'valor_unitario' => str_replace(",", ".", str_replace(".", "", $request->valor_unitario)),
        ]);

        return Redirect::route('projeto.orcamento.despesa.index', [$id_projeto, $id_orcamento])->with('success', 'Registro adicionado com sucesso!');
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
    public function edit(string $id_projeto, string $id_orcamento, string $id)
    {
        $data = ProjetoOrcamentoDespesa::findOrFail($id);
        $cepts = AuxCept::all();
        return view('projeto.orcamento.despesa.form', compact('data', 'id_projeto', 'id_orcamento', 'cepts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $id_projeto, string $id_orcamento, Request $request, string $id)
    {
        $data = ProjetoOrcamentoDespesa::findOrFail($id);
        $validated = $request->validateWithBag('messages', [
            'descricao' => ['required', 'string', 'max:255'],
            'unidade' => ['required', 'string', 'max:255'],
            'quantidade' => ['required'],
            'valor_unitario' => ['required'],
        ],[
            'required' => 'Campo obrigatório',
        ]);

        $data->update([
            'id_orcamento' => $id_orcamento,
            'id_aux_cept' => $request->select_cept,
            'descricao' => $request->descricao,
            'unidade' => $request->unidade,
            'quantidade' => $request->quantidade,
            'valor_unitario' => str_replace(",", ".", str_replace(".", "", $request->valor_unitario)),
        ]);

        return Redirect::route('projeto.orcamento.despesa.index', [$id_projeto, $id_orcamento])->with('success', 'Registro editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_projeto, string $id_orcamento, string $id)
    {
        ProjetoOrcamentoDespesa::findOrFail($id)->delete();

        return Redirect::route('projeto.orcamento.despesa.index', [$id_projeto, $id_orcamento])->with('success', 'Registro excluído com sucesso!');
    }
}
