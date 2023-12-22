@extends('layouts.scaffold')

@section('title')
    Teste
@endsection

@section('content')

    <x-table 
    :title="'Tabela'" 
    :description="'Descrição da tabela'" 
    :header_columns="['ID', 'Nome', 'Email']" 
    :columns="['id', 'name', 'email']" 
    :data="$data" 
    />

@endsection