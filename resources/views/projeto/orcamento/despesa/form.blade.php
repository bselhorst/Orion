@extends('layouts.scaffold')

@section('title')
   Formulário
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">{{ (@$data)?'Editar':'Cadastrar' }} Orçamento</h4>
                    <form class="needs-validation" method='POST' action="{{ @$data ? route('projeto.orcamento.despesa.update', [$id_projeto, $id_orcamento, $data->id]) : route('projeto.orcamento.despesa.store', [$id_projeto, $id_orcamento]) }}" novalidate>
                        @csrf
                        @if (@$data)
                            @method('PATCH')
                        @endif
                        <div class="row">
                            <x-fields :title="'Descrição'" :name="'descricao'" :description="'Descrição da despesa'" :type="'text'" :required="true" :data="@$data" :class="'mb-3 col-md-12'" />
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-12 mb-3">
                                <label class="form-label">Cept</label>
                                <select class="form-control select2" data-toggle="select2" data-allow-clear=true name="select_cept" id="select_cept" aria-hidden="true">
                                    <option></option>
                                    <optgroup label="Lista de Cepts">
                                        @foreach ($cepts as $item)
                                            <option value="{{ $item->id }}" {{ (@$data) ? ($data->id_aux_cept == $item->id) ? 'selected' : '' : ''  }} >{{ $item->nome }}</option>                                            
                                        @endforeach                                        
                                    </optgroup>
                                </select>
                            </div> <!-- end col -->
                        </div>

                        <div class="row">
                            <x-fields :title="'Unidade'" :name="'unidade'" :description="'Unidade'" :type="'text'" :class="'mb-3 col-md-4'" :data="@$data" required="true"/>
                            <x-fields :title="'Quantidade'" :name="'quantidade'" :description="'Quantidade'" :type="'text'" :class="'mb-3 col-md-4'" :data="@$data" required="true"/>
                            <x-fields :title="'Valor Unitário'" :name="'valor_unitario'" :description="'0,00'" :type="'text'" :class="'mb-3 col-md-4'" :mask="'#.##0,00'" :data_reverse=true :data="@$data" required="true"/>
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
    @push('custom_scripts')
        <script>
            $(document).ready(function(){
                $selectElement = $('#select_cept').select2({
                    placeholder: "Escolha um Cept",
                    allowClear: true
                });
            });
        </script>
    @endpush
@endsection