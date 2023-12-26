@props(['title', 'description', 'header_columns' => [], 'columns' => [], 'data' => []])
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">{{ $title }}</h4>
                <p class="text-muted fs-14">
                    {{ $description }}
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
                                        <td> {{ $item->$column }} </td>
                                    @endforeach
                                    <td>
                                        <a href="javascript: void(0);" class="text-reset fs-16 px-1"> <i class="ri-settings-3-line"></i></a>

                                        @if ($item->id != Auth::user()->id)
                                            <div style="display: inline-block" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="danger-tooltip" data-bs-title="Excluir registro">
                                                <a href="javascript: deleteModal({{ $item->id }});" class="text-reset fs-16 px-1"> 
                                                    <i class="ri-delete-bin-2-line"></i>
                                                </a>
                                            </div>
                                        @endif                                        
                                        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 15px">
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
        $('#form-delete').attr('action', "/users/"+id);
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