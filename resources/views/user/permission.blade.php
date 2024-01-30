@extends('layouts.scaffold')

@section('title')
    Permissões do Usuário: {{ $data->name }}
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <h4 class="header-title mt-5 mt-lg-0">Permissões</h4>
                            <p class="text-muted fs-14">
                                Abaixo estão as permissões possíveis de serem mudadas para o usuário
                            </p>
                            <form class="needs-validation" method='POST' action="{{ route('user.update.permission', $data->id) }}" novalidate>
                            @csrf
                            @method('PATCH')
                                @foreach ($roles as $item)
                                    <div class="form-check form-switch">
                                        <input type="checkbox" name="permission[]" value="{{$item->name}}" class="form-check-input" id="{{ $item->id }}" {{ $data->hasRole($item->name)?'checked':'' }}>
                                        <label class="form-check-label" for="{{ $item->id }}">{{ $item->name }}</label>
                                    </div>
                                @endforeach
                                <div style="display: flex; justify-content: space-between; padding-top: 15px">
                                    <a href="{{ url()->previous() }}" class="btn btn-danger">Voltar</a>
                                    <button class="btn btn-primary" type="submit">{{ (@$data)?'Editar':'Cadastrar' }}</button>
                                </div>
                            </form>
                        </div> <!-- end col -->
                    </div> <!-- end row -->
                </div> <!-- end card-body-->
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div>
@endsection