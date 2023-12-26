@extends('layouts.scaffold')

@section('title')
    Usuários
@endsection

@section('content')

    <x-table 
    :title="'Tabela de Usuários'" 
    :description="'Abaixo a tabela de todos os usuários do sistema.'" 
    :header_columns="['ID', 'Nome', 'Email']" 
    :columns="['id', 'name', 'email']" 
    :data="$data" 
    />

@endsection