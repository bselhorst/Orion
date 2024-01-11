@extends('layouts.scaffold')

@section('title')
    Projetos
@endsection

@section('content')
    <x-table 
    :title="'Lista de Projetos'" 
    :description="'Abaixo a lista com todos os projetos.'" 
    :header_columns="['ID', 'Título', 'Valor']" 
    :columns="['id', 'titulo', 'valor']" 
    :data="$data" 
    />
@endsection