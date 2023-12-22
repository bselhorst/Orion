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
                                        <a href="javascript: void(0);" class="text-reset fs-16 px-1"> <i class="ri-delete-bin-2-line"></i></a>
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