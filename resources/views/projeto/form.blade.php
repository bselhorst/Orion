@extends('layouts.scaffold')

@section('title')
   Formulário
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">{{ (@$data)?'Editar':'Cadastrar' }} Projeto</h4>
                    <form class="needs-validation" method='POST' action="{{ @$data ? route('projeto.update', $data->id) : route('projeto.store') }}" novalidate>
                        @csrf
                        @if (@$data)
                            @method('PATCH')
                        @endif
                        <x-fields :title="'Título do Projeto'" :name="'titulo'" :description="'Nome do Projeto'" :type="'text'" :required="true" :data="@$data" />
                        <div class="row">
                            <x-fields :title="'Instituição executora'" :name="'instituicao_executora'" :description="'Nome da instituição executora'" :type="'text'" :class="'mb-3 col-md-6'" :data="@$data"/>
                            <x-fields :title="'Responsável da Instituição Executora'" :name="'responsavel_ie'" :description="'Nome do Responsável da Instituição Executora'" :type="'text'" :class="'mb-3 col-md-6'" :data="@$data" />
                        </div>
                        <div class="row">
                            <x-fields :title="'Instituição Concedente'" :name="'instituicao_concedente'" :description="'Nome da instituição concedente'" :type="'text'" :class="'mb-3 col-md-6'" :data="@$data"/>
                            <x-fields :title="'Responsável da Instituição Concedente'" :name="'responsavel_ic'" :description="'Nome do Responsável da Instituição Concedente'" :type="'text'" :class="'mb-3 col-md-6'" :data="@$data"/>
                        </div>
                        <x-fields :title="'Objeto'" :name="'objeto'" :description="'Objeto do projeto'" :type="'text'" :data="@$data" />
                        <x-fields :title="'Meta'" :name="'meta'" :description="'Meta do projeto'" :type="'text'" :data="@$data" />
                        <div class="row">
                            <x-fields :title="'Gestor do projeto'" :name="'gestor'" :description="'Nome do gestor do projeto'" :type="'text'" :required="true" :class="'mb-3 col-md-6'" :data="@$data"/>
                            <x-fields :title="'Líder do Projeto'" :name="'lider'" :description="'Nome do líder do projeto'" :type="'text'" :required="true" :class="'mb-3 col-md-6'" :data="@$data"/>
                        </div>
                        <div class="row">
                            <x-fields :title="'Valor do Projeto'" :name="'valor'" :description="'0,00'" :type="'text'" :required="true" :class="'mb-3 col-md-4'" :mask="'#.##0,00'" :data_reverse=true :data="@$data"/>
                            <x-fields :title="'Data Início'" :name="'data_inicio'" :description="''" :type="'date'" :required="true" :class="'mb-3 col-md-4'" :data="@$data"/>
                            <x-fields :title="'Data Término'" :name="'data_termino'" :description="''" :type="'date'" :required="true" :class="'mb-3 col-md-4'" :data="@$data"/>
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