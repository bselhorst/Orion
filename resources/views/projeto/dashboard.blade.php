@extends('layouts.scaffold')

@section('title')
    Dashboard
@endsection

@section('content')
    <div id="container"></div>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script type="text/javascript">
    var dataDashboard = <?php echo json_encode($data)?>;
    // var dados = [{name: 'teste', drilldown: 'teste2', y: 1}];
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
    console.log(dadosProjeto);
    Highcharts.chart('container', {
    chart: {
        type: 'pie'
    },
    title: {
        text: 'Projetos. January, 2022',
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
        // headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        // pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>R$ {point.y:,.2f}</b> reais<br/>'
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
    // drilldown: {
    //     series: [
    //         {
    //             name: 'Projeto Mil Mulheres',
    //             id: 'Projeto Mil Mulheres',
    //             data: [
    //                 [
    //                     'v97.0',
    //                     36.89
    //                 ],
    //                 [
    //                     'v96.0',
    //                     18.16
    //                 ],
    //                 [
    //                     'v95.0',
    //                     0.54
    //                 ],
    //                 [
    //                     'v94.0',
    //                     0.7
    //                 ],
    //             ]
    //         },
    //         {
    //             name: 'Safari',
    //             id: 'Safari',
    //             data: [
    //                 [
    //                     'v15.3',
    //                     0.1
    //                 ],
    //                 [
    //                     'v15.2',
    //                     2.01
    //                 ],
    //                 [
    //                     'v15.1',
    //                     2.29
    //                 ],
    //             ]
    //         },
    //     ]
    // }
});
</script>
@endsection