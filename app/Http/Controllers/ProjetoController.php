<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Projeto;
use Illuminate\Support\Facades\Redirect;

class ProjetoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Projeto::paginate(15);
        $total_projetos = Projeto::sum('valor');
        return view('projeto.index', compact('data', 'total_projetos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projeto.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validateWithBag('messages', [
            'titulo' => ['required', 'string', 'max:255'],
            'gestor' => ['required', 'string', 'max:255'],
            'lider' => ['required', 'string', 'max:255'],
            'valor' => ['required'],
            'data_inicio' => ['required'],
            'data_termino' => ['required'],
        ],[
            'required' => 'Campo obrigatório',
        ]);

        Projeto::create([
            'titulo' => $request->titulo,
            'instituicao_executora' => $request->instituicao_executora,
            'responsavel_ie' => $request->responsavel_ie,
            'instituicao_concedente' => $request->instituicao_concedente,
            'responsavel_ic' => $request->responsavel_ic,
            'objeto' => $request->objeto,
            'meta' => $request->meta,
            'gestor' => $request->gestor,
            'lider' => $request->lider,
            'valor' => str_replace(",", ".", str_replace(".", "", $request->valor)),
            'data_inicio' => $request->data_inicio,
            'data_termino' => $request->data_termino,
        ]);

        return Redirect::route('projeto.index')->with('success', 'Registro adicionado com sucesso!');
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
        $data = Projeto::findOrFail($id);
        return view('projeto.form', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Projeto::findOrFail($id);
        $validated = $request->validateWithBag('messages', [
            'titulo' => ['required', 'string', 'max:255'],
            'gestor' => ['required', 'string', 'max:255'],
            'lider' => ['required', 'string', 'max:255'],
            'valor' => ['required'],
            'data_inicio' => ['required'],
            'data_termino' => ['required'],
        ],[
            'required' => 'Campo obrigatório',
        ]);

        $data->update([
            'titulo' => $request->titulo,
            'instituicao_executora' => $request->instituicao_executora,
            'responsavel_ie' => $request->responsavel_ie,
            'instituicao_concedente' => $request->instituicao_concedente,
            'responsavel_ic' => $request->responsavel_ic,
            'objeto' => $request->objeto,
            'meta' => $request->meta,
            'gestor' => $request->gestor,
            'lider' => $request->lider,
            'valor' => str_replace(",", ".", str_replace(".", "", $request->valor)),
            'data_inicio' => $request->data_inicio,
            'data_termino' => $request->data_termino,
        ]);

        return Redirect::route('projeto.index')->with('success', 'Registro editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Projeto::findOrFail($id);
        $data->delete();
        return Redirect::route('projeto.index')->with('success', 'Registro excluído com sucesso!');
    }

    public function dashboard()
    {
        $data = Projeto::with('orcamento')->get();
        $valor_total = Projeto::sum('valor');
        return view('projeto.dashboard', compact('data', 'valor_total'));
    }

    public function json()
    {
        $data = Projeto::with('orcamento')->get();
        return $data;
    }
}
