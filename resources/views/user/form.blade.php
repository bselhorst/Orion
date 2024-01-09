@extends('layouts.scaffold')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">{{ (@$data)?'Editar':'Cadastrar' }} Usuário</h4>
                    <form class="needs-validation" method='POST' action="{{ @$data ? route('user.update', $data->id) : route('user.store') }}" novalidate>
                        @csrf
                        @if (@$data)
                            @method('PATCH')
                        @endif
                        <div class="mb-3">
                            <label class="form-label" for="nome">Nome</label>
                            <input type="text" class="form-control" id="nome" placeholder="Nome" value="{{ @$data->name }}" required>
                            {{-- <div class="valid-feedback">
                                Looks good!
                            </div> --}}
                            <div class="invalid-feedback">
                                Campo obrigatório.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="email">Email</label>
                            <div class="input-group">
                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                <input type="email" class="form-control" id="email" placeholder="Email" aria-describedby="inputGroupPrepend" value="{{ @$data->email }}" required>
                                <div class="invalid-feedback">
                                    Campo obrigatório.
                                </div>
                            </div>
                        </div>
                        @if (!@$data)
                            <div class="mb-3">
                                <label class="form-label" for="senha">Senha</label>
                                <input type="password" class="form-control" id="senha" placeholder="Senha" required>
                                <div class="invalid-feedback">
                                    Campo obrigatório.
                                </div>
                            </div>
                        @endif
                        <button class="btn btn-primary" type="submit">{{ (@$data)?'Editar':'Cadastrar' }}</button>
                    </form>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>
@endsection