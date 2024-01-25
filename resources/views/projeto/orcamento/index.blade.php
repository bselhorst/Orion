@extends('layouts.scaffold')

@section('title')
    Orçamento
@endsection

@section('content')
    {{-- <x-table 
    :title="'Lista de Projetos'" 
    :description="'Abaixo a lista com todos os projetos.'" 
    :header_columns="['ID', 'Título', 'Valor']" 
    :columns="['id', 'titulo', 'valor']" 
    :data="$data" 
    /> --}}
    @php
        $permission = 'projeto.orcamento';
        $header_columns = ['ID', 'Programa de trabalho', 'Fonte', 'Natureza', 'Especificação', 'Valor'];
        $columns = ['id', 'programa_de_trabalho', 'fonte', 'natureza_da_despesa', 'especificacao', 'valor'];
    @endphp
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-header">
                        <h4 class="header-title">Lista de Orçamentos do Projeto: <b>{{ $projeto->titulo }}</b></h4>
                        @can(@$permission.'.create')
                            <a href="{{url()->current()}}/create" class="btn btn-success btn-create">Cadastrar</a>
                        @endcan
                    </div>
                    <p class="text-muted fs-14">
                        Abaixo a lista com todos os orçamentos.
                    </p>
                    <div class="table-responsive-sm">
                        <table class="table table-striped table-centered mb-0">
                            <thead>
                                <tr>
                                    @foreach ($header_columns as $header)
                                        <th>{{ $header }}</th>
                                    @endforeach
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        @foreach ($columns as $column)
                                            @php($value = $item->$column)
                                            @if ($column == 'valor')
                                                <td>{{ number_format( floatval($value), 2, ',', '.') }} </td>
                                            @else
                                                <td> {{ $value }} </td>
                                            @endif
                                        @endforeach
                                        <td>
                                            @can(@$permission.'.update')
                                                <div style="display: inline-block" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="primary-tooltip" data-bs-title="Editar registro">
                                                    <a href="{{url()->current()}}/edit/{{$item->id}}" class="text-reset px-1" style="font-size: 20px"> <i class="ri-pencil-line"></i></a>
                                                </div>
                                            @endcan
                                            @can(@$permission.'.delete')                                    
                                                <div style="display: inline-block" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="danger-tooltip" data-bs-title="Excluir registro">
                                                    <a href="javascript: deleteModal({{ $item->id }});" class="text-reset px-1" style="font-size: 20px"> 
                                                        <i class="ri-delete-bin-2-line"></i>
                                                    </a>
                                                </div>
                                            @endcan                                            
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination-div">
                        <p class="small text-muted">
                            {!! __('Mostrando de') !!}
                            <span class="fw-semibold">{{ $data->firstItem() }}</span>
                            {!! __('até') !!}
                            <span class="fw-semibold">{{ $data->lastItem() }}</span>
                            {!! __('de') !!}
                            <span class="fw-semibold">{{ $data->total() }}</span>
                            {!! __('resultados') !!}
                        </p>
                        <div>{{ $data->links('pagination::custom-pagination') }}</div>
                    </div>            
                </div>
            </div>
        </div>
    </div>

    <script>
        function deleteModal(id){
            document.getElementById('id').value = id;
            $('#form-delete').attr('action', window.location.pathname+"/"+id);
            $('#modal-exclusao').modal('show');
        }
    </script>

    <div id="modal-exclusao" class="modal fade" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="fill-danger-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-filled bg-danger">
                <div class="modal-header">
                    <h4 class="modal-title" id="fill-danger-modalLabel">CUIDADO!</h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Você realmente tem certeza que deseja excluir esse registro?</p>
                    <p>A informação será excluída de forma permanente.</p>
                    <p id="informacaoID"></p>
                </div>
                <div class="modal-footer">
                    <form action="" id="form-delete" method="POST">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="id" id="id" /> 
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-outline-light">Confirmar exclusão</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .pagination-div {
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            padding-top: 15px
        }

        .table-header {
            display: flex; 
            justify-content: space-between; 
            align-items: center;
        }

        @media (max-width: 480px){ 
            .table-header{
                flex-direction: column-reverse;
                gap: 10px
            }
            .btn-create{
                width: 100%;
            }
        };
    </style>
@endsection