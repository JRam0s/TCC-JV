<?php

namespace App\Http\Controllers;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Console\Charts\Chart;
use App\Models\Categoria; // Importar o modelo Categoria

class ReportController extends Controller
{
    public function showPizza(GastoController $gastoController)
    {
        // Obter os dados de gastos categorizados
        $dadosGastos = $gastoController->getGastosPorCategoria();
        
        // Separar os dados em nomes de categorias e valores de gastos
        $nomesCategorias = array_keys($dadosGastos);
        $valoresGastos = array_values($dadosGastos);

        // Configurar as cores para maior diferenciação
        $cores = ['#198754', '#FFC107', '#DC3545', '#0D6EFD', '#6C757D', '#6610F2'];

        // Criar o gráfico do tipo pizza
        $chart = (new LarapexChart)
            ->setType('pie') // Tipo do gráfico
            ->setLabels($nomesCategorias) // Labels das categorias
            ->setDataset($valoresGastos) // Dados dos gastos
            ->setColors($cores); // Configuração de cores

        return view('reports.chart', compact('chart'));
    }

    public function showPizzaFP(GastoController $gastoController)
{
    // Obter os dados de gastos agrupados por formas de pagamento
    $dadosGastos = $gastoController->getGastosPorFormaPagamento();
    
    // Separar os dados em nomes das formas de pagamento e valores de gastos
    $nomesFormasPagamento = array_keys($dadosGastos);
    $valoresGastos = array_values($dadosGastos);

    // Configurar as cores para maior diferenciação
    $cores = ['#198754', '#FFC107', '#DC3545', '#0D6EFD', '#6C757D', '#6610F2'];

    // Criar o gráfico do tipo pizza
    $chart = (new LarapexChart)
        ->setType('pie') // Tipo do gráfico
        ->setLabels($nomesFormasPagamento) // Labels das formas de pagamento
        ->setDataset($valoresGastos) // Dados dos gastos
        ->setColors($cores); // Configuração de cores

    return view('reports.fpag', compact('chart'));
}

    

    
}