@extends('layouts.scaffold')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="col-xxl-6 col-sm-6">
        <div class="card widget-flat bg-primary text-white">
            <div class="card-body">
                <div class="float-end">
                    <i class="ri-shopping-basket-line widget-icon bg-light-subtle rounded-circle text-primary"></i>
                </div>
                <h5 class="fw-normal mt-0" title="Orders">Soma total de recursos</h5>
                <h3 class="my-3 text-white">R$ {{ number_format(@$valor_total, 2, ',', '.') }}</h3>
                <p class="mb-0">
                    <span class="badge bg-info me-1">{{ count(@$data) }}</span>
                    <span class="text-nowrap">Projetos</span>
                </p>
            </div>
        </div>
    </div>
    <div id="container"></div>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script type="text/javascript">
    var dataDashboard = <?php echo json_encode($data)?>;
    var date = new Date();
    var dadosProjeto = [];
    var dadosOrcamento = [];
    dataDashboard.forEach(projeto => {
        dadosProjeto.push({
            name: projeto.titulo, 
            drilldown: projeto.titulo, 
            y: parseFloat(projeto.valor)
        });
        var dadosOrcamentoValores = [];
        var somaValores = parseFloat(projeto.valor);
        projeto.orcamento.forEach(orcamento => {
            somaValores -= orcamento.valor;
            dadosOrcamentoValores.push({
                name: orcamento.especificacao,
                y: parseFloat(orcamento.valor) 
            })
        });
        if(somaValores > 0){
            dadosOrcamentoValores.push({
                name: 'Dinheiro não distribuído',
                y: somaValores
            });
        }
        dadosOrcamento.push({
            name: projeto.titulo,
            id: projeto.titulo,
            data: dadosOrcamentoValores
        });
    });
    Highcharts.chart('container', {
    chart: {
        type: 'pie'
    },
    title: {
        text: 'Projetos. '+date.toLocaleString('pt-BR', {month: 'long'})+', '+date.getFullYear(),
        align: 'left'
    },
    subtitle: {
        text: 'Clique no gráfico para ver as informações internas',
        align: 'left'
    },

    accessibility: {
        announceNewData: {
            enabled: true
        },
        point: {
            valueSuffix: 'R$'
        }
    },

    plotOptions: {
        series: {
            borderRadius: 5,
            dataLabels: [{
                enabled: true,
                distance: 15,
                format: '{point.name}'
            }, {
                enabled: true,
                distance: '-30%',
                filter: {
                    property: 'percentage',
                    operator: '>',
                    value: 5
                },
                format: '{point.percentage:.2f}%',
                style: {
                    fontSize: '0.9em',
                    textOutline: 'none'
                }
            }]
        }
    },

    tooltip: {
        formatter: function(){
            return '<span style="font-size:11px">'+this.point.series.name+'</span><br><span style="color:'+this.point.color+'">'+this.point.name+'</span>: <b>R$ '+Highcharts.numberFormat(this.point.y, 2, ',', '.')+'</b><br/>';
        },
    },

    series: [
        {
            name: 'Projetos',
            colorByPoint: true,
            teste: 'teste',
            data: dadosProjeto
        }
    ],
    drilldown: {
        series: dadosOrcamento
    }
});
</script>
@endsection