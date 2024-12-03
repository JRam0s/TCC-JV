<?php

namespace App\Http\Controllers;

use App\Models\Gasto;
use App\Models\Categoria;
use App\Models\Pagamento;
use Illuminate\Http\Request;

class GastoController extends Controller
{
    public function getGastosPorCategoria()
    {
        // Obter os gastos agrupados por categoria
        $gastos = Gasto::with('categoria') // Relacionar com categorias
            ->get()
            ->groupBy('categoria.nome') // Agrupar pelo nome da categoria
            ->map(function ($gastosPorCategoria) {
                return $gastosPorCategoria->sum('valor'); // Somar os valores
            })
            ->toArray();

        return $gastos; // Retorna como um array associativo
    }

    public function getGastosPorFormaPagamento()
    {
        // Obter os gastos agrupados por formas de pagamento
        $gastos = Gasto::with('pagamento') // Relacionar com formas de pagamento
            ->get()
            ->groupBy('pagamento.nome') // Agrupar pelo nome da forma de pagamento
            ->map(function ($gastosPorFormaPagamento) {
                return $gastosPorFormaPagamento->sum('valor'); // Somar os valores
            })
            ->toArray();

        return $gastos; // Retorna como um array associativo
    }
    
    public function index()
    {
        $data = Gasto::orderBy('id')->get();
        return view('gasto.index', compact('data'));
    }

    public function create()
    {
        $data = Categoria::orderBy('nome')->get();
        $dota = Pagamento::orderBy('nome')->get();
        return view('gasto.create', compact('data', 'dota'));
    }

    public function store(Request $request)
    {
        $regras = [
            'nome' => 'required|max:100|min:5',
            'valor' => 'required',
            'fixo' => 'required',
            'dt_vencimento' => 'required',
        ];

        $msgs = [
            "required" => "O preenchimento do campo é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
        ];

        $request->validate($regras, $msgs);

        $reg = new Gasto();
        $reg->nome = $request->nome;
        $reg->valor = $request->valor;
        $reg->fixo = $request->fixo;
        $reg->dt_vencimento = $request->dt_vencimento;
        $reg->categoria_id = $request->categoria;
        $reg->fpagamento_id = $request->pagamento;
        $reg->save();
        
        return redirect()->route('gasto.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $dados = Gasto::find($id);
        $data = Categoria::orderBy('nome')->get();
        $dota = Pagamento::orderBy('nome')->get();

        if(!isset($dados)) { return "<h1>ID: $id não encontrado!</h1>"; }

        return view('gasto.edit', compact('dados', 'data', 'dota'));
    }

    public function update(Request $request, $id)
    {
        $regras = [
            'nome' => 'required|max:100|min:5',
            'valor' => 'required',
            'fixo' => 'required',
            'dt_vencimento' => 'required',
        ];

        $msgs = [
            "required" => "O preenchimento do campo é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
        ];
        $request->validate($regras, $msgs);

        $reg = Gasto::find($id);

        if(isset($reg)) {
            $reg->nome = $request->nome;
            $reg->valor = $request->valor;
            $reg->fixo = $request->fixo;
            $reg->dt_vencimento = $request->dt_vencimento;
            $reg->dt_pagamento = $request->dt_pagamento;
            $reg->categoria_id = $request->categoria;
            $reg->fpagamento_id = $request->pagamento;
            $reg->save();
        }

        return redirect()->route('gasto.index');
    }

    public function destroy($id)
    {
        $reg = Gasto::find($id);
        $reg->delete();
        return redirect()->route('gasto.index');
    }
}