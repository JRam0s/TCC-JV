@extends('template.main', ['menu' => "admin", 'submenu' => "Grafico de Gastos Por Formas de Pagamentos"])

@section('titulo') Desenvolvimento Web @endsection

@section('conteudo')

<div class="row">
    <div class="col">
        <!-- Link do ApexCharts -->
        <link href="https://cdn.jsdelivr.net/npm/apexcharts" rel="stylesheet">

        <!-- Renderização do gráfico -->
        <div id="chart-container">
            {!! $chart->container() !!}
        </div>

        <!-- Scripts necessários -->
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        {!! $chart->script() !!}

        <!-- Customizações adicionais para o gráfico -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Seletor do gráfico gerado
                const chartId = "{!! $chart->id !!}";

                // Opções adicionais para personalizar o gráfico
                const options = {
                    chart: {
                        type: 'pie',
                        toolbar: {
                            show: true // Exibe a toolbar com opções de download
                        }
                    },
                    legend: {
                        position: 'right', // Posiciona a legenda à direita
                        markers: {
                            shape: 'circle' // Formato dos ícones de legenda
                        }
                    },
                    tooltip: {
                        y: {
                            formatter: function (val) {
                                return 'R$ ' + val.toLocaleString('pt-BR'); // Formata valores em reais
                            }
                        }
                    },
                    plotOptions: {
                        pie: {
                            expandOnClick: true // Expande a fatia ao clicar
                        }
                    }
                };

                // Atualiza o gráfico existente com as novas opções
                const chartElement = document.querySelector(`#${chartId}`);
                if (chartElement) {
                    const chart = ApexCharts.getChartById(chartId);
                    if (chart) {
                        chart.updateOptions(options);
                    }
                }
            });
        </script>
    </div>
</div>

@endsection
