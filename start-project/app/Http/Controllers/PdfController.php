<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gasto;
use App\Models\Ganho;
use App\Models\Categoria;
use App\Models\Pagamento;
use App\Models\Meta;
use PDF;

class PdfController extends Controller
{
    public function geraPdf(){

        $ganhosPorCategoria = Ganho::with('categoria')
            ->selectRaw('categoria_id, sum(valor) as total_ganhos')
            ->groupBy('categoria_id')
        ->get();

   
        $gastosPorCategoria = Gasto::with('categoria')
            ->selectRaw('categoria_id, sum(valor) as total_gastos')
            ->groupBy('categoria_id')
        ->get();

        $gasto = Gasto::all();
        $ganho = Ganho::all();
        $categoria = Categoria::all();
        $pagamento = Pagamento::all();
        $meta = Meta::all();
        
        $pdf = PDF::loadView('pdf.pdf', compact('gasto', 'ganho', 'categoria', 'pagamento', 'meta', 'gastosPorCategoria', 'ganhosPorCategoria'));

        return $pdf->setPaper('a3')->stream('Relatórios de Finanças');
    }
}
