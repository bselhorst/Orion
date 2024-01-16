@extends('layouts.scaffold')

@section('title')
   Formulário
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">{{ (@$data)?'Editar':'Cadastrar' }} Orçamento</h4>
                    <form class="needs-validation" method='POST' action="{{ @$data ? route('projeto.orcamento.update', [$id_projeto, $data->id]) : route('projeto.orcamento.store', $id_projeto) }}" novalidate>
                        @csrf
                        @if (@$data)
                            @method('PATCH')
                        @endif
                        <div class="row">
                            <x-fields :title="'Programa de Trabalho'" :name="'programa_de_trabalho'" :description="'000.000.0000.0000'" :type="'text'" :class="'mb-3 col-md-4'" :data="@$data"/>
                            <x-fields :title="'Fonte'" :name="'fonte'" :description="'Fonte'" :type="'text'" :class="'mb-3 col-md-4'" :data="@$data" />
                            <x-fields :title="'Natureza da Despesa'" :name="'natureza_da_despesa'" :description="'00.00.00'" :type="'text'" :class="'mb-3 col-md-4'" :data="@$data" />
                        </div>
                        <div class="row">
                            <x-fields :title="'Especificação'" :name="'especificacao'" :description="'Nome da especificação'" :type="'text'" :required="true" :data="@$data" :class="'mb-3 col-md-8'" />
                            <x-fields :title="'Valor do Projeto'" :name="'valor'" :description="'0,00'" :type="'text'" :required="true" :class="'mb-3 col-md-4'" :mask="'#.##0,00'" :data_reverse=true :data="@$data"/>
                        </div>
                        <div style="display: flex; justify-content: space-between">
                            <a href="{{ url()->previous() }}" class="btn btn-danger">Voltar</a>
                            <button class="btn btn-primary" type="submit">{{ (@$data)?'Editar':'Cadastrar' }}</button>
                        </div>
                    </form>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>
@endsection