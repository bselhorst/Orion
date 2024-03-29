@extends('layouts.scaffold')

@section('title')
    Projetos
@endsection

@section('content')
    {{-- <div class="row">
        <div class="col col-md-6">
            <div class="card widget-flat">
                <div class="card-body">
                    <div class="float-end">
                        <i class="ri-group-line text-bg-info widget-icon"></i>
                    </div>
                    <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Total de Recursos</h5>
                    <h3 class="my-3">R$ {{ number_format(floatval(@$total_projetos), 2, ',', '.') }}</h3>
                    <p class="mb-0 text-muted">
                        <span class="text-success me-2"><i class="ri-arrow-up-line"></i> {{ $data->total() }}</span>
                        <span class="text-nowrap">Projetos</span>
                    </p>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div>
        <div class="col col-md-6">
            <div class="card widget-flat">
                <div class="card-body">
                    <div class="float-end">
                        <i class="ri-group-line text-bg-info widget-icon"></i>
                    </div>
                    <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Projetos</h5>
                    <h3 class="my-3">{{ $data->total() }}</h3>
                    <p class="mb-0 text-muted">
                        <span class="text-success me-2"><i class="ri-arrow-up-line"></i> 5.27%</span>
                        <span class="text-nowrap">Since last month</span>
                    </p>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div>
    </div> --}}
    @php
        $permission = 'projeto';
        $header_columns = ['ID', 'Título', 'Valor'];
        $columns = ['id', 'titulo', 'valor'];
    @endphp
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-header">
                        <h4 class="header-title">Lista de Projetos</h4>
                        @can($permission.'.create')
                            <a href="{{url()->current()}}/create" class="btn btn-success btn-create">Cadastrar</a>
                        @endcan
                    </div>
                    <p class="text-muted fs-14">
                        Abaixo a lista com todos os projetos.
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
                                            @can($permission.'.orcamento.read')
                                                <div style="display: inline-block;" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="primary-tooltip" data-bs-title="Orçamento">
                                                    <a href="{{url()->current()}}/{{$item->id}}/orcamentos" class="text-reset px-1" style="font-size: 20px"> <i class="ri-money-dollar-circle-fill"></i></a>
                                                </div> 
                                            @endcan
                                            @can($permission.'.update')
                                                <div style="display: inline-block" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="primary-tooltip" data-bs-title="Editar registro">
                                                    <a href="{{url()->current()}}/edit/{{$item->id}}" class="text-reset px-1" style="font-size: 20px"> <i class="ri-pencil-line"></i></a>
                                                </div> 
                                            @endcan
                                            @can($permission.'.delete')                                     
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